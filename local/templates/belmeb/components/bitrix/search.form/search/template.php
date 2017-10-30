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
$this->setFrameMode(true);?>
<form class="searchbox" action="<?=$arResult["FORM_ACTION"]?>">
    <div class='searchbox-bg'>
        <input type="search" placeholder="Я ищу... например, диван" name="q"
               class="searchbox-input" onkeyup="buttonUp();" required="" autocomplete="off">
    </div>
    <input type="submit" name="s" class="searchbox-submit" value="">
    <div class="search-link searchbox-icon"></div>

</form>