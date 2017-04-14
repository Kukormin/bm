<?

namespace Local\Catalog;

use Bitrix\Iblock\InheritedProperty\ElementValues;
use Local\System\Debug;
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

	private static $issetFiles = null;
	private static $currentProductId = null;

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
				'PREVIEW_PICTURE',
				'PROPERTY_PRICE',
				'PROPERTY_PRICE_WO_DISCOUNT',
				'PROPERTY_MODEL',
				'PROPERTY_COLOR',
				'PROPERTY_DISABLED',
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
					'PREVIEW_PICTURE' => $item['PREVIEW_PICTURE'],
					'XML_ID' => $item['XML_ID'],
					'PRICE' => intval($item['PROPERTY_PRICE_VALUE']),
					'PRICE_WO_DISCOUNT' => intval($item['PROPERTY_PRICE_WO_DISCOUNT_VALUE']),
					'MODEL' => intval($item['PROPERTY_MODEL_VALUE']),
					'COLOR' => intval($item['PROPERTY_COLOR_VALUE']),
					'DISABLED' => $item['PROPERTY_DISABLED_VALUE'] == 1,
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
	 */
	public static function import($items)
	{

		$issetFiles = [];
		$f = \CFile::GetList([], []);

		while ($file = $f->Fetch())
		{
			$issetFiles[$file['ORIGINAL_NAME']] = $file['ID'];
		}

		self::$issetFiles = $issetFiles;

		foreach ($items as $item)
		{
			$element = self::getByXmlId($item['XML_ID']);
			if (!$element)
			{
				self::itemAdd($item);
			}
			else
			{
				self::$currentProductId = $element['ID'];
				self::itemUpdate($item);
			}
		}
	}

	/**
	 * Добавляет элемент продукт
	 * @param $item
	 */
	public static function itemAdd($item)
	{

		$files = self::getItemFiles($item['FILES']);
		$price = ($item['PRICE_ACTION']) ? $item['PRICE_ACTION'] : $item['PRICE'];
		$prWoAction = ($item['PRICE_ACTION'] > $price) ? $item['PRICE_ACTION'] : $price;

		$item['IBLOCK_ID'] = self::IBLOCK_ID;
		$item['IBLOCK_SECTION'] = self::getItemSections($item['SECTIONS']);
		$item['PREVIEW_PICTURE'] = $files['preview'];
		$item['PROPERTY_VALUES'] = [
			'PRICE' => $price,
			'PRICE_WO_DISCOUNT' => $prWoAction,
			'MODEL' => Models::getByXmlId($item['MODEL']),
			'COLOR' => Colors::getByXmlId($item['COLOR']),
			'DISABLED' => $item['DISABLED'],
			'PICTURES' => $files['images'],
			'FILES' => $files['files'],
		];
		$prodId = new \CIBlockElement();

		foreach ($item['PROPS'] as $key => $value)
		{
			$prop = Props::getByXmlId($key);
			$item['PROPERTY_VALUES']['PROP_' . $prop['ID']] = $value;
		}
		$prodId->Add($item);
	}

	/**
	 * Обновляет продукт
	 * @param $item
	 */
	public static function itemUpdate($item)
	{
		$toUpdate = [];
		$updateProperties = [];
		$product = self::getById(self::$currentProductId);

		$files = self::getItemFiles($item['FILES']);
		$element = new \CIBlockElement();

		if ($product['NAME'] != $item['NAME'])
		{
			$toUpdate['NAME'] = $item['NAME'];
		}

		$sections = self::getItemSections($item['SECTIONS']);
		$newSections = self::checkArrays($product['SECTIONS'], $sections);
		if ($newSections)
		{
			$toUpdate['IBLOCK_SECTION'] = $newSections;
		}

		/*if ($product['PREVIEW_PICTURE'] != $files['preview']['ID'])
		{
			$toUpdate['PREVIEW_PICTURE'] = $files['preview']['ID'];
		}*/

		$itemPrice = (empty($item['PRICE'])) ? 0 : floatval($item['PRICE']);
		$itemActionPrice = (empty($item['PRICE_ACTION'])) ? 0 : $item['PRICE_ACTION'];

		if ($itemActionPrice < $itemPrice)
		{
			$price = $itemActionPrice;
			$prWoAction = $itemPrice;
		}
		else
		{
			$price = $itemPrice;
			$prWoAction = $price;
		}

		if ($product['PRICE'] != $price)
		{
			$updateProperties['PRICE'] = $price;
		}

		if ($product['PRICE_WO_DISCOUNT'] != $prWoAction)
		{
			$updateProperties['PRICE_WO_DISCOUNT'] = $prWoAction;
		}

		$newModel = Models::getByXmlId($item['MODEL']);
		if ($product['MODEL'] != $newModel['ID'])
		{
			$updateProperties['MODEL'] = $newModel['ID'];
		}

		$newColor = Colors::getByXmlId($item['COLOR']);
		if ($product['COLOR'] != $newColor['ID'])
		{
			$updateProperties['COLOR'] = $newColor['ID'];
		}

		$newDisabled = ($item['DISABLED'] == 'Нет') ? false : true;
		if ($product['DISABLED'] != $newDisabled)
		{
			$updateProperties['DISABLED'] = $item['DISABLED'];
		}

		$newPictures = self::checkArrays($product['PICTURES'], $files['images']);

		if ($newPictures)
		{
			if (count($newPictures) < count($product['PICTURES']))
			{
				$del = [];
				$to_dell = array_diff($product['PICTURES'], $newPictures);
				foreach ($to_dell as $img)
				{
					$del[$img] = [
						'VALUE' => [
							'MODULE_ID' => 'iblock',
							'del' => 'Y',
						],
					];
				}
				$newPictures = $del;
			}
			else
			{
				$imgs = [];
				foreach ($newPictures as $img)
				{
					$imgs[$img] = ['VALUE' => \CFile::MakeFileArray(\CFile::GetPath($img))];
				}
				$newPictures = $imgs;
			}
			$updateProperties['PICTURES'] = $newPictures;
		}


		$newFiles = self::checkArrays($product['FILES'], $files['FILES']);
		if ($newFiles)
		{
			$updateProperties['FILES'] = $newFiles;
		}

		foreach ($item['PROPS'] as $key => $value)
		{
			$prop = Props::getByXmlId($key);
			if ($product[$prop['ID']] != $value)
			{
				$updateProperties['PROP_' . $prop['ID']];
			}

		}

		if ($toUpdate)
		{
			$element->Update($product['ID'], $toUpdate);
		}

		if ($updateProperties)
		{
			//$toUpdate['PROPERTY_VALUES'] = $updateProperties;
			$element->SetPropertyValuesEx($product['ID'], self::IBLOCK_ID, $updateProperties);
			//var_dump($updateProperties);
		}
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
			$sections[] = $cat['ID'];
		}

		return $sections;
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
			$filePath = '../upload/files/' . $file['NAME'] . '.' . $file['EXT'];
			if (file_exists($filePath))
			{
				$fileInfo = [
					'name' => $file['NAME'] . '.' . $file['EXT'],
					'size' => filesize($filePath),
					'tmp_name' => $filePath,
					'type' => mime_content_type($filePath),
					'del' => 'Y',
					'MODULE_ID' => 'products',
					'content' => file_get_contents($filePath),
				];

				if (!self::$issetFiles[$file['NAME'] . '.' . $file['EXT']])
				{
					$fileId = \CFile::SaveFile($fileInfo, 'products');
				}
				else
				{
					$fileId = self::$issetFiles[$file['NAME'] . '.' . $file['EXT']];
				}

				if ($file['TYPE'] == '1')
				{
					$files['preview'] = \CFile::MakeFileArray(\CFile::GetPath($fileId));
					$files['preview']['ID'] = $fileId;
				}

				if ($file['TYPE'] == '2')
				{
					$files['images'][] = $fileId;
				}

				if ($file['TYPE'] == '3')
				{
					$files['files'][] = $fileId;
				}
			}

		}

		return $files;

	}


	/**
	 * Сравнение массивов для добавления или удаления элементов
	 * @param $isset
	 * @param $new
	 * @return array
	 */
	public static function checkArrays($isset, $new)
	{
		$res = [];
		$add = array_diff($new, $isset);
		$del = array_diff($isset, $new);

		if ($add)
		{
			$res = array_merge($isset, $add);

			return $res;
		}

		if ($del)
		{
			$res = array_diff($isset, $del);

			return $res;
		}
	}


}

