<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulário</title>
</head>
<body>

  <?php
    require_once "./config/db.php";  //Evita que o arquivo seja incluído mais de uma vez

    $nome_titular = ($_POST['titular']) ?? null; //Utilizando o null para evitar o envio de valores vazios
    $numero_agencia = ($_POST['agencia']) ?? null;
    $senha_conta = ($_POST['senha']) ?? null;
    $valor_saldo = ($_POST['saldo']) ?? null;
    $numero_conta = ($_POST['conta']) ?? null;

    if($nome_titular && $senha_conta && $numero_conta){ //Verifica se todos os campos foram preenchidos

      $senha_c = password_hash($senha_conta, PASSWORD_DEFAULT); //Aqui estou utilizando o hash para criptografar a senha antes de enviar para o banco de dados

      $sql_inserir = "INSERT INTO contas (titular, agencia, senha, conta, saldo) VALUES ( :nometitular, :numeroagencia, :senhaconta, :numeroconta, :valorsaldo )"; //Utilizando os : para preparar a query e evitar SQL Injection
      $inserindo_dados = $pdo->prepare($sql_inserir);
      $inserindo_dados->execute(['nometitular' => $nome_titular, 'numeroagencia' => $numero_agencia, 'senhaconta' => $senha_c, 'numeroconta' => $numero_conta,  'valorsaldo' => $valor_saldo]); //Aqui estou utilizando o array associativo para ligar os valores aos parametros da query

      header("Location: " . $_SERVER["PHP_SELF"]); //Após o envio dos dados, a página é recarregada para evitar o reenvio do formulário ao atualizar a página
    }
  ?>

  <h1>Envio de dados</h1>

  <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
    <label for="titular">Titular</label>
    <input type="text" name="titular" id="id_titular" required>
    <label for="agencia">Agencia</label>
    <input type="number" name="agencia" id="id_agencia" required>
    <label for="senha">Senha</label>
    <input type="password" name="senha" id="id_senha" required>
    <label for="saldo">Saldo</label>
    <input type="number" name="saldo" id="id_saldo" step="0.01" required>
    <label for="conta">Conta</label>
    <input type="number" name="conta" id="id_conta" required>
    
    <input type="submit" value="Cadastrar">
  </form>
</body>
</html>