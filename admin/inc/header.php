<?php

include "../classes/main.php";
include "../classes/op.php";
include "../classes/login.php";

$login = new Login;
$op = new Op;

if(!$login->esta_logado()){
    $login->redireciona($op->localurl().'/admin/login.php');
}

$admin_id = $_SESSION['sessao_admin_id'];
$admin_nome = $_SESSION['sessao_admin_nome'];
$admin_email = $_SESSION['sessao_admin_email'];

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $op->localurl(); ?>/lib/css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
    <script src="<?php echo $op->localurl(); ?>/lib/js/plugins/sweetalert.min.js"></script>
    <script src="<?php echo $op->localurl(); ?>/lib/js/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
        <script>
            $(document).ready(function () {

                $("#nascimento").mask("99/99/9999");
                $("#cpf").mask('999.999.999-99', {reverse: true});
                $('#rg').mask('99.999.999-9');

                $("#telefone")
                .mask("(99) 9999-9999?9")
                .focusout(function (event) {  
                    var target, phone, element;  
                    target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
                    phone = target.value.replace(/\D/g, '');
                    element = $(target);  
                    element.unmask();  
                    if(phone.length > 10) {  
                        element.mask("(99) 99999-999?9");  
                    } else {  
                        element.mask("(99) 9999-9999?9");  
                    }  
                });
            });
        </script>
    <title>Sistema Administrativo</title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
    -->
  </head>
  <body class="sidebar-mini fixed">
    <div class="wrapper">
      <!-- Navbar-->
      <header class="main-header hidden-print"><a class="logo" href="index.php">Crud</a>
        <?php include "inc/nav-top.php"; ?>
      </header>
      <!-- Side-Nav-->
      <?php include "inc/side-menu.php"; ?>