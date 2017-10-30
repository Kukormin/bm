<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arResult['SECTION_INFO'] = array();

if (!empty($arParams['PARENT_SECTION'])) {
    if (($res = \CIBlockSection::GetList(
        array(),
        array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ID' => $arParams['PARENT_SECTION']),
        array('nTopCount' => 1),
        array('NAME', 'UF_COLOR', 'UF_SIZE'))
    )
    ) {
        $arResult['SECTION_INFO'] = $res->Fetch();
    }
}