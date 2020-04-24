<?php

try{
  $pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=statussite", "root","password");
}catch(Exception $e){
  echo 'Exception abgefangen: ',  $e->getMessage(), "\n";
}
?>
