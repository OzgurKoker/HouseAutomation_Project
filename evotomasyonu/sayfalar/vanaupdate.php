<?php
include 'baglan.php';


if (isset($_POST['ON'])) {

	$sql = "UPDATE statusled SET Stat = 1 WHERE ID=3";
	date_default_timezone_set('Europe/Istanbul');

	$tarih = date('Y.m.d H:i:s');
 
	$log1 = $db->query("INSERT INTO log_vana(log_acik) VALUES('$tarih')");
	if ($db->query($sql) === TRUE) {
	}
}

if (isset($_POST['OFF'])) {

	$sql = "UPDATE statusled SET Stat = 0 WHERE ID=3";
    date_default_timezone_set('Europe/Istanbul');
      $tarih = date('Y.m.d H:i:s');
      $log2 = $db->query("UPDATE log_vana SET log_kapali='$tarih' WHERE log_kapali=0");
	if ($db->query($sql) === TRUE) {
	}
}
header("Location: evotomasyonu.php");
