<?php 
include 'baglan.php';
$vanadurum = $db->query("SELECT * FROM statusled WHERE id=3 ")->fetch(PDO::FETCH_ASSOC); 
echo $vanadurum['Stat']
?>