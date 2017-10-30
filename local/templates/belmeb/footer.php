<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
</div>
<footer>
    <section class='footer-light' id='catalog-bottom'>
        <div class='title'><? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR . "include/main/catalogname.php"
                )
            ); ?></div>
        <nav class='catalog-nav'>
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR . "include/main/catalog.php"
                )
            ); ?>
        </nav>
    </section>
    <section class='footer-gray'>
        <div class='adress-block'>
            <div class='adress-block-title'><? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/main/kmv.php"
                    )
                ); ?></div>
            <div class="tabs">
                <input id="tab1" type="radio" name="tabs" class='list active'>
                <label for="tab1">Список</label>

                <input id="tab2" type="radio" name="tabs" class='maps kmv'>
                <label for="tab2">На карте</label>

                <section id="content1">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/main/office/ptg.php"
                        )
                    ); ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/main/office/inoz.php"
                        )
                    ); ?>

                </section>
                <section id="content2">
                    <div class='content-map map-1'>
                        <script type="text/javascript" charset="utf-8" async
                                src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=4ot4c0z7Np4P1MzTmJBw6xiJFamMgSSi&amp;width=100%&amp;height=500&amp;lang=ru_RU&amp;sourceType=constructor&amp;scroll=true"></script>
                    </div>
                </section>
            </div>


        </div>
        <div class='adress-block'>
            <div class='adress-block-title'><? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/main/stavrap.php"
                    )
                ); ?></div>
            <div class="tabs">
                <input id="tab3" type="radio" name="tabs2" class='list active'>
                <label for="tab3">Список</label>

                <input id="tab4" type="radio" name="tabs2" class='maps stav'>
                <label for="tab4">На карте</label>

                <section id="content3">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/main/office/stav.php"
                        )
                    ); ?>
                </section>
                <section id="content4">
                    <div class='content-map map-2'>
                        <script type="text/javascript" charset="utf-8" async
                                src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=Lt6mb3ImG_z-7lDDIoY3tNsJ9XRcXcon&amp;width=100%&amp;height=500&amp;lang=ru_RU&amp;sourceType=constructor&amp;scroll=true"></script>
                    </div>
                </section>
            </div>
        </div>
        <div class='bottom-menu'>
            <div class='empty'></div>
            <div class='footer-call-back'>
                <b><? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/main/number.php"
                        )
                    ); ?></b>
                <a href="#"><? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/main/backcall.php"
                        )
                    ); ?></a>
            </div>
            <br>
            <ul class='footer-menu'>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "main",
                    Array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "left",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(0=>"",),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "top",
                        "USE_EXT" => "N"
                    )
                );?>
            </ul>
        </div>
        <div class='subscribe-block'>
            <div class='subscribe-block-title'><? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/main/subscribe.php"
                    )
                ); ?></div>
            <?$APPLICATION->IncludeComponent("bitrix:sender.subscribe", "sub", Array(
                "COMPONENT_TEMPLATE" => ".default",
                "USE_PERSONALIZATION" => "Y",	// Определять подписку текущего пользователя
                "CONFIRMATION" => "Y",	// Запрашивать подтверждение подписки по email
                "SHOW_HIDDEN" => "N",	// Показать скрытые рассылки для подписки
                "AJAX_MODE" => "N",	// Включить режим AJAX
                "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
                "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
                "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
                "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
                "CACHE_TYPE" => "A",	// Тип кеширования
                "CACHE_TIME" => "3600",	// Время кеширования (сек.)
                "SET_TITLE" => "Y",	// Устанавливать заголовок страницы
            ),
                false
            );?>
            <div class='social-link'>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/main/fb.php"
                    )
                ); ?>

                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/main/inst.php"
                    )
                ); ?>
            </div>
        </div>
    </section>
    <section class='footer-dark'>
        <div>
            <div class='logo'><a href='/'><img src='<?=SITE_DIR?>img/logo.png'></a></div>
            <div class='copyright'><? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/main/copyright.php"
                    )
                ); ?>
            </div>
        </div>
        <div class='created'><a href='/'><img src='<?=SITE_DIR?>img/webmaster.png'></a></div>
    </section>
</footer>
<div style="display:none;">
    <div id="call-form" style="width:555px;" class='call-order-form'>
        <div class='form-item-img' style='background: url(<?=SITE_DIR?>img/color-item.jpg);'></div>
        <div class='form-item-form'>
            <div class='title'><? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/main/backcall.php"
                    )
                ); ?></div>
            <div class='form-text'><? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/main/dontsr.php"
                    )
                ); ?>
            </div>
            <form class='call-order' id="formMain" onsubmit="return false">

                <input type='text' name="name" placeholder='Имя'>
                <div id="name"></div>

                <input type='text' name="telephone" style="padding-left: 35px;background: url('<?=SITE_DIR?>img/form-tel-icon.png') no-repeat 10px center" placeholder='Телефон'>
                <div id="telephone"></div>

                <input class='form-city' name="city" type='text' placeholder='Город'>
                <div id="city"></div>

                <input type='submit' onclick="backCallValidator();" value='заказать звонок'>

                <div id="answer" style="display: none;">
                    Ваш обязательно перезвонят
                </div>
            </form>
        </div>
    </div>
</div>
<div style="display:none;width:555px;">
    <div id="form-email" style="width:555px;" class='call-order-form'>
        <div class='form-item-img' style='background: url(<?=SITE_DIR?>img/form-bg.jpg);'></div>
        <div class='form-item-form'>
            <div class='title'><? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/main/writemessage.php"
                    )
                ); ?></div>
            <div class='form-text'><? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/main/dontsr.php"
                    )
                ); ?>
            </div>
            <form class='call-order' id="formMain1" onsubmit="return false">

                <input type='text' name="name1" placeholder='Имя'>
                <div id="name1"></div>

                <input type='text' name="telephone1" style="padding-left: 35px;background: url('<?=SITE_DIR?>img/form-tel-icon.png') no-repeat 10px center" placeholder='Телефон'>
                <div id="telephone1"></div>

                <input class='form-city' name="city1" type='text' placeholder='Город'>
                <div id="city1"></div>

                <label>
                    <textarea name="text" placeholder="Ваше сообщение"></textarea>
                    <div id="text"></div>
                </label>


                <input type='submit' onclick="backCallValidator1();" value='заказать звонок'>
                <div id="answer1" style="display: none;">
                    Ваше сообщение оставлено
                </div>

            </form>
        </div>
    </div>
</div>
<div id="overlay"></div>
<div class="search-fix">
    <div class="search">
        <div class="search-outer">
            <?$APPLICATION->IncludeComponent(
                "bitrix:search.form",
                "search",
                Array(
                    "PAGE" => "#SITE_DIR#search/index.php",
                    "USE_SUGGEST" => "N"
                )
            );?>
        </div>
    </div>
</div>
<div class="toTop"><img src='<?=SITE_DIR?>img/toTop.png'></div>
</body>
</html>
