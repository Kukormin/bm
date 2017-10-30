<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
/*
$sections = array();
foreach($arResult['ITEM_ROWS'] as $arItem)
    $sections[$arItem['IBLOCK_SECTION_ID']] = null;
var_dump($arResult['ITEM_ROWS']);
$res = \CIBlockSection::GetList(array(), array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ID' => array_keys($sections)));
while($row = $res->Fetch())
    $sections[$row['ID']] = $row;

foreach($arResult['ITEMS'] as $arItem)
{
    if(!isset($sections[$arItem['SECTION_ID']]))
        continue;
    $sections[$arItem['SECTION_ID']]['ITEMS'][$arItem['ID']] = $arItem;
}
$arResult['ITEMS'] = $sections;*/