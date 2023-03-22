<?php
class statusled2{
 
 function __construct($veri){
  $this->connect();
  $this->storeInDB($veri);
 }
 
 function connect(){
  $this->link = mysqli_connect('localhost','root','') or die('Cannot connect to the DB');
  mysqli_select_db($this->link,'dbstatusled') or die('Cannot select the DB');
 }
 
 function storeInDB($veri){
  $query = "UPDATE statusled set  Stat='$veri'WHERE ID=5";
  $result = mysqli_query($this->link,$query) or die('Errant query:  '.$query);


 }
 
}

if($_GET['Stat'] != ''){
 $dht11=new statusled2($_GET['Stat']);

}
?>