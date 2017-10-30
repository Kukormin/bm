<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

\Bitrix\Main\Loader::includeModule('iblock');

foreach($arParams['SEARCH_SECTIONS'] as $sectionId)
    $arResult['SECTIONS_WITH_ITEMS'][$sectionId] = null;

$res = \Bitrix\Iblock\SectionTable::getList(array(
    'filter' => array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y', 'ID' => array_keys($arResult['SECTIONS_WITH_ITEMS'])),
));
while($row = $res->fetch())
    $arResult['SECTIONS_WITH_ITEMS'][$row['ID']] = $row;

foreach($arResult['ITEMS'] as $arItem)
{
    if(empty($arResult['SECTIONS_WITH_ITEMS'][$arItem['IBLOCK_SECTION_ID']]))
        continue;
    $arResult['SECTIONS_WITH_ITEMS'][$arItem['IBLOCK_SECTION_ID']]['ITEMS'][$arItem['ID']] = $arItem;
}