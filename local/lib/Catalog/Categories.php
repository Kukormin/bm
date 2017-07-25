<?
namespace Local\Catalog;

use Local\System\ExtCache;

/**
 * Class Categories Категории каталога
 * @package Local\Catalog
 */
class Categories
{
	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Catalog/Categories/';

	/**
	 * Возвращает все категории каталога
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

			$iblockSection = new \CIBlockSection();
			$rsItems = $iblockSection->GetList([
				'SORT' => 'ASC',
				'NAME' => 'ASC',
			], [
				'IBLOCK_ID' => Products::IBLOCK_ID,
			]);
			while ($item = $rsItems->Fetch()) {

				$return['ITEMS'][$item['ID']] = [
					'ID' => $item['ID'],
					'NAME' => $item['NAME'],
					'SORT' => $item['SORT'],
					'CODE' => $item['CODE'],
				    'XML_ID' => $item['XML_ID'],
				    'IBLOCK_SECTION_ID' => $item['IBLOCK_SECTION_ID'],
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
	 * Возвращает категорию по ID
	 * @param $id
	 * @return mixed
	 */
	public static function getById($id)
	{
		$all = self::getAll();
		return $all['ITEMS'][$id];
	}

	/**
	 * Возвращает ID категории по коду
	 * @param $code
	 * @return mixed
	 */
	public static function getIdByCode($code)
	{
		$all = self::getAll();
		return $all['BY_CODE'][$code];
	}

	/**
	 * Возвращает категорию по XML_ID
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
		$parents = [];
		foreach ($data as $new)
		{
			$counts['TOTAL']++;
			if ($new['PARENT'])
			{
				$parent = self::getByXmlId($new['PARENT']);
				if ($parent)
					$new['IBLOCK_SECTION_ID'] = $parent['ID'];
				else
					$new['IBLOCK_SECTION_ID'] = $parents[$new['XML_ID']];
			}
			unset($new['PARENT']);
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
					$parents[$new['XML_ID']] = $newId;
					$updated = true;
					$counts['ADD']++;
				}
				else
				{
					$counts['ERROR']++;
					$updated = false;
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
	 * Обновляет категорию
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
			$bs = new \CIBlockSection();
			$bs->Update($old['ID'], $update);
			return true;
		}
		return false;
	}

	/**
	 * Добавляет категорию
	 * @param $new
	 * @return bool
	 */
	public static function add($new)
	{
		$new['IBLOCK_ID'] = Products::IBLOCK_ID;
		$bs = new \CIBlockSection();
		$id = $bs->Add($new);

		return $id;
	}

}