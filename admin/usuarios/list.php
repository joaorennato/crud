<?php

if(basename($_SERVER['PHP_SELF'],'.php') !== 'usuarios'){
    die('acesso proibido. =)');
}

?><div class="content-wrapper">
    <div class="page-title">
        <div>
            <h1><i class="fa fa-user-circle" aria-hidden="true"></i> Usuários</h1>
            <p>Listar e gerenciar os usuários dos sistema.</p>
        </div>
        <div>
            <ul class="breadcrumb">
                <li><i class="fa fa-home fa-lg"></i></li>
                <li><a href="<?php echo $op->localurl(); ?>/admin/usuarios.php">Usuários</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <table class="table table-hover table-bordered" id="listTable" data-order='[[ 1, "asc" ]]'>
                        <thead>
                            <tr>
                                <th width="1%">ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th width="1%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            $query = $op->doQuery("SELECT * FROM `usuarios` ORDER BY `id` ASC");
                            if($query['status']=="success" && $query['affected_rows']>0){
                                $row = $query['obj'];
                                for($x=0; $x<sizeof($row); $x++){
                                    ?>
                                <tr>
                                    <td><?php echo $row[$x]['id']; ?></td>
                                    <td><?php echo $row[$x]['nome']; ?></td>
                                    <td><?php echo $row[$x]['email']; ?></td>
                                    <td style="white-space: nowrap;">
                                        <a class="btn btn-xs btn-info" href="<?php echo $op->localurl(); ?>/admin/usuarios.php?a=edit&id=<?php echo $row[$x]['id']; ?>"><i class="fa fa-edit"></i> Editar</a>
                                        <a href="javascript:;" class="btn btn-xs btn-danger btn-remove" data-method="post" data-href="<?php echo $op->localurl(); ?>/admin/usuarios/remove-single.php" data-id="<?php echo $row[$x]['id']; ?>"><i class="fa fa-times"></i> Excluir</a>
                                    </td>
                                </tr>
                                    <?php
                                }
                            } elseif($query['status']=="success" && $query['affected_rows']<=0){
                                //não tem registro no DB, a tabela cuida desse caso sozinha...
                            } else {
                                ?>
                            <tr>
                                <td colspan="4">
                                <div class="alert alert-warning">
                                    <h4>Atenção</h4>
                                    <p>Ocorreu um erro, tente novamente.</p>
                                </div>
                                </td>
                            </tr>
                                <?php
                            }
                            
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo $op->localurl(); ?>/lib/js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo $op->localurl(); ?>/lib/js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $('#listTable').DataTable();
    
    $(document).on('click', '.btn-remove', function(e){
        e.preventDefault();
        
        var method = $(this).data('method');
        var action = $(this).data('href');
        var id = $(this).data('id');
        
        swal({
            title: "Hmmm... tem certeza?",
            text: "Não é possível desfazer depois, ok?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sim, excluir!",
            closeOnConfirm: false
        },
        function(){
            $.ajax({
                method: method,
                dataType: 'json',
                url: action,
                data: { id : id }
            })
            .done(function(result) {
                if(result.status == 'success'){
                    swal({
                        title: "Sucesso!",
                        text: "Fechando automaticamente em 2 segundos...",
                        type: "success",
                        timer: 1500,
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
        
    });
    
</script>
