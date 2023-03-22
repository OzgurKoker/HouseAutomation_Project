<?php 
include 'baglan.php';
$isikdurum = $db->query("SELECT * FROM statusled WHERE id=1 ")->fetch(PDO::FETCH_ASSOC); 
echo $isikdurum['Stat']
?>