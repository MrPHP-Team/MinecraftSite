<?php
include_once('config.php');
if(isset($_REQUEST['checkprice']) AND isset($_REQUEST['nickname']) AND isset($_REQUEST['buy']) AND $_REQUEST['nickname'] != "" AND $_REQUEST['buy'] != "") {
	$answer = file_get_contents('https://api.trademc.org/Shop.buyItem?params[item]='.$_REQUEST['buy'].'&params[nickname]='.$_REQUEST['nickname'].'&params[success_url]='.$settings['site']['url'].'&params[fail_url]='.$settings['site']['url'].'&params[coupon]='.$_REQUEST['promo']);
	$answer = json_decode($answer);
	if($answer->error->error_msg == 'Указанный купон не найден.') {
		$answer = file_get_contents('https://api.trademc.org/Shop.buyItem?params[item]='.$_REQUEST['buy'].'&params[nickname]='.$_REQUEST['nickname'].'&params[success_url]='.$settings['site']['url'].'&params[fail_url]='.$settings['site']['url']);
		$answer = json_decode($answer);
	}
	echo '<button type="submit" class="btn btn-success btn-block">Купить услугу за '.$answer->response->cost.' рублей</button>';
} elseif(!isset($_REQUEST['checkprice']) AND isset($_REQUEST['nickname']) AND isset($_REQUEST['buy']) AND $_REQUEST['nickname'] != "" AND $_REQUEST['buy'] != "") {
	$answer = file_get_contents('https://api.trademc.org/Shop.buyItem?params[item]='.$_REQUEST['buy'].'&params[nickname]='.$_REQUEST['nickname'].'&params[success_url]='.$settings['site']['url'].'&params[fail_url]='.$settings['site']['url'].'&params[coupon]='.$_REQUEST['promo']);
	$answer = json_decode($answer);
	if($answer->error->error_msg == 'Указанный купон не найден.') {
		$answer = file_get_contents('https://api.trademc.org/Shop.buyItem?params[item]='.$_REQUEST['buy'].'&params[nickname]='.$_REQUEST['nickname'].'&params[success_url]='.$settings['site']['url'].'&params[fail_url]='.$settings['site']['url']);
		$answer = json_decode($answer);
	}
	echo '<meta http-equiv="refresh" content="0;https://api.trademc.org/Shop.userTransfer?params[data]='.$answer->response->data.'">';

} else {
	echo '<button type="submit" class="btn btn-default btn-block disabled">Заполните форму</button>';
}

?>
