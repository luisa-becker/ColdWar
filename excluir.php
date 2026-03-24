<?php

include "config.inc.php";


$id = isset($_GET['id'])?$_GET['id']:'';

if ($id > 0){

$conexao = new PDO(dsn, usuario , senha);

//montar o sql

$sql = "DELETE  FROM cadastro 
                        WHERE id = :id ";

$comando = $conexao -> prepare($sql);

$comando -> bindValue(':id', $_GET['id']);

if($comando->execute()){
    echo"Dados excluídos com sucesso";
    header ('location: listar.php');
}else
    header ('location: excluir.html?auth_error=Usuário ou senha inválidos');



} 
?>