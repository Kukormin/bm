<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) 
	//LocalRedirect($backurl);
//LocalRedirect(SITE_DIR);
$APPLICATION->SetTitle("Вход на сайт");
?><p>
	Вы зарегистрированы и успешно авторизовались.
</p>
<p>
	<a href="<?=SITE_DIR?>">Вернуться на главную страницу</a>
</p>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>