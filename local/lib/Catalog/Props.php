<?
namespace Local\Catalog;

use Local\System\ExtCache;

/**
 * Class Props Свойства товаров
 * @package Local\Catalog
 */
class Props
{
	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Catalog/Props/';

	/**
	 * ID инфоблока
	 */
	const IBLOCK_ID = 4;

	/**
	 * Возвращает все свойства товаров
	 * @param bool|false $refreshCache
	 * @return array
	 */
	public static function getAll($refreshCache = false)
	{
		$return = [];

		$extCache = new ExtCache(
			[
				__FUNCTION__,
			],
			static::CACHE_PATH . __FUNCTION__ . '/',
			86400000
		);
		if(!$refreshCache && $extCache->initCache()) {
			$return = $extCache->getVars();
		} else {
			$extCache->startDataCache();

			$iblockElement = new \CIBlockElement();
			$rsItems = $iblockElement->GetList([], [
				'IBLOCK_ID' => self::IBLOCK_ID,
			], false, false, [
				'ID', 'NAME', 'CODE', 'XML_ID',
			    'PROPERTY_TYPE',
			]);
			while ($item = $rsItems->Fetch()) {

				$return['ITEMS'][$item['ID']] = [
					'ID' => $item['ID'],
					'NAME' => $item['NAME'],
					'CODE' => $item['CODE'],
					'XML_ID' => $item['XML_ID'],
					'TYPE' => $item['PROPERTY_TYPE_VALUE'],
				];
				if ($item['CODE']) {
					$return['BY_CODE'][$item['CODE']] = $item['ID'];
				}
				if ($item['XML_ID']) {
					$return['BY_XML_ID'][$item['XML_ID']] = $item['ID'];
				}

			}

			$extCache->endDataCache($return);
		}

		return $return;
	}

	/**
	 * Возвращает свойство по ID
	 * @param $id
	 */
	public static function getById($id)
	{
		$all = self::getAll();
		return $all['ITEMS'][$id];
	}

	/**
	 * Возвращает ID свойства по коду
	 * @param $code
	 */
	public static function getIdByCode($code)
	{
		$all = self::getAll();
		return $all['BY_CODE'][$code];
	}

	/**
	 * Возвращает свойство по XML_ID
	 * @param $xmlId
	 */
	public static function getByXmlId($xmlId)
	{
		$all = self::getAll();
		$id = $all['BY_XML_ID'][$xmlId];
		return self::getById($id);
	}

	/**
	 * Возвращает ID свойства по XML_ID
	 * @param $xmlId
	 * @return mixed
	 */
	public static function getIdByXmlId($xmlId)
	{
		$all = self::getAll();
		return $all['BY_XML_ID'][$xmlId];
	}

	/**
	 * Импорт
	 * @param $data
	 */
	public static function import($data)
	{
		self::getAll(true);
		$clearCache = false;
		foreach ($data as $new)
		{
			$old = self::getByXmlId($new['XML_ID']);
			if ($old)
				$updated = self::update($old, $new);
			else
				$updated = self::add($new);
			if ($updated)
				$clearCache = true;
		}

		if ($clearCache)
			self::getAll(true);
	}

	/**
	 * Возвращает тип для битрикса в зависимости от типа в файле импорта
	 * @param $importType
	 * @return array
	 */
	private static function getTypes($importType)
	{
		$userType = '';
		switch ($importType)
		{
			case 'Число':
				$type = 'N';
				break;
			case 'Строка':
				$type = 'S';
				break;
			case 'Да/нет':
				$type = 'N';
				$userType = 'YesNo';
				break;
			default:
				$type = '';
				break;
		}

		return [
			'TYPE' => $type,
			'USER_TYPE' => $userType,
		];
	}

	/**
	 * Обновляет свойство
	 * @param $old
	 * @param $new
	 * @return bool
	 */
	public static function update($old, $new)
	{
		$types = self::getTypes($new['PROPERTY_VALUES']['TYPE']);
		if (!$types['TYPE'])
			return false;

		$update = [];
		$propUpdate = [];
		foreach ($new as $k => $v)
		{
			if ($k == 'PROPERTY_VALUES')
			{
				foreach ($new[$k] as $propCode => $propValue)
				{

					if ($old[$propCode] != $propValue)
						$propUpdate[$propCode] = $propValue;
				}
			}
			elseif ($old[$k] != $v)
				$update[$k] = $v;
		}
		if ($update || $propUpdate)
		{
			$be = new \CIBlockElement();
			if ($update)
				$be->Update($old['ID'], $update);
			if ($propUpdate)
				$be->SetPropertyValuesEx($old['ID'], self::IBLOCK_ID, $propUpdate);

			$fields = [];
			if ($update['NAME'])
				$fields['NAME'] = $update['NAME'];
			if ($propUpdate['TYPE'])
			{
				$fields['PROPERTY_TYPE'] = $types['TYPE'];
				$fields['USER_TYPE'] = $types['USER_TYPE'];
			}
			if ($fields)
			{
				$bp = new \CIBlockProperty();
				$bp->Update($old['CODE'], $fields);
			}

			return true;
		}

		return false;
	}

	/**
	 * Добавляет свойство
	 * @param $new
	 * @return bool
	 */
	public static function add($new)
	{
		$types = self::getTypes($new['PROPERTY_VALUES']['TYPE']);
		if (!$types['TYPE'])
			return false;

		// Добавляем свойство в ИБ товаров
		$bp = new \CIBlockProperty();
		$fields = array(
			'IS_REQUIRED' => 'N',
			'MULTIPLE' => 'N',
			'ACTIVE' => 'Y',
			'FILTRABLE' => 'Y',
			'NAME' => $new['NAME'],
			'IBLOCK_ID' => Products::IBLOCK_ID,
			'PROPERTY_TYPE' => $types['TYPE'],
			'USER_TYPE' => $types['USER_TYPE'],
		);
		$propId = $bp->Add($fields);
		if (!$propId)
			return false;

		// Добавляем элемент-свойство (в ИБ свойств)
		$new['CODE'] = $propId;
		$new['IBLOCK_ID'] = self::IBLOCK_ID;
		$be = new \CIBlockElement();
		$elementId = $be->Add($new);

		// Обновляем CODE у свойства
		$fields = array(
			'CODE' => 'PROP_' . $elementId,
		);
		$bp->Update($propId, $fields);

		return true;
	}

	/**
	 * Возвращает свойства в формате для селекта
	 * @return array
	 */
	public static function getForSelect()
	{
		$all = self::getAll();
		$return = [];
		foreach ($all['ITEMS'] as $item)
			$return[] = 'PROPERTY_PROP_' . $item['ID'];

		return $return;
	}

}