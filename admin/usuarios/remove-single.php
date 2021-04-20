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

if(!$id){
    echo json_encode(
        array(
            'status' => 'error',
            'msg' => 'Tá faltando o ID do registro...'
        )
    );
    die();
}

$query = $op->doQuery("DELETE FROM `usuarios` WHERE `id` = '".$id."'");
if($query['status']=="success" && $query['affected_rows']>0){
    echo json_encode(
        array(
            'status' => 'success',
            'msg' => 'Removido com sucesso.'
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