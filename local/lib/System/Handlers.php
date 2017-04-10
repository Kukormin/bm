<?
namespace Local\System;
use Local\Main\Event;
use Local\Main\UserTypeQuotas;
use Local\Main\UserTypeScheme;
use Local\Sale\Cart;

/**
 * Class Handlers Обработчики событий
 * @package Local\Utils
 */
class Handlers
{
	/**
	 * Добавление обработчиков
	 */
	public static function addEventHandlers() {
		static $added = false;
		if (!$added) {
			$added = true;
			AddEventHandler('iblock', 'OnIBlockPropertyBuildList',
				array(__NAMESPACE__ . '\Handlers', 'addYesNo'));
			AddEventHandler('main', 'OnProlog',
				array(__NAMESPACE__ . '\Handlers', 'prolog'));
			AddEventHandler('search', 'BeforeIndex',
				array(__NAMESPACE__ . '\Handlers', 'beforeSearchIndex'));
		}
	}

	/**
	 * Добавление пользовательских свойств
	 * @return array
	 */
	public static function addYesNo() {
		return UserTypeNYesNo::GetUserTypeDescription();
	}

	/**
	 * Перед выводом визуальной части
	 */
	public static function prolog() {

	}

	/**
	 * Формируем поисковый контент
	 * @param $arFields
	 * @return mixed
	 */
	public static function beforeSearchIndex($arFields)
	{
		//if ($arFields['MODULE_ID'] == 'iblock' && $arFields['PARAM2'] == Event::IBLOCK_ID)
		//	$arFields = Event::beforeSearchIndex($arFields);

		return $arFields;
	}

}