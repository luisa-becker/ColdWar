<?php

$usuario = isset($_POST['usuario'])?$_POST['usuario']:'';
$senha = isset($_POST['senha'])?$_POST['senha']:'';

include_once "config.inc.php";

$conexao = new PDO(dsn, usuario, senha);
$sql = "SELECT id, nome 
        FROM cadastro 
        WHERE email = :usuario
        AND senha = :senha";

$comando = $conexao->prepare($sql);
//retorna o mesmo hash para a mesma senha, ou seja, se o usuário digitar a mesma senha, o hash gerado será o mesmo.
$comando->bindValue(':usuario', $usuario);
$comando->bindValue(':senha', md5($senha));
$comando->execute();
$registro = $comando->fetch();
if ($registro){
    session_start();
    $_SESSION['id'] = $registro['id'];
    $_SESSION['nome'] = $registro['nome'];
    header("location: listar.php");
}else{
    header("location: login.html?auth_error=Usuário ou senha inválidos");
}
?>