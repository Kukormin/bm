<?
namespace Local\Catalog;

use Local\System\ExtCache;

/**
 * Class Communications Связи товаров
 * @package Local\Catalog
 */
class Communications
{
	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Catalog/Communications/';

	/**
	 * ID инфоблока
	 */
	const IBLOCK_ID = 5;

	/**
	 * Возвращает все связи
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
				'ID', 'NAME', 'XML_ID',
			]);
			while ($item = $rsItems->Fetch()) {

				$return['ITEMS'][$item['ID']] = [
					'ID' => $item['ID'],
					'NAME' => $item['NAME'],
					'XML_ID' => $item['XML_ID'],
				];
				if ($item['NAME'] && $item['XML_ID']) {
					$key = $item['NAME'] . '|' . $item['XML_ID'];
					$return['BY_KEY'][$key] = $item['ID'];
				}
			}

			$extCache->endDataCache($return);
		}

		return $return;
	}

	/**
	 * Возвращает связь по ID
	 * @param $id
	 * @return mixed
	 */
	public static function getById($id)
	{
		$all = self::getAll();
		return $all['ITEMS'][$id];
	}

	/**
	 * Возвращает связь по ключу
	 * @param $key
	 * @return mixed
	 */
	public static function getByKey($key)
	{
		$all = self::getAll();
		$id = $all['BY_KEY'][$key];
		return self::getById($id);
	}

	/**
	 * Возвращает ID связи по ключу
	 * @param $key
	 * @return mixed
	 */
	public static function getIdByKey($key)
	{
		$all = self::getAll();
		return $all['BY_KEY'][$key];
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
			$old = self::getByKey($new['NAME'] . '|' . $new['XML_ID']);
			if ($old)
			{
				$updated = false;
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
	 * Добавляет модель
	 * @param $new
	 * @return bool
	 */
	public static function add($new)
	{
		$new['IBLOCK_ID'] = self::IBLOCK_ID;
		$be = new \CIBlockElement();
		$id = $be->Add($new);

		return $id;
	}

}