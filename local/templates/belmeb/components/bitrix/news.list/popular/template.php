<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strEditLink);
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strDeleteLink, $confirmDelete);
	?>
    <div class='popular-goods-item' id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <a href="#" class="popular-item-like"></a>
        <div class='popular-item' style='background: url("<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>");'>
            <div class='popular-item-hover'>
                <a href='#' class='popular-order-link'><img src='<?=SITE_DIR?>img/call-back-icon.png' alt="Позвонить"></a>
                <a href='<?=$arItem['PROPERTIES']['URL']['VALUE']?>' class='popular-more-link'><img src='<?=SITE_DIR?>img/quick-view-icon.png' alt="Быстрый просмотр"></a>
            </div>
        </div>
        <a href='<?=$arItem['PROPERTIES']['URL']['VALUE']?>' class='popular-goods-item-title'><?=$arItem['NAME']?></a>
        <a href='<?=$arItem['PROPERTIES']['URL']['VALUE']?>' class='popular-goods-item-price'>
            от <?=SaleFormatCurrency($arItem['PROPERTIES']['PRICE']['VALUE'], 'RUB')?>
        </a>
    </div>
<?endforeach;?>
