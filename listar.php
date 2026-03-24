<?php
session_start();
if (!isset($_SESSION['id'])){
    header("location: login.html?");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de usuários</title>
    <link rel="stylesheet" href="https://unpkg.com/mvp.css">

</head>

<body>
    <h1>Bem vindo <?= $_SESSION['nome'] ?></h1>
    <h3><a href="sair.php">Sair</a></h3>
    <form action="" method="get">

        <label for="tipo">Tipo</label>
        <select name="tipo" id="tipo">
            <option value="">Selecione</option>
            <option value="1">Id</option>
            <option value="2">Nome</option>
            <option value="3">E-mail</option>
            <option value="4">Telefone</option>
            <option value="5">Data de nascimento</option>
        </select>


        <input type="text" name="filtro" id="filtro">

        <button type="submit">Filtrar</button>

    </form>

<br>

<?php

    $tipo= isset($_GET['tipo'])?$_GET['tipo']:0;
    $filtro= isset($_GET['filtro'])?$_GET['filtro']:0;

    include "config.inc.php";

    // abrir a conexão com o banco 
    $conexao = new PDO(dsn, usuario, senha);

    // montar a consulta
   // $sql = "SELECT * FROM cadastro";// consulta sem filtro
   $sql = "SELECT * FROM cadastro";

   switch($tipo){
        case 1:
            $sql .= " WHERE  id = :filtro";
            break;
        case 2:
            $sql .= " WHERE  nome like :filtro";
            $filtro = '%'.$filtro.'%';
            break;
        case 3:
            $sql .= " WHERE  email = :filtro";
            break;
        case 4:
            $sql .= " WHERE  telefone = :filtro";
            break;
        case 5:
            $sql .= " WHERE  data_nascimento = :filtro";
            break;
   }

    // preparar a consulta
    $comando = $conexao->prepare($sql);

    // enviar parametros da consulta

        if($tipo > 0)
            $comando->bindValue(':filtro', $filtro);
//pass
    
    // execultar a consulta
    $comando->execute();

    // listar os registros do banco
    $registros = $comando->fetchAll();
?>

    <table>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Data de nascimento</th>
            <th>Senha</th>
            <th>Alterar</th>
            <th>Excluir</th>
        </tr>

<?php
    foreach ($registros as $cadastro) {
        echo "<tr><td>" . $cadastro['id'] . "</td>" .
             "<td>" . $cadastro['nome'] . "</td>" .
             "<td>" . $cadastro['email'] . "</td>" .
             "<td>" . $cadastro['telefone'] . "</td>" .
             "<td>" . $cadastro['data_nascimento'] . "</td>" .
             "<td>" . $cadastro['senha'] . "</td>" .
             "<td><a href='formulario_alterar_cadastro.php?id=" . $cadastro['id'] . "'>Alterar</a></td>.
             <td><a href='excluir.php?id=" . $cadastro['id'] . "'>Excluir</a></td>
        </tr>";
    }
?>
    </table>
</body>
</html>