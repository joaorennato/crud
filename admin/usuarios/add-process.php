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
    die(json_encode(
        array(
            'status' => 'warning',
            'msg' => 'Você precisa informar a senha.'
        )
    ));
} else {
    if($senha1 == $senha2){
        $senha = md5($senha2);
    } else {
        die(json_encode(
            array(
                'status' => 'warning',
                'msg' => 'As senhas precisam ser idênticas.'
            )
        ));
    }
}

$query = $op->doQuery("INSERT INTO `usuarios` SET 
    `nome` = '".$nome."', 
    `nascimento` = '".$nascimento."', 
    `rg` = '".$rg."', 
    `cpf` = '".$cpf."', 
    `telefone` = '".$telefone."', 
    `endereco` = '".$endereco."', 
    `email` = '".$email."', 
    `senha` = '".$senha."'");
    
if($query['status']=="success" && $query['affected_rows']>0){
    echo json_encode(
        array(
            'status' => 'success',
            'msg' => 'Adicionado com sucesso.'
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