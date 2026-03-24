<?php
include "config.inc.php";

$id = isset($_GET['id'])?$_GET['id']:0;

if ($id > 0){



// abrir a conexão com o banco 
$conexao = new PDO(dsn, usuario, senha);

// montar a consulta
$sql = "SELECT * FROM cadastro
            WHERE id = :id";

// preparar a consulta
$comando = $conexao -> prepare($sql);

// enviar parametros da consulta

$comando -> bindValue(':id', $id);


// execultar a consulta
$comando -> execute();

// listar os registros do banco
$cadastro = $comando->fetch(); 

}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://unpkg.com/mvp.css">
</head>
<body>

<form method="post" action="atualizar.php">
    <fieldset>
        
        <label for="id">ID</label>
        <input type="text" readonly id="id" name="id" required value='<?= isset($cadastro)?$cadastro['id']:0?>'>
    
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required value='<?= isset($cadastro)?$cadastro['nome']:0?>'>

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required value='<?= isset($cadastro)?$cadastro['email']:0?>'>

        <label for="telefone">Telefone</label>
        <input type="text" id="telefone" name="telefone" required value='<?= isset($cadastro)?$cadastro['telefone']:0?>'>

        <label for="data_nascimento">Data de nascimento</label>
        <input type="text" id="data_nascimento" name="data_nascimento" required value='<?= isset($cadastro)?$cadastro['data_nascimento']:0?>'>

        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" required value='<?= isset($cadastro)?$cadastro['senha']:0?>'>

        <button type="submit">Alterar</button>
    </fieldset>
</form>

</body>
</html>