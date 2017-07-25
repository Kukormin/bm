<?

namespace Local\Catalog;

use Local\System\ExtCache;

/**
 * Class Products Товары
 * @package Local\Catalog
 */
class Products
{
	/**
	 * ID инфоблока
	 */
	const IBLOCK_ID = 1;

	/**
	 * Время кеширования
	 */
	const CACHE_TIME = 86400;

	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Catalog/Products/';

	/**
	 * @var null текущие файлы, добавленные импортом
	 */
	private static $issetFiles = null;

	/**
	 * Возвращает все товары
	 * @param bool|false $refreshCache
	 * @return array
	 */
	public static function getAll($refreshCache = true)
	{
		return self::getList([], [], false, $refreshCache);
	}

	public static function getList($sort = [], $filter = [], $nav = false, $refreshCache = true)
	{
		$return = [];

		$extCache = new ExtCache(
			[
				__FUNCTION__,
				$sort,
				$filter,
				$nav,
			],
			static::CACHE_PATH . __FUNCTION__ . '/',
			static::CACHE_TIME
		);
		if (!$refreshCache && $extCache->initCache())
		{
			$return = $extCache->getVars();
		}
		else
		{
			$extCache->startDataCache();

			$select = [
				'ID',
				'NAME',
				'CODE',
				'XML_ID',
				'PROPERTY_PRICE',
				'PROPERTY_PRICE_WO_DISCOUNT',
				'PROPERTY_MODEL',
				'PROPERTY_COLOR',
				'PROPERTY_DISABLED',
				'PROPERTY_PICTURE',
				'PROPERTY_PICTURES',
				'PROPERTY_FILES',
			];
			$propSelect = Props::getForSelect();
			$select = array_merge($select, $propSelect);

			$props = Props::getAll();

			$filter['IBLOCK_ID'] = self::IBLOCK_ID;

			$iblockElement = new \CIBlockElement();
			$rsItems = $iblockElement->GetList($sort, $filter, false, $nav, $select);
			while ($item = $rsItems->Fetch())
			{
				// TODO: сделать эффективную выборку получения разделов
				$sections = [];
				$sectionsDB = \CIBlockElement::GetElementGroups($item['ID']);
				while ($section = $sectionsDB->Fetch())
				{
					$sections[] = $section['ID'];
				}
				$product = [
					'ID' => $item['ID'],
					'NAME' => $item['NAME'],
					'CODE' => $item['CODE'],
					'SECTIONS' => $sections,
					'XML_ID' => $item['XML_ID'],
					'PRICE' => intval($item['PROPERTY_PRICE_VALUE']),
					'PRICE_WO_DISCOUNT' => intval($item['PROPERTY_PRICE_WO_DISCOUNT_VALUE']),
					'MODEL' => intval($item['PROPERTY_MODEL_VALUE']),
					'COLOR' => intval($item['PROPERTY_COLOR_VALUE']),
					'DISABLED' => $item['PROPERTY_DISABLED_VALUE'] == 1,
					'PICTURE' => $item['PROPERTY_PICTURE_VALUE'],
					'PICTURES' => $item['PROPERTY_PICTURES_VALUE'],
					'FILES' => $item['PROPERTY_FILES_VALUE'],
				];

				foreach ($props['ITEMS'] as $prop)
				{
					$product['PROPS'][$prop['ID']] = $item['PROPERTY_PROP_' . $prop['ID'] . '_VALUE'];
				}
				$return['BY_XML_ID'][$item['XML_ID']] = $item['ID'];
				$return['ITEMS'][$item['ID']] = $product;
			}

			$extCache->endDataCache($return);
		}

		return $return;
	}

	/**
	 * Получение продукта по XML ID
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
	 * Получение продукта по ID
	 * @param $id
	 * @return mixed
	 */
	public static function getById($id)
	{
		$all = self::getAll();

		return $all['ITEMS'][$id];
	}

