<?php
$connect_error = 'Не могу подключиться к базе!';

$mysql_host = 'localhost'; //хост БД
$mysql_user = 'user'; //юзер БД
$mysql_pass = 'password'; //пароль БД
$mysql_db = 'baza'; //база с таблицами

$mysql_iconomy_table = 'iConomy'; //таблица плагина iConomy
$mysql_jobs_table = 'jobs'; //таблица плагина Jobs

$jobs_assoc_translate = array('Miner' => 'Шахтёр', 
	'Farmer' => 'Фермер', 
	'Digger' => 'Копатель', 
	'Builder' => 'Строитель', 
	'Hunter' => 'Охотник', 
	'Fisherman' => 'Рыбак'); //Ассоциации перевода
$jobs_nojob = 'Безработный';

$config_limit = 10; //Количество выводимых игроков
$config_mineface_url = 'http://best-minecraft.ru/mineface/face.php'; //Путь к face.php


if (!mysql_connect($mysql_host, $mysql_user, $mysql_pass)||!mysql_select_db($mysql_db)) {
	die($connect_error);
}
?>