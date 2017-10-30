<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
use Bitrix\Main\Page\Asset;

global $asset;
$asset = Asset::getInstance();
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><? $APPLICATION->ShowTitle(); ?></title>
    <meta name="description" content="">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i,900,900i" rel="stylesheet">
    <? $APPLICATION->ShowHead();

    $asset->addCss(SITE_DIR . 'css/fonts/fonts.css');
    $asset->addCss(SITE_DIR . 'css/normalize.css');
    $asset->addCss(SITE_DIR . 'css/animate.min.css');
    $asset->addCss(SITE_DIR . 'slick/slick.css');
    $asset->addCss(SITE_DIR . 'slick/slick-theme.css');
    $asset->addCss(SITE_DIR . 'css/jquery.jscrollpane.css"');
    $asset->addCss(SITE_DIR . 'css/customSelectBox.css"');
    $asset->addCss(SITE_DIR . 'css/main.css');
    $asset->addCss(SITE_DIR . 'css/media.css');
    $asset->addCss(SITE_DIR . 'owl/owl.carousel.css');
    $asset->addCss(SITE_DIR . 'fancybox/jquery.fancybox.css');
    $asset->addCss(SITE_DIR . 'css/custom.css');

    $asset->addJs(SITE_DIR . 'js/jquery-1.12.0.min.js');
    $asset->addJs(SITE_DIR . 'js/jScrollPane.js');
    $asset->addJs(SITE_DIR . 'js/jquery.mousewheel.js');
    $asset->addJs(SITE_DIR . 'js/SelectBox.js');
    $asset->addJs(SITE_DIR . 'owl/owl.carousel.min.js');
    $asset->addJs(SITE_DIR . 'slick/slick.js');
    $asset->addJs(SITE_DIR . 'fancybox/jquery.fancybox.js');
    $asset->addJs(SITE_DIR . 'js/jquery.sticky.js');
    $asset->addJs(SITE_DIR . 'js/backcall.js');
    $asset->addJs(SITE_DIR . 'js/main.js');
    $asset->addJs(SITE_DIR . 'js/spryt.js');

    ?>


</head>
<body>

<? $APPLICATION->ShowPanel(); ?>

<section class='mobile-menu-bottom' id='scroll'>
    <ul class='mobile-main-menu'>
        <li><a href='#catalog-bottom'>Каталог</a></li>
        <li>
            <div class="basket">
                <a href="#" class="basket-count-link">0</a>
                <a href="#" class="basket-link"><span class='icon-basket'></span></a>
            </div>
        </li>
        <li><a href="#" class="contacts-link"></a></li>
        <li><a href="#" id='m_search_form' class="search-link"><span class='icon-search'></span></a></li>
        <li>
            <div class="mobile-menu"></div>
        </li>
    </ul>
</section>
<div id="modal_search_form">
    <span id="modal_close">Отменить</span>
    <?$APPLICATION->IncludeComponent("bitrix:search.form", "searchHeader", Array(
        "PAGE" => "#SITE_DIR#search/index.php",	// Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
        "USE_SUGGEST" => "N"
    ),
        false
    );?>


</div>
<div id="overlay"></div>
<div class='main_menu main_menu_m'>
    <? $APPLICATION->IncludeComponent(
        "bitrix:menu",
        "mobile",
        Array(
            "ALLOW_MULTI_SELECT" => "N",
            "CHILD_MENU_TYPE" => "left",
            "DELAY" => "N",
            "MAX_LEVEL" => "1",
            "MENU_CACHE_GET_VARS" => array(0 => "",),
            "MENU_CACHE_TIME" => "3600",
            "MENU_CACHE_TYPE" => "N",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "ROOT_MENU_TYPE" => "top",
            "USE_EXT" => "N"
        )
    ); ?>
</div>

<header>

    <div class='top-section-action'><? $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_DIR . "include/main/topbaner.php"
            )
        ); ?></div>
    <div class='top-section'>
        <div class='logo'><a href='/'><img src='<?= SITE_DIR ?>img/logo.png'></a></div>
        <nav class='top-nav'>
            <ul class='top-menu'>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "main",
                    Array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "left",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(0 => "",),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "top",
                        "USE_EXT" => "N"
                    )
                ); ?>
            </ul>
        </nav>
        <div class='call-back'>
            <div class='call-back-inner'>
                <span class='icon-tel'></span>
                <b><? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/main/number.php"
                        )
                    ); ?></b>

                <a id="popup-call" href="#call-form"><? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/main/backcall.php"
                        )
                    ); ?></a>
            </div>
        </div>
        <div class='email'>
            <a id="popup-mail" href="#form-email" class='email-link'><span class='icon-conv'></span></a>
        </div>
        <div class='like'>
            <a href="#" class='like-link'>
                <span class='icon-like'></span>
                <div class='tooltip'>
                    Добавлено в избранное 0 товаров.<br>
                    Понравившиеся вам товары, Вы сможете посмотреть здесь.
                </div>
            </a>
        </div>
        <div class='log-in'>
            <a href="/auth/" class='log-in-link'><span class='icon-login'></span></a>
        </div>
        <div class='search'>
            <div class='search-outer'>
                <?$APPLICATION->IncludeComponent("bitrix:search.form", "searchHeader", Array(
                    "PAGE" => "#SITE_DIR#search/index.php",	// Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
                    "USE_SUGGEST" => "N"
                ),
                    false
                );?>
            </div>
            <!--<a href="#" class='search-link'><span class='icon-search'></span></a>-->
        </div>
        <div class='basket'>
            <a href="#" class='basket-count-link'><?$APPLICATION->IncludeComponent(
                    "bitrix:sale.basket.basket.small",
                    "basket",
                    array(
                        "PATH_TO_BASKET" => "/personal/basket.php",
                        "PATH_TO_ORDER" => "/personal/order.php",
                        "SHOW_DELAY" => "Y",
                        "SHOW_NOTAVAIL" => "Y",
                        "SHOW_SUBSCRIBE" => "Y",
                        "COMPONENT_TEMPLATE" => "basket"
                    ),
                    false
                );?></a>
            <a href="<?=SITE_DIR?>personal/basket/" class='basket-link'><span class='icon-basket'></span></a>
        </div>
    </div>
    <nav class='main-nav'>
        <div class='catalog-menu-outer'>
            <div class='catalog-menu' id="catalog-menu1"></div>
        </div>
        <ul class='main-menu'>
            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "main",
                Array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "left",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(0 => "",),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "topmenu",
                    "USE_EXT" => "N"
                )
            ); ?>
        </ul>
        <div class='catalog-nav catalog-hover'>
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR . "include/main/catalog.php"
                )
            ); ?>
        </div>
    </nav>
</header>
<?if ($APPLICATION->GetCurDir() !== SITE_DIR) :?>
    <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "bread", Array(
        "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
        "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
        "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
    ),
        false
    );?>
<?endif;?>

<div id='body'>