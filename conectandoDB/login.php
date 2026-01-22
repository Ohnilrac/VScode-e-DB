<?php 
session_start();
require_once 'config/db.php';

if(isset($_SESSION['id'])){
  header("Location: logado.php");
  exit();
}

if(isset($_POST['titular']) || isset($_POST['conta'])){
  $nome_do_titular = $_POST['titular'];
  $numer_da_conta = $_POST['conta'];
  
  $sql_consultando = "SELECT * FROM contas WHERE titular = :titular AND conta = :conta"; // Estou buscando os dados de titular e conta da tabela contas
  $stmt = $pdo->prepare($sql_consultando); // aqui eu preparo os dados para evitar SQL Injection
  $stmt->execute(['titular' => $nome_do_titular, 'conta' => $numer_da_conta]); // Nesse ponto, estou colocando os valores fornecidos pelo formulário na query que são aqueles :titular e :conta

  $users = $stmt->fetch(PDO::FETCH_ASSOC); 

  if($users){
    $_SESSION['id'] = $users['id'];
    $_SESSION['titular'] = $users['titular'];
    $_SESSION['conta'] = $users['conta'];
    header("Location: logado.php");
    exit();
  }
}


?>

<form method="post">
    <label for="titular">Titular</label>
    <input type="text" name="titular" id="id_titular" required>
    <label for="conta">Conta</label>
    <input type="number" name="conta" id="id_conta" required>
    
    <input type="submit" value="Logar">
  </form>