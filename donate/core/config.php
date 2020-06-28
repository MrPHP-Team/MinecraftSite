<?php
// Файл конфигурации.

$settings = array(
	'site' => array(
		'title' => 'TradeMC Onepage',				// Название сайта
		'description' => 'by CarryLove',		// Описание сайта
		'url' => 'https://trade.nsoq.ru/',			// URL сайта
	),
	'trade' => array(
		'id' => '1',
	),
);


$getitems = file_get_contents('https://api.trademc.org/Shop.getItems?params[shop]='.$settings['trade']['id']);
$getitems = json_decode($getitems);

?>
