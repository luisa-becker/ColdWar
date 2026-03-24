<?php

include "config.inc.php";

$nome = isset($_POST['nome'])?$_POST['nome']:'';
$email = isset($_POST['email'])?$_POST['email']:'';
$telefone = isset($_POST['telefone'])?$_POST['telefone']:'';
$data_nascimento = isset($_POST['data_nascimento'])?$_POST['data_nascimento']:'';
$senha = isset($_POST['senha'])?$_POST['senha']:'';

if ($nome != "" && $email !=""){

$conexao = new PDO(dsn, usuario , senha);

//montar o sql

$sql = "UPDATE cadastro SET nome = :nome,
                            email = :email, 
                            telefone = :telefone,
                            data_nascimento = :data_nascimento,
                            senha = :senha
                        WHERE id = :id ";

$comando = $conexao -> prepare($sql);
$comando -> bindValue(':nome', $_POST['nome']);
$comando -> bindValue(':email', $_POST['email']);
$comando -> bindValue(':telefone', $_POST['telefone']);
$comando -> bindValue(':data_nascimento', $_POST['data_nascimento']);
$comando -> bindValue(':senha', $_POST['senha']);
$comando -> bindValue(':id', $_POST['id']);

if($comando->execute()){
    echo"Dados atualizados com sucesso";
    header ('location: listar.php');
}else
    header ('location: atualizar.html?auth_error=Usuário ou senha inválidos');


} else
echo" Os dados não podem estar em branco...";
?>