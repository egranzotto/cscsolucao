<?php
    $principalBreadcrumb = "Tipo de Endereço";
    $breadcrumb = montaBreadcrumb($principalBreadcrumb);
    
    $link = $URL[1];

    if (!isset($URL[2]) OR $URL[2] == "") {
        $breadcrumb_subtitulo = "Lista";
?>
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="widget">
                <div class="widget-body">
                    <div class="table-toolbar">
                        <a id="editabledatatable_new" href="<?php echo $link; ?>/novo" class="btn btn-primary">+ Novo</a>
                    </div>
                    <br>
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr role="row">
                                <th>ID</th>
                                <th>Categoria</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $retorno = listaTipos();
                                
                                if ($retorno != 0) {
                                    for ($i=0; $i<count($retorno); $i++) {
                                        $retorno_id = $retorno[$i]["id"];
                                        $retorno_nome = $retorno[$i]["nome"];
                            ?>
                            
                            <tr>
                                <td><?php echo $retorno_id; ?></td>
                                <td><?php echo $retorno_nome; ?></td>
                                <td>
                                    <a href="<?php echo $link."/editar/".$retorno_id; ?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Editar</a>
                                    <a href="<?php echo $link."/visualizar/".$retorno_id; ?>" class="btn btn-info btn-xs"><i class="fa fa-search"></i> Visualizar</a>
                            </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php
    } else if ($URL[2] == "novo") { 
        $breadcrumb_subtitulo = "Novo";
?>

    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="widget">
                <div class="widget-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" method="post" action="acoes/<?php echo $link; ?>.php" enctype="multipart/form-data" id="form" name="form">
                                <div class="form-group">
                                    <label for="nome">Tipo</label>
                                    <input type="text" id="nome" name="nome" class="form-control" required>
                                </div>

                                <input type="hidden" id="acao" name="acao" value="novo" />
                                <input type="hidden" id="url" name="url" value="<?php echo $link; ?>" />
                                <input type="submit" class="btn btn-success shiny" value="Salvar" />
                                <a href="<?php echo $link; ?>" class="btn btn-primary shiny">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    } else if ($URL[2] == "editar") { 
        $id = $URL[3];
        
        $retorno = buscaTipos($id);
        
        if ($retorno != 0) {
            $retorno_id = $retorno["id"];
            $retorno_nome = $retorno["nome"];
            
            $breadcrumb = montaBreadcrumb($principalBreadcrumb, $retorno_nome);
            $breadcrumb_subtitulo = "Editar";
?>

    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="widget">
                <div class="widget-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" method="post" action="acoes/<?php echo $link; ?>.php" enctype="multipart/form-data" id="form" name="form">
                                <div class="form-group">
                                    <label for="nome">Tipo</label>
                                    <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $retorno_nome; ?>" required>
                                </div>
                                
                                <input type="hidden" id="acao" name="acao" value="editar" />
                                <input type="hidden" id="url" name="url" value="<?php echo $link; ?>" />
                                <input type="hidden" id="id" name="id" value="<?php echo $retorno_id; ?>" />
                                <input type="submit" class="btn btn-success shiny" value="Salvar" />
                                <a href="<?php echo $link; ?>" class="btn btn-primary shiny">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
        } else {
            echo "<h2>Registro não encontrado.</h2>";
        }
    } else if ($URL[2] == "visualizar") { 
        $id = $URL[3];
        
        $retorno = buscaTipos($id);
        
        if ($retorno != 0) {
            $retorno_id = $retorno["id"];
            $retorno_nome = $retorno["nome"];
            
            $breadcrumb = montaBreadcrumb($principalBreadcrumb, $retorno_nome);
            $breadcrumb_subtitulo = "Visualizar";
?>

    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="widget">
                <div class="widget-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="nome">Tipo</label>
                                <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $retorno_nome; ?>" disabled>
                            </div>

                            <a href="<?php echo $link."/novo"; ?>" class="btn btn-primary shiny">Novo</a>
                            <a href="<?php echo $link."/editar/".$retorno_id; ?>" class="btn btn-primary shiny">Editar</a>
                            <a href="<?php echo $link; ?>" class="btn btn-primary shiny">Pesquisa</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
        } else {
            echo "<h2>Registro não encontrado.</h2>";
        }
    }
?>