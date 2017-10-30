<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("О сайте");
?>
...
<? if (!$USER->IsAuthorized()): ?>
	<? $APPLICATION->IncludeComponent('bitrix:system.auth.authorize', '', array('AUTH_RESULT' => $APPLICATION->arAuthResult)); ?>
<? endif; ?>
...
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>