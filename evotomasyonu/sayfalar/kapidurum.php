<?php 
include 'baglan.php';
$kapidurum = $db->query("SELECT * FROM statusled WHERE id=4 ")->fetch(PDO::FETCH_ASSOC); 
echo $kapidurum['Stat']
?>