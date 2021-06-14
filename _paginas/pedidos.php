<?php
    $principalBreadcrumb = "Pedidos";
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
                        <a id="editabledatatable_new" href="acoes/pedidos.php?acao=criarPedido" class="btn btn-default">Criar Pedido</a>
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="simpledatatable">
                        <thead>
                            <tr role="row">
                                <th>Cliente</th>
                                <th>Data/Hora</th>
                                <th>Valor Total</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $retorno = listaPedidos();
                                
                                if ($retorno != 0) {
                                    for ($i=0; $i<count($retorno); $i++) {
                                        $retorno_id = $retorno[$i]["id"];
                                        $retorno_data = $retorno[$i]["data"];
                                        $retorno_valor_total = $retorno[$i]["valor_total"];
                                        $retorno_cliente_nome = $retorno[$i]["cliente_nome"];
                                        $retorno_status = $retorno[$i]["status"];
                            ?>
                            
                            <tr>
                                <td><?php echo $retorno_cliente_nome; ?></td>
                                <td><?php echo $retorno_data; ?></td>
                                <td><?php echo $retorno_valor_total; ?></td>
                                <td><?php echo $retorno_status; ?></td>
                                <td>
                                    <?php
                                        if ($retorno_status == "Aberto") {
                                    ?>
                                    <a href="<?php echo $link."/editar/".$retorno_id; ?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Editar</a>
                                    <?php
                                        }
                                    ?>
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
    } else if ($URL[2] == "editar") { 
        $id = $URL[3];
        
        $retorno = buscaPedidos($id);
        
        if ($retorno != 0) {
            $retorno_id = $retorno["id"];
            $retorno_id_cliente = $retorno["id_cliente"];
            $retorno_valor_total = $retorno["valor_total"];         
            
            $breadcrumb = montaBreadcrumb($principalBreadcrumb, $retorno_id);
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
                                    <label for="id_cliente">Cliente</label>
                                    <select class="form-control" id="id_cliente" name="id_cliente" required>
                                        <option value="">Selecione um Cliente</option>
                                        <?php
                                            $retorno_cli = listaClientes();
                                
                                            if ($retorno_cli != 0) {
                                                for ($i=0; $i<count($retorno_cli); $i++) {
                                                    $cli_id = $retorno_cli[$i]["id"];
                                                    $cli_nome = $retorno_cli[$i]["nome"];
                                                    
                                                    if ($retorno_id_cliente == $cli_id) {
                                                        echo "<option value='$cli_id' selected>$cli_nome</option>";
                                                    } else {
                                                        echo "<option value='$cli_id'>$cli_nome</option>";
                                                    }
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                
                                <input type="hidden" id="acao" name="acao" value="editar" />
                                <input type="hidden" id="url" name="url" value="<?php echo $link; ?>" />
                                <input type="hidden" id="id" name="id" value="<?php echo $retorno_id; ?>" />
                                <input type="submit" class="btn btn-success shiny" value="Salvar" />
                                <a href="acoes/pedidos.php?acao=fecharPedido&id_pedido=<?php echo $retorno_id; ?>" class="btn btn-success shiny">Fechar Pedido</a>
                                <a href="<?php echo $link; ?>" class="btn btn-primary shiny">Cancelar</a>
                            </form>
                        </div>
                    </div>
                            <hr>
                            
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" method="post" action="acoes/<?php echo $link; ?>.php" enctype="multipart/form-data" id="form" name="form">
                                <div class="form-group">
                                    <div class="col-lg-3 col-sm-3 col-xs-3">
                                        <label for="id_categoria">Produto</label>
                                        <select class="form-control" id="id_categoria" name="id_categoria" required>
                                            <option value="">Selecione uma Categoria</option>
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
                                    
                                    <div class="col-lg-5 col-sm-5 col-xs-5">
                                        <label for="id_produto">Produto</label>
                                        <select class="form-control" id="id_produto" name="id_produto" required>
                                            <option value="">Selecione Uma Categoria Antes</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 col-sm-2 col-xs-2">
                                        <label for="quant">Quantidade</label>
                                        <input type="number" id="quant" name="quant" class="form-control" value="1" required>
                                    </div>
                                    <div class="col-lg-2 col-sm-2 col-xs-2">
                                        <br>
                                        <input type="hidden" id="acao" name="acao" value="incluirProduto" />
                                        <input type="hidden" id="url" name="url" value="<?php echo $link; ?>" />
                                        <input type="hidden" id="id" name="id" value="<?php echo $retorno_id; ?>" />
                                        <input type="submit" class="btn btn-success shiny" value="Incluir" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                            <hr>
                            
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-hover table-bordered" id="simpledatatable">
                                <thead>
                                    <tr role="row">
                                        <th>Categoria</th>
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                        <th>Valor Unitário</th>
                                        <th>Valor Total</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $produtos = listaPedidosProdutos($retorno_id);

                                        if ($produtos != 0) {
                                            for ($i=0; $i<count($produtos); $i++) {
                                                $produtos_id = $produtos[$i]["id"];
                                                $produtos_categoria_nome = $produtos[$i]["categoria_nome"];
                                                $produtos_nome = $produtos[$i]["produto_nome"];
                                                $produtos_quant = $produtos[$i]["quant"];
                                                $produtos_valor_unit = $produtos[$i]["valor_unit"];
                                                $produtos_valor_total = $produtos[$i]["valor_total"];
                                    ?>

                                    <tr>
                                        <td><?php echo $produtos_categoria_nome; ?></td>
                                        <td><?php echo $produtos_nome; ?></td>
                                        <td><?php echo $produtos_quant; ?></td>
                                        <td><?php echo $produtos_valor_unit; ?></td>
                                        <td><?php echo $produtos_valor_total; ?></td>
                                        <td>
                                            <a href="<?php echo "acoes/pedidos.php?acao=excluirProduto&id_produto=$produtos_id&id=$retorno_id"; ?>" class="btn btn-info btn-xs"><i class="fa fa-trash"></i> Excluir Produto</a>
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
        </div>
    </div>

<?php
        } else {
            echo "<h2>Registro não encontrado.</h2>";
        }
    } else if ($URL[2] == "visualizar") { 
        $id = $URL[3];
        
        $retorno = buscaPedidos($id);
        
        if ($retorno != 0) {
            $retorno_id = $retorno["id"];
            $retorno_cliente_nome = $retorno["cliente_nome"];
            $retorno_valor_total = $retorno["valor_total"];         
            
            $breadcrumb = montaBreadcrumb($principalBreadcrumb, $retorno_id);
            $breadcrumb_subtitulo = "Visualizar";
?>

    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="widget">
                <div class="widget-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="nome">Cliente</label>
                                <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $retorno_cliente_nome; ?>" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label for="valor_total">Valor Total do Pedido</label>
                                <input type="text" id="valor_total" name="valor_total" class="form-control" value="<?php echo $retorno_valor_total; ?>" disabled>
                            </div>
                            
                        </div>
                    </div>
                    
                    <hr>
                            
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-hover table-bordered" id="simpledatatable">
                                <thead>
                                    <tr role="row">
                                        <th>Categoria</th>
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                        <th>Valor Unitário</th>
                                        <th>Valor Total</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $produtos = listaPedidosProdutos($retorno_id);

                                        if ($produtos != 0) {
                                            for ($i=0; $i<count($produtos); $i++) {
                                                $produtos_categoria_nome = $produtos[$i]["categoria_nome"];
                                                $produtos_nome = $produtos[$i]["produto_nome"];
                                                $produtos_quant = $produtos[$i]["quant"];
                                                $produtos_valor_unit = $produtos[$i]["valor_unit"];
                                                $produtos_valor_total = $produtos[$i]["valor_total"];
                                    ?>

                                    <tr>
                                        <td><?php echo $produtos_categoria_nome; ?></td>
                                        <td><?php echo $produtos_nome; ?></td>
                                        <td><?php echo $produtos_quant; ?></td>
                                        <td><?php echo $produtos_valor_unit; ?></td>
                                        <td><?php echo $produtos_valor_total; ?></td>
                                    </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <hr> 
                    <div class="row">
                        <div class="col-sm-12">
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