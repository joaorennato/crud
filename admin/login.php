<?php

include "../classes/main.php";
include "../classes/login.php";
include "../classes/op.php";

$login = new Login();
$op = new Op();

if($login->esta_logado() != ""){
    $login->redireciona('index.php');
}

if(isset($_POST['btn-login'])){
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    if($login->entrar($email,$senha)){
        $login->redireciona('index.php');
    } else {
        $erro = "E-mail e/ou senha inválidos!";
    } 
}

?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo $op->localurl(); ?>/lib/css/main.css">
    <title>Crud</title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
    -->
</head>

<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <h1>Crud</h1>
        </div>
        
        <?php
            if(isset($erro)){
                ?>
                <div class="alert alert-danger">
                    <i class="glyphicon glyphicon-warning-sign"></i> &nbsp;
                    <?php echo $erro; ?>
                </div>
                <?php
            }
        ?>
        
        <div class="login-box">
            <form method="post" class="login-form">
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>LOGIN.</h3>
                <div class="form-group">
                    <label class="control-label">E-MAIL</label>
                    <input class="form-control" type="email" name="email" placeholder="E-mail" autofocus>
                </div>
                <div class="form-group">
                    <label class="control-label">SENHA</label>
                    <input class="form-control" type="password" name="senha" placeholder="Senha">
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block" name="btn-login">ENTRAR <i class="fa fa-sign-in fa-lg"></i></button>
                </div>
            </form>
        </div>
    </section>
</body>
<script src="<?php echo $op->localurl(); ?>/lib/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $op->localurl(); ?>/lib/js/essential-plugins.js"></script>
<script src="<?php echo $op->localurl(); ?>/lib/js/bootstrap.min.js"></script>
<script src="<?php echo $op->localurl(); ?>/lib/js/plugins/pace.min.js"></script>
<script src="<?php echo $op->localurl(); ?>/lib/js/main.js"></script>

</html>
