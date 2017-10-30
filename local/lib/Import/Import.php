<?
namespace Local\Import;
use Local\Catalog\Categories;
use Local\Catalog\Colors;
use Local\Catalog\Communications;
use Local\Catalog\Models;
use Local\Catalog\Products;
use Local\Catalog\PropEnums;
use Local\Catalog\Props;
use Local\System\Log;

/**
 * Class Import Импорт каталога
 * @package Local\Import
 */
class Import
{
	/**
	 * Имя файл с данными
	 */
	const PATH = '/upload/import/';

	/**
	 * @var string Полный путь до файла с данными
	 */
	private $filename = '';

	/**
	 * @var Log Лог
	 */
	private $_log;

	/**
	 * Старт импорта
	 * @return bool
	 * @throws ImportException
	 */
	public function start()
	{
		$this->_log = new Log('import/' . date('Y_m') . '.log');

		$path = $_SERVER['DOCUMENT_ROOT'] . self::PATH;

		// Из всех xml файлов в папке выбираем самый новый
		$rsFiles = scandir($path);
		$files = [];
		foreach ($rsFiles as $filename)
		{
			$ext = substr($filename, -4);
			if ($ext !== '.xml')
				continue;

			$files[] = $filename;
		}
		rsort($files);
		$this->filename = $path . $files[0];

		// Проверяем на наличие файла
		if (!file_exists($this->filename))
		{
			$this->log('Файл не найден');
			throw new ImportException('Файл не найден');
		}

		try
		{
			$this->parse();
		}
		catch (\Exception $e)
		{
			$this->log('Ошибка парсинга данных');
			throw new ImportException('Ошибка парсинга данных');
		}
	}

	/**
	 * Парсинг XML документа и импорт сущностей
	 */
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
				if ($section->tagName == 'Связи')
				{
					$items[] = [
						'NAME' => $attrValues['Карточка'],
						'XML_ID' => $attrValues['КарточкаСвязь'],
						'SORT' => $attrValues['Порядок'],
					];
				}
				elseif ($section->tagName == 'Ассортимент')
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

							if ($assortimentSection->tagName == 'Категории')
							{
								$sections[] = $subAttrValues['КодКатегория'];
							}
							elseif ($assortimentSection->tagName == 'Свойства')
							{
								$props[$subAttrValues['КодСвойство']] = $subAttrValues['ЗначениеСписка'] ? $subAttrValues['ЗначениеСписка'] : $subAttrValues['Значение'];
							}
							elseif ($assortimentSection->tagName == 'Файлы')
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
					if ($section->tagName == 'Свойства')
						$fields['PROPERTY_VALUES']['TYPE'] = $attrValues['type'];
					if ($section->tagName == 'ЗначенияСвойств')
					{
						$fields['PROP'] = $attrValues['КодСвойство'];
						$fields['XML_ID'] = $attrValues['КодЗначения'];
					}
					if ($section->tagName == 'Kategoria')
						$fields['PARENT'] = $attrValues['Родитель'];
					$items[] = $fields;
				}
			}

			if ($section->tagName == 'Категории')
			{
				$result = Categories::import($items);
				$this->logResult('Категории', $result);
			}
			elseif ($section->tagName == 'Модели')
			{
				$result = Models::import($items);
				$this->logResult('Модели', $result);
			}
			elseif ($section->tagName == 'Цвета')
			{
				$result = Colors::import($items);
				$this->logResult('Цвета', $result);
			}
			elseif ($section->tagName == 'Свойства')
			{
				$result = Props::import($items);
				$this->logResult('Свойства', $result);
			}
			elseif ($section->tagName == 'ЗначенияСвойств')
			{
				$result = PropEnums::import($items);
				$this->logResult('Значения свойств', $result);
			}
			elseif ($section->tagName == 'Ассортимент')
			{
				$result = Products::import($items);
				$this->logResult('Ассортимент', $result);
			}
			elseif ($section->tagName == 'Связи')
			{
				$result = Communications::import($items);
				$this->logResult('Связи товаров', $result);
			}
		}

	}

	private function log($s)
	{
		$this->_log->writeText($s);
	}

	private function logResult($title, $result)
	{
		debugmessage($result);
		$this->log($title . ': ' . $result['TOTAL']);
		$this->log("\tВсего в файле: " . $result['TOTAL']);
		$this->log("\tВ базе: " . $result['EX']);
		$this->log("\tДобавлено: " . $result['ADD']);
		$this->log("\tОшибок: " . $result['ERROR']);
		$this->log("\tИзменено: " . $result['UPDATE']);
		$this->log("\tБез изменений: " . $result['NOCH']);
	}

}