	/**
	 * Основная ф-ция импорта продуктов
	 * @param $items
	 * @return array
	 */
	public static function import($items)
	{
		self::initFiles();

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
		foreach ($items as $item)
		{
			$counts['TOTAL']++;
			$fields = self::getIbFields($item);
			$element = self::getByXmlId($item['XML_ID']);
			if ($element)
			{
				$updated = self::itemUpdate($element, $fields);
				if ($updated)
					$counts['UPDATE']++;
				else
					$counts['NOCH']++;
			}
			else
			{
				$newId = self::itemAdd($fields);
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
			self::clearCache();

		return $counts;
	}

	/**
	 * Преобразует данные импорта в поля ИБ
	 * @param $item
	 * @return array
	 */
	public static function getIbFields($item)
	{
		$files = self::getItemFiles($item['FILES']);
		$price = ($item['PRICE_ACTION']) ? $item['PRICE_ACTION'] : $item['PRICE'];
		$prWoAction = ($item['PRICE'] > $price) ? $item['PRICE'] : $price;
		$model = Models::getByXmlId($item['MODEL']);
		$color = Colors::getByXmlId($item['COLOR']);

		$propValues = [
			'PRICE' => $price,
			'PRICE_WO_DISCOUNT' => $prWoAction,
			'MODEL' => $model['ID'],
			'COLOR' => $color['ID'],
			'DISABLED' => $item['DISABLED'],
			'PICTURE' => $files['preview'],
			'PICTURES' => $files['images'],
			'FILES' => $files['files'],
		];
		foreach ($item['PROPS'] as $key => $value)
		{
			$prop = Props::getByXmlId($key);
			$propValues['PROP_' . $prop['ID']] = $value;
		}
		$fields = [
			'IBLOCK_ID' => self::IBLOCK_ID,
			'NAME' => $item['NAME'],
			'XML_ID' => $item['XML_ID'],
			'IBLOCK_SECTION' => self::getItemSections($item['SECTIONS']),
			'PROPERTY_VALUES' => $propValues,
		];

		return $fields;
	}

	/**
	 * Добавляет элемент продукт
	 * @param $fields
	 * @return mixed
	 */
	public static function itemAdd($fields)
	{
		$be = new \CIBlockElement();
		$id = $be->Add($fields);

		return $id;
	}

	/**
	 * Обновляет продукт
	 * @param $old
	 * @param $new
	 * @return bool
	 */
	public static function itemUpdate($old, $new)
	{
		$updateFields = [];
		$updateProperties = [];
		$propValues = $new['PROPERTY_VALUES'];

		// Название
		if ($old['NAME'] != $new['NAME'])
			$updateFields['NAME'] = $new['NAME'];
		// Разделы
		if (!self::checkArrays($old['SECTIONS'], $new['IBLOCK_SECTION']))
			$updateFields['IBLOCK_SECTION'] = $new['IBLOCK_SECTION'];
		// Цены
		if ($old['PRICE'] != $propValues['PRICE'])
			$updateProperties['PRICE'] = $propValues['PRICE'];
		if ($old['PRICE_WO_DISCOUNT'] != $propValues['PRICE_WO_DISCOUNT'])
			$updateProperties['PRICE_WO_DISCOUNT'] = $propValues['PRICE_WO_DISCOUNT'];
		// Модель
		if ($old['MODEL'] != $propValues['MODEL'])
			$updateProperties['MODEL'] = $propValues['MODEL'];
		// Цвет
		if ($old['COLOR'] != $propValues['COLOR'])
			$updateProperties['COLOR'] = $propValues['COLOR'];
		// Не действует
		if ($old['DISABLED'] != $propValues['DISABLED'])
			$updateProperties['DISABLED'] = $propValues['DISABLED'];
		// Картинка для списка
		if ($old['PICTURE'] != $propValues['PICTURE'])
			$updateProperties['PICTURE'] = ['VALUE' => $propValues['PICTURE']];
		// Картинки
		if (!self::checkArrays($old['PICTURES'], $propValues['PICTURES']))
			$updateProperties['PICTURES'] = $propValues['PICTURES'];
		// Файлы
		if (!self::checkArrays($old['FILES'], $propValues['FILES']))
			$updateProperties['FILES'] = $propValues['FILES'];

		if ($updateFields || $updateProperties)
		{
			$be = new \CIBlockElement();
			if ($updateFields)
				$be->Update($old['ID'], $updateFields);
			if ($updateProperties)
				$be->SetPropertyValuesEx($old['ID'], self::IBLOCK_ID, $updateProperties);

			return true;
		}

		return false;
	}


	/**
	 * Преобразование групп товаров в массив с ID группы
	 * @param $data
	 * @return array
	 */
	private static function getItemSections($data)
	{
		$sections = [];
		foreach ($data as $section)
		{
			$cat = Categories::getByXmlId($section);
			if ($cat)
				$sections[] = $cat['ID'];
		}

		return $sections;
	}

	/**
	 * Получает все файлы, которые были добавлены в систему импортом
	 */
	private static function initFiles()
	{
		self::$issetFiles = [];
		$rsFiles = \CFile::GetList([], [
			'MODULE_ID' => 'products',
		]);
		while ($file = $rsFiles->Fetch())
			self::$issetFiles[$file['ORIGINAL_NAME']] = $file['ID'];
	}

	/**
	 * Преобразование файлов продукта
	 * @param $data
	 * @return array
	 */
	private static function getItemFiles($data)
	{
		$files = [];
		foreach ($data as $file)
		{
			$fileName = $file['NAME'] . '.' . $file['EXT'];
			$filePath = $_SERVER['DOCUMENT_ROOT'] . '/upload/files/' . $fileName;
			if (!file_exists($filePath))
				continue;

			if (self::$issetFiles[$fileName])
				$fileId = self::$issetFiles[$file['NAME'] . '.' . $file['EXT']];
			else
			{
				$fileInfo = \CFile::MakeFileArray($filePath);
				$fileInfo['MODULE_ID'] = 'products';
				$fileId = \CFile::SaveFile($fileInfo, 'products');
			}

			if ($file['TYPE'] == '1')
				$files['preview'] = $fileId;
			elseif ($file['TYPE'] == '2')
				$files['images'][] = $fileId;
			elseif ($file['TYPE'] == '3')
				$files['files'][] = $fileId;

		}

		return $files;

	}


	/**
	 * Сравнение массивов
	 * @param $a1
	 * @param $a2
	 * @return bool
	 */
	public static function checkArrays($a1, $a2)
	{
		$cnt1 = count($a1);
		$cnt2 = count($a2);
		if ($cnt1 != $cnt2)
			return false;

		$intersect = array_intersect($a1, $a2);
		$cnt3 = count($intersect);
		return $cnt1 == $cnt3;
	}

	/**
	 * Очищает кеш
	 */
	public static function clearCache()
	{
		$path = self::CACHE_PATH . 'getList';
		$phpCache = new \CPHPCache();
		$phpCache->CleanDir($path);
	}
}

