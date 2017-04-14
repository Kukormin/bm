<?
namespace Local\Import;
use Local\Catalog\Categories;
use Local\Catalog\Colors;
use Local\Catalog\Models;
use Local\Catalog\Products;
use Local\Catalog\Props;

/**
 * Class Import Импорт каталога
 * @package Local\Import
 */
class Import
{
	/**
	 * Имя файл с данными
	 */
	const FILENAME = '/upload/1c_import.xml';

	/**
	 * @var string Полный путь до файла с данными
	 */
	private $filename = '';

	/**
	 * Старт импорта
	 * @return bool
	 * @throws ImportException
	 */
	public function start()
	{
		$this->filename = $_SERVER['DOCUMENT_ROOT'] . self::FILENAME;

		if (!file_exists($this->filename))
			throw new ImportException('Файл не найден');

		try
		{
			$this->parse();
		}
		catch (\Exception $e)
		{
			throw new ImportException('Ошибка парсинга данных');
		}
	}

	private function parse()
	{
		$dom = new \DomDocument('1.0', 'utf-8');
		$dom->load($this->filename);

		$root = $dom->firstChild;

		foreach ($root->childNodes as $section)
		{
			if ($section->nodeType != XML_ELEMENT_NODE)
				continue;

			$items = [];

			foreach ($section->childNodes as $item)
			{
				if ($item->nodeType != XML_ELEMENT_NODE)
					continue;

				$attrValues = [];
				foreach ($item->attributes as $attr)
					$attrValues[$attr->name] = $attr->value;
				if ($section->tagName == 'communication')
				{
					$items[] = [
						'PARENT_XML_ID' => $attrValues['Карточка'],
						'XML_ID' => $attrValues['КарточкаСвязь'],
						'SORT' => $attrValues['Порядок'],
					];
				}
				elseif ($section->tagName == 'Assortment')
				{
					$sections = [];
					$props = [];
					$files = [];

					foreach ($item->childNodes as $assortimentSection)
					{
						if ($assortimentSection->nodeType != XML_ELEMENT_NODE)
							continue;

						foreach ($assortimentSection->childNodes as $subItem)
						{
							if ($subItem->nodeType != XML_ELEMENT_NODE)
								continue;

							$subAttrValues = [];
							foreach ($subItem->attributes as $attr)
								$subAttrValues[$attr->name] = $attr->value;

							if ($assortimentSection->tagName == 'Kategoria')
							{
								$sections[] = $subAttrValues['КодКатегория'];
							}
							elseif ($assortimentSection->tagName == 'properties')
							{
								$props[$subAttrValues['КодСвойство']] = $subAttrValues['Значение'];
							}
							elseif ($assortimentSection->tagName == 'files')
							{
								$files[] = [
									'NAME' => $subAttrValues['ИмяФайла'],
									'EXT' => $subAttrValues['Расширение'],
								    'TYPE' => $subAttrValues['ТипФайла']
								];
							}
						}

					}

					$items[] = [
						'NAME' => $attrValues['Наименование'],
						'XML_ID' => $attrValues['Код'],
						'MODEL' => $attrValues['МодельКод'],
						'COLOR' => $attrValues['ЦветКод'],
						'DISABLED' => $attrValues['НеДействует'] == 'Да' ? 1 : 0,
						'PRICE' => intval($attrValues['Цена']),
						'PRICE_ACTION' => intval($attrValues['ЦенаАкция']),
					    'SECTIONS' => $sections,
					    'PROPS' => $props,
					    'FILES' => $files,
					];
				}
				else
				{
					$fields = [
						'NAME' => $attrValues['Наименование'],
						'XML_ID' => $attrValues['Код'],
					];
					if ($section->tagName == 'properties')
						$fields['PROPERTY_VALUES']['TYPE'] = $attrValues['Тип'];
					$items[] = $fields;
				}
			}

			if ($section->tagName == 'Kategoria')
				Categories::import($items);
			elseif ($section->tagName == 'Models')
				Models::import($items);
			elseif ($section->tagName == 'Colors')
				Colors::import($items);
			elseif ($section->tagName == 'properties')
				Props::import($items);
			elseif ($section->tagName == 'Assortment')
				Products::import($items);
		}

	}

}