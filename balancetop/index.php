<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

// �������� ����������
if ($top = readCache('top.cache', 604800)) { // 604800(������) - �������� ���������� ����
	echo $top; // ����� �������� �� ����
	exit(); // ����������� ���������� �������
}
// �������� ����������� ������
ob_start();


require ('config.php');
// ����������� � ��
$icon = @mysql_query("SELECT username, balance FROM $mysql_iconomy_table ORDER BY balance DESC LIMIT $config_limit");
$jobs = @mysql_query("SELECT username, job FROM $mysql_jobs_table");
?>
<style>
@import "/style.css" screen;
</style>
<div style="margin: 0 auto">
	<center>
		<h1>���-<?php echo $config_limit ?> �������</h1>
	</center>
	<table style="margin: 0 auto" border="0" cellpadding="3"
		cellspacing="10" id="minimalist">
		<tr>
			<td width="50"><strong>�����</strong></td>
			<td width="30"><strong>������</strong></td>
			<td width="30"><strong>���</strong></td>
			<td width="30"><strong>������</strong></td>
			<td width="30"><strong>������</strong></td>
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

		// ������������� �����������
		ob_end_clean();

		// ������� ���������� ��������
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
	 * ������ ���-�����
	* @param string contents � ���������� ������
	* @param string filename � ��� �����, ������������ ��� �������� ���-�����
	* @return void
	*/
	function writeCache($content, $filename) {
		$fp = fopen('./cache/' . $filename, 'wb');
		fwrite($fp, $content);
		fclose($fp);
	}

	/*
	 * �������� ���-������
	* @param string filename � ��� ������������ ���-�����
	* @param int expiry � ������������ �������� ����� � ��������
	* @return mixed ���������� ���� ��� false
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