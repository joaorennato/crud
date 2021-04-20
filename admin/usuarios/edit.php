<?php

if(basename($_SERVER['PHP_SELF'],'.php') !== 'usuarios'){
    die('acesso proibido. =)');
}

if(isset($_GET['id']) && $_GET['id'] != ""){
    $id = $_GET['id'];
} elseif(isset($_POST['id']) && $_POST['id'] != ""){
    $id = $_POST['id'];
} else {
    die("<script>
    swal({
        title: \"Erro!\",
        text: \"Está faltando o ID do registro...\",
        type: \"error\",
        timer: 1500,
        showConfirmButton: false
    }, function(isConfirm){
        if (!isConfirm) {
            location.href = '".$op->localurl()."/admin/usuarios.php?a=list';
        }
    });
</script>");
}

$query = $op->doQuery("SELECT * FROM `usuarios` WHERE `id` = '".$id."' LIMIT 1");
if($query['status']=="success" && $query['affected_rows']>0){
    $row = $query['obj'];
    for($x=0; $x<sizeof($row); $x++){
        $nome = $row[$x]['nome'];
        $email = $row[$x]['email'];
        $rg = $row[$x]['rg'];
        $cpf = $row[$x]['cpf'];
        $nascimento = $row[$x]['nascimento'];
        $telefone = $row[$x]['telefone'];
        $endereco = unserialize($row[$x]['endereco']);
    }
} elseif($query['status']=="success" && $query['affected_rows']<=0){
    die("<script>
    swal({
        title: \"Atenção!\",
        text: \"Não encontramos nenhum registro com o ID especificado...\",
        type: \"warning\",
        timer: 1500,
        showConfirmButton: false
    }, function(isConfirm){
        if (!isConfirm) {
            location.href = '".$op->localurl()."/admin/usuarios.php?a=list';
        }
    });
</script>");
} else {
    die("<script>
    swal({
        title: \"Erro!\",
        text: \"Ocorreu um erro, tente novamente...\",
        type: \"error\",
        timer: 1500,
        showConfirmButton: false
    }, function(isConfirm){
        if (!isConfirm) {
            location.href = '".$op->localurl()."/admin/usuarios.php?a=list';
        }
    });
</script>");
}

$allowed = array("jpg","jpeg","png","gif");

?>
<div class="content-wrapper">
    <div class="page-title">
        <div>
            <h1><i class="fa fa-user-circle" aria-hidden="true"></i> Usuários</h1>
            <p>Editar um registro em Usuários.</p>
        </div>
        <div>
            <ul class="breadcrumb">
                <li><i class="fa fa-home fa-lg"></i></li>
                <li><a href="<?php echo $op->localurl(); ?>/admin/usuarios.php">Usuários</a></li>
                <li><a href="<?php echo $op->localurl(); ?>/admin/usuarios.php?a=edit&id=<?php echo $id; ?>">Editar</a></li>
            </ul>
        </div>
    </div>
    <form class="form-horizontal submit-form" method="post" action="<?php echo $op->localurl(); ?>/admin/usuarios/edit-process.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                            <fieldset>
                                <legend>Editar cadastro de usuário</legend>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="nome">Nome:</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="nome" name="nome" type="text" placeholder="Nome" autocomplete="off" value="<?php echo $nome; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="nascimento">Data de Nascimento:</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="nascimento" name="nascimento" type="text" placeholder="Data de Nascimento" autocomplete="off" value="<?php echo $nascimento; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="rg">RG:</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="rg" name="rg" type="text" placeholder="RG" autocomplete="off" value="<?php echo $rg; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="cpf">CPF:</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="cpf" name="cpf" type="text" placeholder="CPF" autocomplete="off" value="<?php echo $cpf; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="telefone">Telefone:</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="telefone" name="telefone" type="text" placeholder="Telefone" autocomplete="off" value="<?php echo $telefone; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="email">E-mail:</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="email" name="email" type="email" placeholder="Endereço de email" autocomplete="off" value="<?php echo $email; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="endereco">Endereço:</label>
                                    <div class="col-lg-10">
                                        <div class="area-endereco">
                                            <?php

                                            if($endereco){
                                                for($x=0; $x<sizeof($endereco); $x++){
                                                    if($x === 0){
                                                        ?>
                                                    <div class="row-endereco">
                                                        <textarea class="form-control" id="endereco" name="endereco[]" placeholder="Informe aqui o endereço" autocomplete="off"><?php echo $endereco[$x]; ?></textarea>
                                                    </div>
                                                        <?php
                                                    } else {
                                                        ?>
                                                    <div class="row-endereco" id="row-<?php echo $x; ?>">
                                                        <div class="row">
                                                            <div class="col-sm-10">
                                                                <textarea class="form-control" id="endereco-<?php echo $x; ?>" name="endereco[]" placeholder="Informe aqui o endereço" autocomplete="off"><?php echo $endereco[$x]; ?></textarea>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <a href="javascript:;" class="btn btn-danger btn-sm remove-endereco" rel="row-<?php echo $x; ?>">[x] Remover</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <?php
                                                    }
                                                }
                                            }


                                            ?>
                                        </div>
                                        <a href="javascript:;" class="btn btn-primary btn-sm add-endereco">[+] Endereço</a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="senha1">Senha:</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="senha1" name="senha1" type="password" placeholder="Senha" autocomplete="off">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="senha2">Confirme a senha:</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="senha2" name="senha2" type="password" placeholder="Confirmação da senha" autocomplete="off">
                                        <small class="help-block">Se não deseja alterar a senha, deixe os campos acima em branco.</small>
                                    </div>
                                </div>
                                
                                
                            </fieldset>
                    </div>
                </div>
            </div> 
           
            <div class="col-md-12">
                <div class="card">
                    <div class="card-footer clearfix">
                        <a href="javascript:;" class="btn btn-primary icon-btn submit-btn pull-right" role="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Editar</a>
                    </div>
                </div>
            </div>
            
        </div>
    </form>
</div>
<script>

    function getRand(){
        return new Date().getTime().toString() + Math.floor(Math.random()*1000000);
    }

    $(document).on('click', '.add-endereco', function(e){
        e.preventDefault();

        var id = getRand();
        var html = '<div class="row-endereco" id="' + id + '"><div class="row"><div class="col-sm-10"><textarea class="form-control" id="endereco" name="endereco[]" placeholder="Informe aqui o endereço" autocomplete="off"></textarea></div><div class="col-sm-2"><a href="javascript:;" class="btn btn-danger btn-sm remove-endereco" rel="' + id + '">[x] Remover</a></div></div></div>';
        $('.area-endereco').append(html);
    });

    $(document).on('click', '.remove-endereco', function(e){
        e.preventDefault();
        var id = $(this).attr('rel');
        $('#' + id).remove();
    });
    
    $(document).on('click', '.submit-btn', function(e){
        e.preventDefault();
        $('.submit-form').submit();
    });
    
    $(document).on('submit', '.submit-form', function(e){
        e.preventDefault();
        
        var form = $(this);
        var method = form.attr('method');
        var action = form.attr('action');
        var dados = form.serialize();
        
        $.ajax({
            method: method,
            dataType: 'json',
            url: action,
            data: dados
        })
        .done(function(result) {
            if(result.status == 'success'){
                swal({
                    title: "Sucesso!",
                    text: "Fechando automaticamente em 2 segundos...",
                    type: "success",
                    timer: 2000,
                    showConfirmButton: false
                }, function(isConfirm){
                    if (!isConfirm) {
                        location.reload();
                    }
                });
            } else {
                swal("Atenção!", result.msg, "warning");
            }
        })
        .fail(function() {
            swal("Algo não correu bem...", "Ocorreu um erro, por favor tente novamente =/", "error");
        });
        
    });
    
</script>