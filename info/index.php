<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("info");
?><div class="head-block" style='background:url("<?=SITE_DIR?>img/info-head-bg.jpg");'>
			<h1>Справочник</h1>
		</div>

		<section class='info'>
			<div class='info-list'>
				<a class='info-item'  href='/info/kak-kupit/'>
					<div class='info-item-inner'>
						<div class='info-item-icon'><span class='iconinfo-buy'></span></div>
						<div class='info-item-title'><? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/info/howto1.php"
                                )
                            ); ?></div>
					</div>
				</a>
				<a class='info-item'  href='/info/o-kompanii/'>
					<div class='info-item-inner'>
						<div class='info-item-icon'><span class='iconinfo-about'></span></div>
						<div class='info-item-title'><? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/info/howto2.php"
                                )
                            ); ?></div>
					</div>
				</a>
				<a class='info-item'  href='/info/kupit-v-kredit/'>
					<div class='info-item-inner'>
						<div class='info-item-icon'><span class='iconinfo-credit'></span></div>
						<div class='info-item-title'><? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/info/how3.php"
                                )
                            ); ?></div>
					</div>
				</a>
				<a class='info-item'  href='/info/postavshchiki/'>
					<div class='info-item-inner'>
						<div class='info-item-icon'><span class='iconinfo-post'></span></div>
						<div class='info-item-title'><? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/info/how4.php"
                                )
                            ); ?></div>
					</div>
				</a>
				<a class='info-item'  href='/info/dizayneram/'>
					<div class='info-item-inner'>
						<div class='info-item-icon'><span class='iconinfo-dis'></span></div>
						<div class='info-item-title'><? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/info/howto5.php"
                                )
                            ); ?></div>
					</div>
				</a>
				<a class='info-item'  href='/info/sertifikaty/'>
					<div class='info-item-inner'>
						<div class='info-item-icon'><span class='iconinfo-sert'></span></div>
						<div class='info-item-title'><? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/info/howto6.php"
                                )
                            ); ?></div>
					</div>
				</a>
				<a class='info-item'  href='/info/politika/'>
					<div class='info-item-inner'>
						<div class='info-item-icon'><span class='iconinfo-data'></span></div>
						<div class='info-item-title'><? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/main/info/howto7.php"
                                )
                            ); ?></div>
					</div>
				</a>
			</div>
		</section>
		<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>