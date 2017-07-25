<?
namespace Local\Catalog;

use Local\System\ExtCache;

/**
 * Class Colors Цвета
 * @package Local\Catalog
 */
class Colors
{
	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Catalog/Colors/';

	/**
	 * ID инфоблока
	 */
	const IBLOCK_ID = 3;

	/**
	 * Возвращает все цвета
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
			]);
			while ($item = $rsItems->Fetch()) {

				$return['ITEMS'][$item['ID']] = [
					'ID' => $item['ID'],
					'NAME' => $item['NAME'],
					'CODE' => $item['CODE'],
					'XML_ID' => $item['XML_ID'],
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
	 * Возвращает цвет по ID
	 * @param $id
	 * @return mixed
	 */
	public static function getById($id)
	{
		$all = self::getAll();
		return $all['ITEMS'][$id];
	}

	/**
	 * Возвращает ID цвета по коду
	 * @param $code
	 * @return mixed
	 */
	public static function getIdByCode($code)
	{
		$all = self::getAll();
		return $all['BY_CODE'][$code];
	}

	/**
	 * Возвращает цвет по XML_ID
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
	 * Возвращает ID цвета по XML_ID
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
				$newId = self::add($new);
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

		if ($clearCache)
			self::getAll(true);

		return $counts;
	}

	/**
	 * Обновляет цвета
	 * @param $old
	 * @param $new
	 * @return bool
	 */
	public static function update($old, $new)
	{
		$update = [];
		foreach ($new as $k => $v)
			if ($old[$k] != $v)
				$update[$k] = $v;
		if ($update)
		{
			$be = new \CIBlockElement();
			$be->Update($old['ID'], $update);
			return true;
		}
		return false;
	}

	/**
	 * Добавляет цвета
	 * @param $new
	 * @return bool
	 */
	public static function add($new)
	{
		$new['IBLOCK_ID'] = self::IBLOCK_ID;
		$be = new \CIBlockElement();
		$be->Add($new);

		return true;
	}

}