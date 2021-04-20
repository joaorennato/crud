<?php

include "../../classes/main.php";
include "../../classes/op.php";
include "../../classes/login.php";

$op = new Op;
$login = new Login;

if(!$login->esta_logado()){
    $login->redireciona($op->localurl().'/admin/login.php');
    die();
}

$id = $_POST['id'];

$nome = $_POST['nome'];
$nascimento = $_POST['nascimento'];
$rg = $_POST['rg'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];

if(!isset($_POST['endereco'])){
    $endereco = "";
} else {
    $endereco = serialize($_POST['endereco']);
}

$email = $_POST['email'];

$senha1 = $_POST['senha1'];
$senha2 = $_POST['senha2'];

if($senha1 == "" || $senha2 == ""){
    $senha = "";
} else {
    if($senha1 == $senha2){
        $senha = md5($senha2);
    } else {
        $senha = "";
    }
}

if($senha == ""){
    $query = $op->doQuery("UPDATE `usuarios` SET 
        `nome` = '".$nome."', 
        `nascimento` = '".$nascimento."', 
        `rg` = '".$rg."', 
        `cpf` = '".$cpf."', 
        `telefone` = '".$telefone."', 
        `endereco` = '".$endereco."', 
        `email` = '".$email."'
    WHERE `id` = '".$id."'");
} else {
    $query = $op->doQuery("UPDATE `usuarios` SET 
        `nome` = '".$nome."', 
        `nascimento` = '".$nascimento."', 
        `rg` = '".$rg."', 
        `cpf` = '".$cpf."', 
        `telefone` = '".$telefone."', 
        `endereco` = '".$endereco."', 
        `email` = '".$email."', 
        `senha` = '".$senha."'
    WHERE `id` = '".$id."'");
}
if($query['status']=="success" && $query['affected_rows']>0){
    echo json_encode(
        array(
            'status' => 'success',
            'msg' => 'Editado com sucesso.'
        )
    );
} elseif($query['status']=="success" && $query['affected_rows']<=0){
    echo json_encode(
        array(
            'status' => 'warning',
            'msg' => 'Nenhuma alteração foi realizada.'
        )
    );
} else {
    echo json_encode(
        array(
            'status' => 'error',
            'msg' => 'Ocorreram erros, tente novamente.'
        )
    );
}

?>