<?php 
  require_once 'config/db.php';

  if (!isset($_GET['id'])) { // isset verifica se a variavel existe, usando o ! na frente inverto a condição, ou seja, se o id não existir
    header("Location: ./index.php"); // Redireciona para a página inicial se o ID não for fornecido
    exit(); // Encerra a execução do script após o redirecionamento
  }
  
  $id = $_GET['id'];

  $sql = "SELECT titular, agencia, conta, saldo, senha FROM contas WHERE id = :id"; // Fazendo a consulta para selecionar o usuário pelo ID, utilizando os : para evitar SQL injection
  $consulta = $pdo->prepare($sql); // Preparando a consulta
  $consulta->execute(['id' => $id]); //Executando a consulta somente com o ID fornecido porque é o unico dado necessário para pegar o usuário correto
  $usuario = $consulta->fetch(PDO::FETCH_ASSOC); // Criando variavel usuario para armazenar os dados do usuario encontrado, e o feth é para ele pegar somente a primeira linha encontrada, por fim o FETCH_ASSOC para trazer exatamente os nomes das colunas do banco de dados

  if (!$usuario) {
    header("Location: . index.php");
    exit();
    }

?>

<form action="atualizar.php" method="post">
  <input type="hidden" name="id" value="<?= $id ?>"> <!-- Campo oculto para armazenar o ID do usuário -->

  <label for="titular">Titular</label>
  <input type="text" name="titular" id="id_titular" value="<?= $usuario['titular'] ?>"/>
  <label for="agencia">Agencia</label>
  <input type="number" name="agencia" id="id_agencia" value="<?= $usuario['agencia'] ?>"/>
  <label for="conta">Conta</label>
  <input type="number" name="conta" id="id_conta" value="<?= $usuario['conta'] ?>"/>
  <input type="submit" value="Atualizar"/>

</form>