<ul class="catalog-menu">
	<li class="m-red"><a href="<?=SITE_DIR?>catalog/section/myagkaya-mebel/"><i class="catalog-menu-icon"><img src="<?=SITE_DIR?>img/icon-1.png"></i>
	<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/main/med1.php"
	)
);?> </a>
	<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"catalogmenu",
	Array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "N",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "Contect",
		"SECTION_CODE" => "myagkaya-mebel",
		"SECTION_FIELDS" => array("",""),
		"SECTION_ID" => "",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("",""),
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "4",
		"VIEW_MODE" => "LIST"
	)
);?> </li>
</ul>
<ul class="catalog-menu">
	<li class="m-yellow"><a href="<?=SITE_DIR?>catalog/section/korpusnaya-mebel/"><i class="catalog-menu-icon"><img src="<?=SITE_DIR?>img/icon-2.png"></i>
	<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/main/med2.php"
	)
);?> </a>
	<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"catalogmenu",
	Array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "N",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "Contect",
		"SECTION_CODE" => "korpusnaya-mebel",
		"SECTION_FIELDS" => array("",""),
		"SECTION_ID" => "",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("",""),
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "4",
		"VIEW_MODE" => "LIST"
	)
);?> </li>
</ul>
<ul class="catalog-menu">
	<li class="m-blue"><a href="<?=SITE_DIR?>catalog/section/ofisnaya-mebel/"><i class="catalog-menu-icon"><img src="<?=SITE_DIR?>img/icon-3.png"></i><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/main/med3.php"
	)
);?> </a>
	<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"catalogmenu",
	Array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "N",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "Contect",
		"SECTION_CODE" => "ofisnaya-mebel",
		"SECTION_FIELDS" => array("",""),
		"SECTION_ID" => "",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("",""),
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "4",
		"VIEW_MODE" => "LIST"
	)
);?> </li>
	<li class="m-green"><a href="<?=SITE_DIR?>catalog/section/mebel-iz-lozy/"><i class="catalog-menu-icon"><img src="<?=SITE_DIR?>img/icon-4.png"></i><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/main/med4.php"
	)
);?></a><?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"catalogmenu", 
	array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "catalogmenu",
		"COUNT_ELEMENTS" => "N",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "Contect",
		"SECTION_CODE" => "mebel-iz-lozy",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_ID" => "",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "4",
		"VIEW_MODE" => "LIST"
	),
	false
);?></li>
	<li class="m-yellow-2"><a href="<?=SITE_DIR?>catalog/section/mebel-s-eskpozitsii/"><i class="catalog-menu-icon"><img src="<?=SITE_DIR?>img/icon-5.png"></i><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/main/med5.php"
	)
);?></a><?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"catalogmenu",
	Array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "N",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "Contect",
		"SECTION_CODE" => "mebel-s-eskpozitsii",
		"SECTION_FIELDS" => array("",""),
		"SECTION_ID" => "",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("",""),
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "4",
		"VIEW_MODE" => "LIST"
	)
);?></li>
</ul>
<ul class="catalog-menu">
	<li class="m-gray"><a href="<?=SITE_DIR?>catalog/section/matrasy/"><i class="catalog-menu-icon"><img src="<?=SITE_DIR?>img/icon-6.png"></i><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/main/med6.php"
	)
);?></a>
	<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"catalogmenu", 
	array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "N",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "Contect",
		"SECTION_CODE" => "matrasy",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_ID" => "",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "4",
		"VIEW_MODE" => "LIST",
		"COMPONENT_TEMPLATE" => "catalogmenu"
	),
	false
);?> </li>
	<li class="m-gray-light"><a href="<?=SITE_DIR?>catalog/section/interernyy-dekor/"><i class="catalog-menu-icon"><img src="<?=SITE_DIR?>img/icon-7.png"></i><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/main/med7.php"
	)
);?></a><?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"catalogmenu",
	Array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "N",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "Contect",
		"SECTION_CODE" => "interernyy-dekor",
		"SECTION_FIELDS" => array("",""),
		"SECTION_ID" => "",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("",""),
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "4",
		"VIEW_MODE" => "LIST"
	)
);?></li>
</ul>