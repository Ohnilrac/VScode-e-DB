<?php 
  require_once 'config/db.php';

  if (!isset($_GET['id'])) { // isset verifica se a variavel existe, usando o ! na frente inverto a condição, ou seja, se o id não existir
    header("Location: ./index.php"); // Redireciona para a página inicial se o ID não for fornecido
    exit(); // Encerra a execução do script após o redirecionamento
  }
  
  $id = $_GET['id'];

  $sql_busca = "SELECT * FROM contas WHERE id = :id"; // Query para buscar o usuário pelo ID
  $consulta = $pdo->prepare($sql_busca);
  $consulta->execute(['id' => $id]); //Executando a consulta somente com o ID fornecido porque é o unico dado necessário para pegar o usuário correto
  $usuario = $consulta->fetch(PDO::FETCH_ASSOC); 
  
  if (!$usuario) {
    header("Location: . index.php");
    exit();
    }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') { //Request method verifica se houve envio de dados via POST
    $titular_novo = $_POST['titular'];
    $agencia_nova = $_POST['agencia'];
    $conta_nova = $_POST['conta'];

    $sql_atualizar = "UPDATE contas SET titular = :titular, agencia = :agencia, conta = :conta WHERE id = :id"; // Query para atualizar os dados do usuário
    $stmt = $pdo->prepare($sql_atualizar);
    $stmt->execute([
      ':titular' => $titular_novo,
      ':agencia' => $agencia_nova,
      ':conta' => $conta_nova,
      ':id' => $id
    ]);

    header("Location: ./index.php");
    exit();
  }
?>

<form method="post">
  <input type="hidden" name="id" value="<?= $id ?>"> <!-- Campo oculto para armazenar o ID do usuário -->

  <label for="titular">Titular</label>
  <input type="text" name="titular" id="id_titular" value="<?= $usuario['titular'] ?>"/>
  <label for="agencia">Agencia</label>
  <input type="number" name="agencia" id="id_agencia" value="<?= $usuario['agencia'] ?>"/>
  <label for="conta">Conta</label>
  <input type="number" name="conta" id="id_conta" value="<?= $usuario['conta'] ?>"/>
  <input type="submit" value="Atualizar"/>


</form>