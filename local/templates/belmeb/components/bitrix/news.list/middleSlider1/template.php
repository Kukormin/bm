<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

if(empty($arResult['SECTIONS_WITH_ITEMS']))
    return;

$strEditLink = \CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$strDeleteLink = \CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$confirmDelete = array('CONFIRM' => \GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'));
?>
<section class='sale-items'>
    <div class='sale-items-block'>
        <?foreach($arResult['SECTIONS_WITH_ITEMS'] as $arSection):
            if(empty($arSection['ITEMS']) || !isset($arSection['UF_FIRST_BLOCK']))
                continue;
            ?>

            <?if(!isset($currentBlock)):
                $currentBlock = $arSection['UF_FIRST_BLOCK'];?>
                <div class='sale-items-block-half'>
            <?else:?>
                <?if($currentBlock != $arSection['UF_FIRST_BLOCK']):
                    $currentBlock = $arSection['UF_FIRST_BLOCK'];?>
                    </div>
                    <div class='sale-items-block-half'>
                <?endif?>
            <?endif?>

            <?if($arSection['UF_BIG']):?>
                <div class='sale-items-list <?=$arSection['UF_COLOR']?>'>
            <?else:?>
                    <div class='new-items-list'>
                        <div class='new-items-slider <?=$arSection['UF_COLOR']?>'>
            <?endif;?>

            <? foreach($arSection["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strEditLink);
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strDeleteLink, $confirmDelete);
                ?>
                <a href="<?=$arItem['PROPERTIES']['URL']['VALUE']?>" class='sale-item' style='background: url("<?=$arItem['PREVIEW_PICTURE']['SRC']?>");' id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <div class='inner'>
                        <div class='sale-items-collection'><?=$arItem['NAME']?></div>
                        <div class='sale-items-title'><?=$arItem['DETAIL_TEXT']?></div>
                        <div class='sale-items-more'>смотреть</div>
                    </div>
                </a>
            <? endforeach; ?>

            <?if($arSection['UF_BIG']):?>
                    </div>
            <?else:?>
                    </div>
                </div>
            <?endif;?>
        <?endforeach;?>
        </div>
    </div>
</section>
