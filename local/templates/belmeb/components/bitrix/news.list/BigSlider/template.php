<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
$this->setFrameMode(true);

if(empty($arResult['ITEMS']))
    return ;

$strEditLink = \CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$strDeleteLink = \CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$confirmDelete = array('CONFIRM' => \GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'));
?>
<section class='top-banner-main'>
    <div id='top-slider' class='top-banner'>
        <? foreach ($arResult["ITEMS"] as $arItem):
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strEditLink);
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strDeleteLink, $confirmDelete);
            if(empty($arItem['PREVIEW_PICTURE']['SRC']))
                continue;
            ?>
            <div class='item-banner' style='background: url("<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>");' >
                <div class='inner' id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <div class='banner-gray-title'
                         data-animation="animated zoomInLeft"><?= $arItem['PROPERTIES']['FIRST']['VALUE'] ?></div>
                    <div class='banner-title'
                         data-animation="animated flipInX"><?= $arItem['PROPERTIES']['SECOND']['VALUE'] ?></div>
                    <a href='<?= $arItem['PROPERTIES']['URL']['VALUE'] ?>' class='btn item-banner-btn'
                       data-animation="animated lightSpeedIn"><?= $arItem['PROPERTIES']['TEXT']['VALUE'] ?></a>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</section>

