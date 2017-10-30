<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$this->setFrameMode(true);
$this->addExternalCss('/bitrix/css/main/bootstrap.css');

if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y')
{
	$basketAction = (isset($arParams['COMMON_ADD_TO_BASKET_ACTION']) ? array($arParams['COMMON_ADD_TO_BASKET_ACTION']) : array());
}
else
{
	$basketAction = (isset($arParams['DETAIL_ADD_TO_BASKET_ACTION']) ? $arParams['DETAIL_ADD_TO_BASKET_ACTION'] : array());
}

$isSidebar = ($arParams['SIDEBAR_DETAIL_SHOW'] == 'Y' && !empty($arParams['SIDEBAR_PATH']));
?>
		<?
		$elementId = $APPLICATION->IncludeComponent(
            "bitrix:catalog.element",
            "details",
            array(
                "ACTION_VARIABLE" => "action",
                "ADD_DETAIL_TO_SLIDER" => "N",
                "ADD_ELEMENT_CHAIN" => "N",
                "ADD_PICT_PROP" => "PICT",
                "ADD_PROPERTIES_TO_BASKET" => "Y",
                "ADD_SECTIONS_CHAIN" => "Y",
                "ADD_TO_BASKET_ACTION" => array(
                    0 => "BUY",
                ),
                "ADD_TO_BASKET_ACTION_PRIMARY" => array(
                    0 => "BUY",
                ),
                "BACKGROUND_IMAGE" => "-",
                "BASKET_URL" => "/personal/basket.php",
                "BRAND_USE" => "N",
                "BROWSER_TITLE" => "-",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CHECK_SECTION_ID_VARIABLE" => "N",
                "COMPATIBLE_MODE" => "Y",
                "DETAIL_PICTURE_MODE" => array(
                    0 => "POPUP",
                    1 => "MAGNIFIER",
                ),
                "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                "DISPLAY_COMPARE" => "N",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PREVIEW_TEXT_MODE" => "E",
                "GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
                "GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
                "GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "4",
                "GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
                "GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
                "GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
                "GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "4",
                "GIFTS_MESS_BTN_BUY" => "Выбрать",
                "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
                "GIFTS_SHOW_IMAGE" => "Y",
                "GIFTS_SHOW_NAME" => "Y",
                "GIFTS_SHOW_OLD_PRICE" => "Y",
                "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                "IBLOCK_ID" => "4",
                "IBLOCK_TYPE" => "Contect",
                "IMAGE_RESOLUTION" => "16by9",
                "LABEL_PROP" => array(
                ),
                'LINK_ELEMENTS_URL' => $arParams['LINK_ELEMENTS_URL'],
                "LINK_IBLOCK_ID" => "",
                "LINK_IBLOCK_TYPE" => "",
                "LINK_PROPERTY_SID" => "",
                "MAIN_BLOCK_PROPERTY_CODE" => array(
                    0 => "VISOTA",
                    1 => "GLYBINA",
                    2 => "DLINA",
                    3 => "CODE",
                    4 => "COLLECTIONS",
                    5 => "PROIZ",
                    6 => "SOSTAV",
                    7 => "OLD_PRICE",
                    8 => "SHIRINA",
                ),
                "MESSAGE_404" => "",
                "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                "MESS_BTN_BUY" => "Купить",
                "MESS_BTN_SUBSCRIBE" => "Подписаться",
                "MESS_COMMENTS_TAB" => "Комментарии",
                "MESS_DESCRIPTION_TAB" => "Описание",
                "MESS_NOT_AVAILABLE" => "Нет в наличии",
                "MESS_PRICE_RANGES_TITLE" => "Цены",
                "MESS_PROPERTIES_TAB" => "Характеристики",
                "META_DESCRIPTION" => "-",
                "META_KEYWORDS" => "-",
                "OFFERS_LIMIT" => "0",
                "PARTIAL_PRODUCT_PROPERTIES" => "N",
                "PRICE_CODE" => array(
                    0 => "rub",
                ),
                "PRICE_VAT_INCLUDE" => "Y",
                "PRICE_VAT_SHOW_VALUE" => "N",
                "PRODUCT_ID_VARIABLE" => "id",
                "PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
                "PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
                "PRODUCT_PROPERTIES" => array(
                ),
                "PRODUCT_PROPS_VARIABLE" => "prop",
                "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                "PRODUCT_SUBSCRIPTION" => "Y",
                "PROPERTY_CODE" => array(
                    0 => "VISOTA",
                    1 => "GLYBINA",
                    2 => "DLINA",
                    3 => "CODE",
                    4 => "COLLECTIONS",
                    5 => "PROIZ",
                    6 => "SOSTAV",
                    7 => "OLD_PRICE",
                    8 => "SHIRINA",
                    9 => "WES",
                ),
                'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],
                'ELEMENT_ID' => $arResult['VARIABLES']['ELEMENT_ID'],
                'ELEMENT_CODE' => $arResult['VARIABLES']['ELEMENT_CODE'],
                'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
                'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
                'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
                'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
                'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                "SEF_MODE" => "N",
                "SET_BROWSER_TITLE" => "Y",
                "SET_CANONICAL_URL" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "Y",
                "SET_VIEWED_IN_COMPONENT" => "N",
                "SHOW_404" => "N",
                "SHOW_CLOSE_POPUP" => "N",
                "SHOW_DEACTIVATED" => "N",
                "SHOW_DISCOUNT_PERCENT" => "N",
                "SHOW_MAX_QUANTITY" => "N",
                "SHOW_OLD_PRICE" => "N",
                "SHOW_PRICE_COUNT" => "1",
                "SHOW_SLIDER" => "N",
                "STRICT_SECTION_CHECK" => "N",
                "TEMPLATE_THEME" => "blue",
                "USE_COMMENTS" => "N",
                "USE_ELEMENT_COUNTER" => "Y",
                "USE_ENHANCED_ECOMMERCE" => "N",
                "USE_GIFTS_DETAIL" => "Y",
                "USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
                "USE_MAIN_ELEMENT_SECTION" => "N",
                "USE_PRICE_COUNT" => "N",
                "USE_PRODUCT_QUANTITY" => "N",
                "USE_RATIO_IN_RANGES" => "N",
                "USE_VOTE_RATING" => "N",
                "COMPONENT_TEMPLATE" => "details"
            ),
            false
        );
		$GLOBALS['CATALOG_CURRENT_ELEMENT_ID'] = $elementId;

		?>