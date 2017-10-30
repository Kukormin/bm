<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

\Bitrix\Main\Loader::includeModule('iblock');

$arResult['SECTIONS_WITH_ITEMS'] = $ufColors = array();

foreach($arParams['SEARCH_SECTIONS'] as $sectionId)
    $arResult['SECTIONS_WITH_ITEMS'][$sectionId] = null;

$res = \CIBlockSection::GetList(
    array('SORT' => 'ASC'),
    array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y', 'ID' => array_keys($arResult['SECTIONS_WITH_ITEMS'])),
    false,
    array('ID', 'NAME', 'SORT', 'UF_COLOR', 'UF_BIG', 'UF_FIRST_BLOCK')
);
while($row = $res->fetch())
{
    $arResult['SECTIONS_WITH_ITEMS'][$row['ID']] = $row;
    $ufColors[$row['UF_COLOR']] = null;
}

$rsEnum = \CUserFieldEnum::GetList(array(), array("ID" =>array_keys($ufColors)));
while($arEnum = $rsEnum->GetNext())
    $ufColors[$arEnum["ID"]] = $arEnum["XML_ID"];

foreach($arResult['ITEMS'] as $arItem)
{
    if(empty($arResult['SECTIONS_WITH_ITEMS'][$arItem['IBLOCK_SECTION_ID']]))
        continue;
    $arResult['SECTIONS_WITH_ITEMS'][$arItem['IBLOCK_SECTION_ID']]['ITEMS'][$arItem['ID']] = $arItem;
    if(isset($ufColors[$arResult['SECTIONS_WITH_ITEMS'][$arItem['IBLOCK_SECTION_ID']]['UF_COLOR']]))
        $arResult['SECTIONS_WITH_ITEMS'][$arItem['IBLOCK_SECTION_ID']]['UF_COLOR'] = $ufColors[$arResult['SECTIONS_WITH_ITEMS'][$arItem['IBLOCK_SECTION_ID']]['UF_COLOR']];
}
