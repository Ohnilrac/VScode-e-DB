<?php 
  require_once 'config/db.php';

  if (!isset($_GET['id']) || !isset($_GET['conta'])){
    header("Location: ./index.php");
    exit();
  }

  $id = $_GET['id'];
  $numero_conta = $_GET['conta'];
  
  $sql_deletar = "DELETE FROM contas WHERE id = :id AND conta = :conta";
  $stmt = $pdo->prepare($sql_deletar);
  $stmt->execute([':id' => $id, ':conta' => $numero_conta]);
  header("Location: ./index.php");
  exit();
  
?>