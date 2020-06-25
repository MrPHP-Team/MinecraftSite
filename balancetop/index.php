<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Начинаем кэшировать
if ($top = readCache('top.cache', 604800)) { // 604800(неделя) - интервал обновления кэша
	echo $top; // Вывод страницы из кэша
	exit(); // Прекращение выполнения скрипта
}
// Начинаем буферизацию вывода
ob_start();


require ('config.php');
// Коннектимся с БД
$icon = @mysql_query("SELECT username, balance FROM $mysql_iconomy_table ORDER BY balance DESC LIMIT $config_limit");
$jobs = @mysql_query("SELECT username, job FROM $mysql_jobs_table");
?>
<style>
@import "/style.css" screen;
</style>
<div style="margin: 0 auto">
	<center>
		<h1>Топ-<?php echo $config_limit ?> богачей</h1>
	</center>
	<table style="margin: 0 auto" border="0" cellpadding="3"
		cellspacing="10" id="minimalist">
		<tr>
			<td width="50"><strong>Место</strong></td>
			<td width="30"><strong>Аватар</strong></td>
			<td width="30"><strong>Ник</strong></td>
			<td width="30"><strong>Работа</strong></td>
			<td width="30"><strong>Баланс</strong></td>
		</tr>
		<?php
		$rank = 0;
		$job = '';
		$jobs_assoc = array();
		if($jobs) {
			while($row = mysql_fetch_assoc($jobs)) {
				$jobs_assoc[strtolower($row['username'])] = array('nickname' => $row['username'], 'job' => $row['job']);
			}
		}
		if($icon) {
			unset($row);
			while($row = mysql_fetch_assoc($icon)) {
				$username = $row['username'];
				if($jobs) {
					$jobdata = @$jobs_assoc[$username];
					$job = @$jobs_assoc_translate[$jobdata['job']];
				}
				$jobsnick = $jobdata['nickname'];
				if($jobsnick)
					$username = $jobsnick;
				if(!$job) {
					$job = $jobs_nojob;
				}

				$balance = $row['balance'];
				$url = $config_mineface_url . '?username=' . urlencode($username);
				$faceimg = get_url_contents($url);
				echo "<tr>";
				echo "<td><strong>" . ++$rank . "</strong></td>";
				echo "<td><strong>$faceimg</strong></td>";
				echo "<td><strong>$username</strong></td>";
				echo "<td><strong>$job</strong></td>";
				echo "<td><strong>$balance</strong></td>";
				echo "</tr>";
			}
		}

		$top = ob_get_contents();
		ob_clean();
		writeCache($top, 'top.cache');

		// останавливаем буферизацию
		ob_end_clean();

		// Выводим содержимое страницы
		echo $top;
		?>
	</table>
	<?php


	function get_url_contents($echo){
	        $crl = @curl_init();
	        if(!$crl)
	        	return file_get_contents($echo);
	        $timeout = 5;
	        curl_setopt ($crl, CURLOPT_URL,$echo);
	        curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
	        curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
	        $ret = curl_exec($crl);
	        curl_close($crl);
	        return $ret;
	}
	/*
	 * Запись кэш-файла
	* @param string contents – содержание буфера
	* @param string filename – имя файла, используемое при создании кэш-файла
	* @return void
	*/
	function writeCache($content, $filename) {
		$fp = fopen('./cache/' . $filename, 'wb');
		fwrite($fp, $content);
		fclose($fp);
	}

	/*
	 * Проверка кэш-файлов
	* @param string filename – имя проверяемого кэш-файла
	* @param int expiry – максимальный «возраст» файла в секундах
	* @return mixed содержимое кэша или false
	*/
	function readCache($filename, $expiry) {
		if (file_exists('./cache/' . $filename)) {
			if ((time() - $expiry) > filemtime('./cache/' . $filename))
				return FALSE;
			$cache = file('./cache/' . $filename);
			return implode('', $cache);
		}
		return FALSE;
	}

	?>