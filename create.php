<?php
//  tive que add if ($_SERVER['REQUEST_METHOD'] === 'POST') para fazer o seguinte:
//  Essa página foi acessada através de um formulário enviado?”
//Se sim → entra no if, é isso que está acontecendo

include "config.inc.php";



$nome = isset($_POST['nome'])?$_POST['nome']:'';
$email = isset($_POST['email'])?$_POST['email']:'';
$telefone = isset($_POST['telefone'])?$_POST['telefone']:'';
$data_nascimento = isset($_POST['data_nascimento'])?$_POST['data_nascimento']:'';
$senha = isset($_POST['senha'])?$_POST['senha']:'';

if ($nome != ''){

/*

$nome  = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['nome'])) {
        $nome = $_POST['nome'];
    }

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }
*/
    
   
    //CRUD de cadastro

    // Conectar com banco de dados
    $conexao = new PDO(dsn, usuario, senha);

    //CREATE
    //montar sql
    $sql = 'INSERT INTO cadastro (nome, email, telefone, data_nascimento, senha) VALUES (:nome, :email, :telefone, :data_nascimento, :senha)';
  
    //preparar comando para executar no banco de dados

    $comando = $conexao->prepare($sql);

    //informar parametros
    $comando->bindValue(':nome', $nome);
    $comando->bindValue(':email', $email);
    $comando->bindValue(':telefone', $telefone);
    $comando->bindValue(':data_nascimento', $data_nascimento);
    $comando->bindValue(':senha', md5($senha));
    //md5 é um algoritmo de hash, ou seja, ele transforma a senha em uma sequência
    //de caracteres que não pode ser revertida para a senha original.
    //Isso é importante para proteger as senhas dos usuários, caso o banco de dados seja comprometido.

    //executar comando
    if ($comando->execute()){
        echo 'Dados inseridos com sucesso!';
        header ('location: login.php');
    }else
        header ('location: create.html?auth_error=Usuário ou senha inválidos');


    } else
    echo'Por favor digite um nome';


?>