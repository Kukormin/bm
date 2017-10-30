<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Каталог");

function slider($SECTION_ID){
    $GLOBALS['APPLICATION']->IncludeComponent(
        "bitrix:news.list",
        "catalogSlider",
        Array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "Y",
            "COMPONENT_TEMPLATE" => "catalogSlider",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array(0=>"",1=>"",),
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "5",
            "IBLOCK_TYPE" => "Contect",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "N",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "20",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => $SECTION_ID,
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array(0=>"",1=>"",),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "ASC",
            "STRICT_SECTION_CHECK" => "N"
        )
    );
}

?>
    <div class="head-block" style='background:url("<?=SITE_DIR?>img/catalog/head-bg.jpg");'>
        <h1><? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR . "include/main/catalog/catalog.php"
                )
            ); ?></h1>
    </div>

    <section class='sections-list'>

        <div class='sec-list-half'>

            <div class='sec-list-item'>
                <div class='sec-list-slider'>
                    <div class='sec-list-items'>
                        <? slider(59); ?>
                    </div>
                </div>
                <div class='sec-list-title' style='background:url("<?=SITE_DIR?>img/catalog/soft-bg.png");'>
                    <div class='inner'>
                        <div class='section-icon' style='background:url("<?=SITE_DIR?>img/catalog/soft-icon.png");'></div>
                        <div class='section-title'><? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/med1.php"
                                )
                            ); ?></div>
                        <a class='btn btn-orange' href='#'><? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/incatalog.php"
                                )
                            ); ?></a>
                    </div>
                </div>
            </div>


            <div class='sections-list-utp'>
                <div class='utp-item-outer'>
                    <div class='utp-item'>
                        <div class='inner'>
                            <div class='border'><span><? $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        Array(
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH" => SITE_DIR . "include/main/catalog/do.php"
                                        )
                                    ); ?></span></div>
                            <div class='big-number'><? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "include/main/catalog/num.php"
                                    )
                                ); ?></div>
                            <div class='border'><span><? $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        Array(
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH" => SITE_DIR . "include/main/catalog/mou.php"
                                        )
                                    ); ?></span></div>
                            <div class='medium'><? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "include/main/catalog/garan.php"
                                    )
                                ); ?></div>
                        </div>
                    </div>
                </div>
                <div class='utp-item-outer'>
                    <div class='utp-item'>
                        <div class='inner'>
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/catalog/nameb.php"
                                )
                            ); ?>
                            <div class='border'><span><? $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        Array(
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH" => SITE_DIR . "include/main/catalog/s.php"
                                        )
                                    ); ?></span></div>
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/catalog/ear.php"
                                )
                            ); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class='sec-list-item'>
                <div class='sec-list-slider'>
                    <div class='sec-list-items'>
                        <? slider(62); ?>
                    </div>
                </div>
                <div class='sec-list-title' style='background:url("<?=SITE_DIR?>img/catalog/exhibition-bg.png");'>
                    <div class='inner'>
                        <div class='section-icon' style='background:url("<?=SITE_DIR?>img/catalog/exhibition-icon.png");'></div>
                        <div class='section-title'><? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/med5.php"
                                )
                            ); ?></div>
                        <a class='btn btn-red' href='#'><? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/incatalog.php"
                                )
                            ); ?></a>
                    </div>
                </div>
            </div>

            <div class='sections-list-utp'>

                <div class='utp-item-outer sm big'>
                    <div class='utp-item'>
                        <div class='inner'>
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/catalog/of.php"
                                )
                            ); ?>
                        </div>
                    </div>
                </div>

            </div>


            <div class='sec-list-item'>
                <div class='sec-list-slider'>
                    <div class='sec-list-items'>
                        <? slider(65); ?>
                    </div>
                </div>
                <div class='sec-list-title' style='background:url("<?=SITE_DIR?>img/catalog/mattresses-bg.png");'>
                    <div class='inner'>
                        <div class='section-icon' style='background:url("<?=SITE_DIR?>img/catalog/mattresses-icon.png");'></div>
                        <div class='section-title'><? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/med6.php"
                                )
                            ); ?></div>
                        <a class='btn btn-gray' href='#'><? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/incatalog.php"
                                )
                            ); ?></a>
                    </div>
                </div>
            </div>

        </div>



        <div class='sec-list-half'>

            <div class='sec-list-item'>
                <div class='sec-list-slider'>
                    <div class='sec-list-items'>
                        <? slider(60); ?>
                    </div>
                </div>
                <div class='sec-list-title' style='background:url("<?=SITE_DIR?>img/catalog/carcass-bg.png");'>
                    <div class='inner'>
                        <div class='section-icon' style='background:url("<?=SITE_DIR?>img/catalog/carcass-icon.png");'></div>
                        <div class='section-title'><? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/med2.php"
                                )
                            ); ?></div>
                        <a class='btn btn-red' href='#'><? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/incatalog.php"
                                )
                            ); ?></a>
                    </div>
                </div>
            </div>

            <div class='sec-list-item'>
                <div class='sec-list-slider'>
                    <div class='sec-list-items'>
                        <? slider(61); ?>
                    </div>
                </div>
                <div class='sec-list-title' style='background:url("<?=SITE_DIR?>img/catalog/office-bg.png");'>
                    <div class='inner'>
                        <div class='section-icon' style='background:url("<?=SITE_DIR?>img/catalog/office-icon.png");'></div>
                        <div class='section-title'><? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/med3.php"
                                )
                            ); ?></div>
                        <a class='btn btn-gray' href='#'><? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/incatalog.php"
                                )
                            ); ?></a>
                    </div>
                </div>
            </div>

            <div class='sec-list-item'>
                <div class='sec-list-slider'>
                    <div class='sec-list-items'>
                        <? slider(64); ?>
                    </div>
                </div>
                <div class='sec-list-title' style='background:url("<?=SITE_DIR?>img/catalog/twigs-bg.png");'>
                    <div class='inner'>
                        <div class='section-icon' style='background:url("<?=SITE_DIR?>img/catalog/twigs-icon.png");'></div>
                        <div class='section-title'><? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/med4.php"
                                )
                            ); ?></div>
                        <a class='btn btn-gray' href='#'><? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/incatalog.php"
                                )
                            ); ?></a>
                    </div>
                </div>
            </div>

            <div class='sections-list-utp'>

                <div class='utp-item-outer sm'>
                    <div class='utp-item'>
                        <div class='inner'><? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/catalog/than.php"
                                )
                            ); ?>
                        </div>
                    </div>
                </div>

                <div class='utp-item-outer sm'>
                    <div class='utp-item'>
                        <div class='inner'><? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/catalog/yst.php"
                                )
                            ); ?>
                        </div>
                    </div>
                </div>

            </div>

            <div class='sec-list-item'>
                <div class='sec-list-slider'>
                    <div class='sec-list-items'>
                        <? slider(63); ?>
                    </div>
                </div>
                <div class='sec-list-title' style='background:url("<?=SITE_DIR?>img/catalog/decor-bg.png");'>
                    <div class='inner'>
                        <div class='section-icon' style='background:url("<?=SITE_DIR?>img/catalog/decor-icon.png");'></div>
                        <div class='section-title'><? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/med7.php"
                                )
                            ); ?></div>
                        <a class='btn btn-orange' href='#'><? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/incatalog.php"
                                )
                            ); ?></a>
                    </div>
                </div>
            </div>


        </div>

    </section>

    </div>
<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>