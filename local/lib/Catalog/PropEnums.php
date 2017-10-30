<?
namespace Local\Catalog;

use Local\System\ExtCache;

/**
 * Class Props Значения списочных свойств
 * @package Local\Catalog
 */
class PropEnums
{
	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Catalog/PropEnums/';

	/**
	 * ID инфоблока
	 */
	const IBLOCK_ID = 14;

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
			    'PROPERTY_PROP',
			]);
			while ($item = $rsItems->Fetch()) {

				$propId = intval($item['PROPERTY_PROP_VALUE']);
				$return['ITEMS'][$item['ID']] = [
					'ID' => $item['ID'],
					'NAME' => $item['NAME'],
					'CODE' => $item['CODE'],
					'XML_ID' => $item['XML_ID'],
					'PROP' => $propId,
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
	 * @return mixed
	 */
	public static function getById($id)
	{
		$all = self::getAll();
		return $all['ITEMS'][$id];
	}

	/**
	 * Возвращает ID свойства по коду
	 * @param $code
	 * @return mixed
	 */
	public static function getIdByCode($code)
	{
		$all = self::getAll();
		return $all['BY_CODE'][$code];
	}

	/**
	 * Возвращает свойство по XML_ID
	 * @param $xmlId
	 * @return mixed
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
	 * Импорт вариантов для списочных свойств
	 * @param $data
	 * @return array
	 */
	public static function import($data)
	{
		$res = self::getAll(true);
		$counts = [
			'EX' => count($res['ITEMS']),
			'TOTAL' => 0,
			'ADD' => 0,
			'ERROR' => 0,
			'UPDETE' => 0,
			'NOCH' => 0,
		];

		$clearCache = false;
		foreach ($data as $new)
		{
			$counts['TOTAL']++;
			$prop = Props::getByXmlId($new['PROP']);
			if ($prop)
			{
				unset($new['PROP']);
				$new['PROPERTY_VALUES']['PROP'] = $prop['ID'];
				$old = self::getByXmlId($new['XML_ID']);
				if ($old)
				{
					$updated = self::update($old, $new);
					if ($updated)
						$counts['UPDATE']++;
					else
						$counts['NOCH']++;
				}
				else
				{
					$newId = self::add($new, $prop['CODE']);
					if ($newId)
					{
						$updated = true;
						$counts['ADD']++;
					}
					else
					{
						$updated = false;
						$counts['ERROR']++;
					}
				}
				if ($updated)
					$clearCache = true;
			}
			else
				$counts['ERROR']++;
		}

		if ($clearCache)
			self::getAll(true);

		return $counts;
	}

	/**
	 * Обновляет свойство
	 * @param $old
	 * @param $new
	 * @return bool
	 */
	public static function update($old, $new)
	{
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
				$fields['VALUE'] = $update['NAME'];
			if ($fields)
			{
				$bpe = new \CIBlockPropertyEnum();
				$bpe->Update($old['CODE'], $fields);
			}

			return true;
		}

		return false;
	}

	/**
	 * Добавляет свойство
	 * @param $new
	 * @param $propId
	 * @return bool
	 */
	public static function add($new, $propId)
	{
		// Добавляем вариант списочного свойства в ИБ товаров
		$bpe = new \CIBlockPropertyEnum();
		$fields = array(
			'PROPERTY_ID' => $propId,
			'VALUE' => $new['NAME'],
			'XML_ID' => $new['XML_ID'],
		);
		$propEnumId = $bpe->Add($fields);
		if (!$propEnumId)
			return false;

		// Добавляем элемент-свойство (в ИБ свойств)
		$new['CODE'] = $propEnumId;
		$new['IBLOCK_ID'] = self::IBLOCK_ID;
		$be = new \CIBlockElement();
		$elementId = $be->Add($new);

		// Обновляем CODE у свойства
		$fields = array(
			'SORT' => $elementId,
		);
		$bpe->Update($propEnumId, $fields);

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