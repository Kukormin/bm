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

                    foreach ($arResult["ITEMS"] as $arItem): ?>
                        <?
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <a href="<?= $arItem['PROPERTIES']['URL']['VALUE'] ?>" class='sale-item'
                           style='background: url("<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>");'>
                            <div class='inner' id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                                <div class='sale-items-collection'><?= $arItem['NAME'] ?></div>
                                <div class='sale-items-title'><?= $arItem['DETAIL_TEXT'] ?></div>
                                <div class='sale-items-more'>смотреть</div>
                            </div>
                        </a>
                    <? endforeach; ?>