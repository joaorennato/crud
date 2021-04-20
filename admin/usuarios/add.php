<?php

if(basename($_SERVER['PHP_SELF'],'.php') !== 'usuarios'){
    die('acesso proibido. =)');
}

?><div class="content-wrapper">
    <div class="page-title">
        <div>
            <h1><i class="fa fa-user-circle" aria-hidden="true"></i> Usuários</h1>
            <p>Adicionar um novo cadastro em Usuários.</p>
        </div>
        <div>
            <ul class="breadcrumb">
                <li><i class="fa fa-home fa-lg"></i></li>
                <li><a href="<?php echo $op->localurl(); ?>/admin/usuarios.php">Usuários</a></li>
                <li><a href="<?php echo $op->localurl(); ?>/admin/usuarios.php?a=add">Adicionar</a></li>
            </ul>
        </div>
    </div>
    <form class="form-horizontal submit-form" method="post" action="<?php echo $op->localurl(); ?>/admin/usuarios/add-process.php">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                            <fieldset>
                                <legend>Adicionar novo item ao usuários</legend>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="nome">Nome:</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="nome" name="nome" type="text" placeholder="Nome" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="nascimento">Data de Nascimento:</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="nascimento" name="nascimento" type="text" placeholder="Data de Nascimento" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="rg">RG:</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="rg" name="rg" type="text" placeholder="RG" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="cpf">CPF:</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="cpf" name="cpf" type="text" placeholder="CPF" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="telefone">Telefone:</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="telefone" name="telefone" type="text" placeholder="Telefone" autocomplete="off">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="email">E-mail:</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="email" name="email" type="email" placeholder="Endereço de email" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="endereco">Endereço:</label>
                                    <div class="col-lg-10">
                                        <div class="area-endereco">
                                            <div class="row-endereco">
                                                <textarea class="form-control" id="endereco" name="endereco[]" placeholder="Informe aqui o endereço" autocomplete="off"></textarea>
                                            </div>
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
                                    </div>
                                </div>
                            </fieldset>
                    </div>
                </div>
            </div> 
            
            <div class="col-md-12">
                <div class="card">
                    <div class="card-footer clearfix">
                        <a href="javascript:;" class="btn btn-primary icon-btn submit-btn pull-right" role="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Adicionar</a>
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