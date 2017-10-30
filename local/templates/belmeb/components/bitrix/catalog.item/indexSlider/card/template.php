<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */
?>
<div class='item'>
    <a href='<?= $item['DETAIL_PAGE_URL'] ?>' class='new-item-like'></a>
    <a class="new-item" href='<?= $item['DETAIL_PAGE_URL'] ?>'>
        <div class="new-item-img" style='background: url("<?=$item['PREVIEW_PICTURE']['SRC']?>") no-repeat center center;'></div>
        <div class="new-item-name"><?= $productTitle ?></div>
        <div class="new-item-price">От <?=$price['PRINT_RATIO_PRICE']?></div>
    </a>
</div>