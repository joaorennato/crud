<?php

include "../classes/main.php";
include "../classes/login.php";
include "../classes/op.php";

$login = new Login;
$op = new Op;

$login->logout();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saindo...</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script>
        setTimeout(function () {
            location.href = "index.php"
        }, 3000);
    </script>
</head>

<body>

    <div class="container" style="margin-top: 50px;">
        <p class="alert alert-warning">Saindo...</p>
    </div>

</body>

</html>