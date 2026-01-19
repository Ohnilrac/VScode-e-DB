<?php 

$host = "localhost";
$dbnome = "jonasnun_caixaeletronico";
$usuario = "jonasnun_usercaixa";
$senha = "brasil2010.";

  try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbnome; charset=utf8", $usuario, $senha);

    // Ativar o modo de erro do PDO para exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Conexão realizada com sucesso!";

  } catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
  }

?>