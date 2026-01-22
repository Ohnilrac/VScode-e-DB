<?php 
session_start();

if(!isset($_SESSION['id']) || !isset($_SESSION['titular']) || !isset($_SESSION['conta'])){
  header("location: login.php");
  exit();
}


echo "Logado com sucesso {$_SESSION['titular']}";

?>