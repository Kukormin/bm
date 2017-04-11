<?

namespace Local\Catalog;

use Bitrix\Iblock\InheritedProperty\ElementValues;
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
	 * Возвращает все товары
	 * @param bool|false $refreshCache
	 * @return array
	 */
	public static function getAll($refreshCache = false)
	{
		return self::getList([], [], false, true);
	}

	public static function getList($sort = [], $filter = [], $nav = false, $refreshCache = false)
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
				$product = [
					'ID' => $item['ID'],
					'NAME' => $item['NAME'],
					'CODE' => $item['CODE'],
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
					$product['PROPS'][$prop['ID']] = $item['PROPERTY_' . $prop['ID'] . '_VALUE'];
				}
				$return['BY_XML_ID'][$item['XML_ID']] = $item['ID'];
				$return['ITEMS'][$item['ID']] = $product;
			}

			$extCache->endDataCache($return);
		}

		return $return;
	}

	public static function getByXmlId($xmlId)
	{
		$all = self::getAll();
		$id = $all['BY_XML_ID'][$xmlId];
		return self::getById($id);
	}

	public static function getById($id)
	{
		$all = self::getAll();

		return $all['ITEMS'][$id];
	}

	public static function import($items)
	{

		$issetFiles = [];
		$f = \CFile::GetList();

		while ($file = $f->Fetch())
		{
			$issetFiles[$file['ORIGINAL_NAME']] = $file['ID'];
		}

		foreach ($items as $item)
		{
			$element = self::getByXmlId($item['XML_ID']);
			if (!$element)
			{
				self::item($item,$issetFiles);
			}
			else
			{
				self::item($item, $issetFiles, $element['ID']);
			}
		}
	}

	public static function item($item, $issetFiles = [], $id = null)
	{

		$files = self::getItemFiles($item['FILES'], $issetFiles);

		$item['IBLOCK_ID'] = self::IBLOCK_ID;
		$item['IBLOCK_SECTION'] = self::getItemSections($item['SECTIONS']);
		$item['PREVIEW_PICTURE'] = $files['preview'];
		$price = ($item['PRICE_ACTION']) ? $item['PRICE_ACTION'] : $item['PRICE'];
		$prWoAction = ($item['PRICE_ACTION'] > $price) ? $item['PRICE_ACTION'] : $price;
		$item['PROPERTY_VALUES'] = [
			'PRICE' => $price,
			'PRICE_WO_DISCOUNT' => $prWoAction,
			'MODEL' => Models::getByXmlId($item['MODEL']),
			'COLOR' => Colors::getByXmlId($item['COLOR']),
			'DISABLED' => $item['DISABLED'],
		];
		$prodId = new \CIBlockElement();

		if ($id !== null)
		{
			$prod = Products::getById($id);

			foreach ($prod['PROPS'] as $key => $value)
			{
				$pr = Props::getById($key);
				$item['PROPERTY_VALUES']['PROP_' . $key] = ($item['PROPS'][$pr['XML_ID']]) ? $item['PROPS'][$pr['XML_ID']] : null;
			}

			$prodId->Update($id, $item);

		}
		else
		{
			foreach ($item['PROPS'] as $key => $value)
			{
				$prop = Props::getByXmlId($key);
				$item['PROPERTY_VALUES']['PROP_' . $prop['ID']] = $value;
			}
			$prodId->Add($item);
		}

		$prodId->SetPropertyValues($id,self::IBLOCK_ID,['PICTURES' => $files['images'],'FILES' => $files['files']]);
	}

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

	private static function getItemFiles($data, $issetFiles)
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

				if (!$issetFiles[$file['NAME'] . '.' . $file['EXT']])
				{
					$fileId = \CFile::SaveFile($fileInfo, 'products');
				}
				else
				{
					$fileId = $issetFiles[$file['NAME'] . '.' . $file['EXT']];
				}

				if ($file['TYPE'] == '1')
				{
					$files['preview'] = \CFile::MakeFileArray(\CFile::GetPath($fileId));
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


}

