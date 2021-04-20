<aside class="main-sidebar hidden-print">
    <section class="sidebar">
        <!-- Sidebar Menu-->
        <ul class="sidebar-menu">
            <li<?php echo($eu == "index" ? ' class="active"' : ''); ?>><a href="index.php"><i class="fa fa-dashboard"></i><span>Início</span></a></li>

            <li class="treeview<?php echo($eu == "usuarios" ? ' active' : ''); ?>"><a href="#"><i class="fa fa-user-circle" aria-hidden="true"></i><span>Usuários</span><i class="fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?php echo $op->localurl(); ?>/admin/usuarios.php?a=add">
                            <?php echo ($eu == "usuarios" && $_GET['a'] == "add" ? '<i class="fa fa-circle"></i>' : '<i class="fa fa-circle-o"></i>'); ?> Adicionar
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $op->localurl(); ?>/admin/usuarios.php?a=list">
                            <?php echo ($eu == "usuarios" && ($_GET['a'] == "list" || $_GET['a'] == "edit") ? '<i class="fa fa-circle"></i>' : '<i class="fa fa-circle-o"></i>'); ?> Listar
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
