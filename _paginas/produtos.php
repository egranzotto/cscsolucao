<?php
    $principalBreadcrumb = "Produtos";
    $breadcrumb = montaBreadcrumb($principalBreadcrumb);
    $breadcrumb_subtitulo = "Lista";
    
    $link = $URL[1];

    if (!isset($URL[2]) OR $URL[2] == "") {
        $breadcrumb_subtitulo = "Lista";
?>
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="widget">
                <div class="widget-body">
                    <div class="table-toolbar">
                        <a id="editabledatatable_new" href="<?php echo $link; ?>/novo" class="btn btn-default">+ Novo</a>
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="simpledatatable">
                        <thead>
                            <tr role="row">
                                <th>Categoria</th>
                                <th>Produto</th>
                                <th>Valor</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $retorno = listaProdutos();
                                
                                if ($retorno != 0) {
                                    for ($i=0; $i<count($retorno); $i++) {
                                        $retorno_id = $retorno[$i]["id"];
                                        $retorno_categoria_nome = $retorno[$i]["categoria_nome"];
                                        $retorno_nome = $retorno[$i]["nome"];
                                        $retorno_valor = $retorno[$i]["valor"];
                            ?>
                            
                            <tr>
                                <td><?php echo $retorno_categoria_nome; ?></td>
                                <td><?php echo $retorno_nome; ?></td>
                                <td><?php echo $retorno_valor; ?></td>
                                <td>
                                    <a href="<?php echo $link."/editar/".$retorno_id; ?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Editar</a>
                                    <a href="<?php echo $link."/visualizar/".$retorno_id; ?>" class="btn btn-info btn-xs"><i class="fa fa-search"></i> Visualizar</a>
                                </td>
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
                                    <label for="id_categoria">Categoria</label>
                                    <select class="form-control" id="id_categoria" name="id_categoria" required>
                                        <option value="">Selecione uma categoria</option>
                                        <?php
                                            $retorno_cat = listaProdutosCategoria();
                                
                                            if ($retorno_cat != 0) {
                                                for ($i=0; $i<count($retorno_cat); $i++) {
                                                    $cat_id = $retorno_cat[$i]["id"];
                                                    $cat_nome = $retorno_cat[$i]["nome"];
                                                    
                                                    echo "<option value='$cat_id'>$cat_nome</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                    
                                </div>
                                   
                                <div class="form-group">
                                    <label for="nome">Produto</label>
                                    <input type="text" id="nome" name="nome" class="form-control" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="descricao">Descrição</label>
                                    <textarea id="descricao" name="descricao" class="form-control" rows="5" required></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="valor">Valor</label>
                                    <input type="number" id="valor" name="valor" class="form-control" required>
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
        
        $retorno = buscaProdutos($id);
        
        if ($retorno != 0) {
            $retorno_id = $retorno["id"];
            $retorno_id_categoria = $retorno["id_categoria"];
            $retorno_nome = $retorno["nome"];
            $retorno_descricao = $retorno["descricao"];
            $retorno_valor = $retorno["valor"];            
            
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
                                    <label for="id_categoria">Categoria</label>
                                    <select class="form-control" id="id_categoria" name="id_categoria" required>
                                        <option value="">Selecione uma categoria</option>
                                        <?php
                                            $retorno_cat = listaProdutosCategoria();
                                
                                            if ($retorno_cat != 0) {
                                                for ($i=0; $i<count($retorno_cat); $i++) {
                                                    $cat_id = $retorno_cat[$i]["id"];
                                                    $cat_nome = $retorno_cat[$i]["nome"];
                                                    
                                                    if ($retorno_id_categoria == $cat_id) {
                                                        echo "<option value='$cat_id' selected>$cat_nome</option>";
                                                    } else {
                                                        echo "<option value='$cat_id'>$cat_nome</option>";
                                                    }
                                                }
                                            }
                                        ?>
                                    </select>
                                    
                                </div>
                                   
                                <div class="form-group">
                                    <label for="nome">Produto</label>
                                    <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $retorno_nome; ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="descricao">Descrição</label>
                                    <textarea id="descricao" name="descricao" class="form-control" rows="5" required><?php echo $retorno_descricao; ?></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="valor">Valor</label>
                                    <input type="number" id="valor" name="valor" class="form-control" value="<?php echo $retorno_valor; ?>" required>
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
        
        $retorno = buscaProdutos($id);
        
        if ($retorno != 0) {
            $retorno_id = $retorno["id"];
            $retorno_id_categoria = $retorno["id_categoria"];
            $retorno_nome = $retorno["nome"];
            $retorno_descricao = $retorno["descricao"];
            $retorno_valor = $retorno["valor"];            
            
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
                                    <label for="id_categoria">Categoria</label>
                                    <select class="form-control" id="id_categoria" name="id_categoria" disabled>
                                        <option value="">Selecione uma categoria</option>
                                        <?php
                                            $retorno_cat = listaProdutosCategoria();
                                
                                            if ($retorno_cat != 0) {
                                                for ($i=0; $i<count($retorno_cat); $i++) {
                                                    $cat_id = $retorno_cat[$i]["id"];
                                                    $cat_nome = $retorno_cat[$i]["nome"];
                                                    
                                                    if ($retorno_id_categoria == $cat_id) {
                                                        echo "<option value='$cat_id' selected>$cat_nome</option>";
                                                    } else {
                                                        echo "<option value='$cat_id'>$cat_nome</option>";
                                                    }
                                                }
                                            }
                                        ?>
                                    </select>
                                    
                                </div>
                                   
                                <div class="form-group">
                                    <label for="nome">Produto</label>
                                    <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $retorno_nome; ?>" disabled>
                                </div>
                                
                                <div class="form-group">
                                    <label for="descricao">Descrição</label>
                                    <textarea id="descricao" name="descricao" class="form-control" rows="5" disabled><?php echo $retorno_descricao; ?></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="valor">Valor</label>
                                    <input type="number" id="valor" name="valor" class="form-control" value="<?php echo $retorno_valor; ?>" disabled>
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