<?php
$connect_error = '�� ���� ������������ � ����!';

$mysql_host = 'localhost'; //���� ��
$mysql_user = 'user'; //���� ��
$mysql_pass = 'password'; //������ ��
$mysql_db = 'baza'; //���� � ���������

$mysql_iconomy_table = 'iConomy'; //������� ������� iConomy
$mysql_jobs_table = 'jobs'; //������� ������� Jobs

$jobs_assoc_translate = array('Miner' => '�����', 
	'Farmer' => '������', 
	'Digger' => '��������', 
	'Builder' => '���������', 
	'Hunter' => '�������', 
	'Fisherman' => '�����'); //���������� ��������
$jobs_nojob = '�����������';

$config_limit = 10; //���������� ��������� �������
$config_mineface_url = 'http://best-minecraft.ru/mineface/face.php'; //���� � face.php


if (!mysql_connect($mysql_host, $mysql_user, $mysql_pass)||!mysql_select_db($mysql_db)) {
	die($connect_error);
}
?>