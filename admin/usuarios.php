<?php 

$eu = basename($_SERVER['PHP_SELF'],'.php');

include "inc/header.php";

if(isset($_GET['a']) && $_GET['a'] != ""){
    $a = $_GET['a'];
} elseif(isset($_POST['a']) && $_POST['a'] != ""){
    $a = $_POST['a'];
} else {
    $a = 'list';
}

if($a == "add"){
    include "usuarios/add.php";
}

if($a == "list"){
    include "usuarios/list.php";
}

if($a == "edit"){
    
    include "usuarios/edit.php";
}

include "inc/footer.php";

?>