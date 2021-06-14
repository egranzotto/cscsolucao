<?php
    $principalBreadcrumb = "Usuários";
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
                        <a id="editabledatatable_new" href="<?php echo $link; ?>/novo" class="btn btn-primary">+ Novo</a>
                    </div>
                    <br>
                    <table class="table table-striped table-hover table-bordered" id="simpledatatable">
                        <thead>
                            <tr role="row">
                                <th>ID</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Data de Cadastro</th>
                                <th>Data de Alteração</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $retorno = listaUsuarios();
                                
                                if ($retorno != 0) {
                                    for ($i=0; $i<count($retorno); $i++) {
                                        $retorno_id = $retorno[$i]["id"];
                                        $retorno_nome = $retorno[$i]["nome"];
                                        $retorno_email = $retorno[$i]["email"];
                                        $retorno_data_cadastro = $retorno[$i]["data_cadastro"];
                                        $retorno_data_alteracao = $retorno[$i]["data_alteracao"];
                            ?>
                            
                            <tr>
                                <td><?php echo $retorno_id; ?></td>
                                <td><?php echo $retorno_nome; ?></td>
                                <td><?php echo $retorno_email; ?></td>
                                <td><?php echo $retorno_data_cadastro; ?></td>
                                <td><?php echo $retorno_data_alteracao; ?></td>
                                <td>
                                    <a href="<?php echo $link."/editar/".$retorno_id; ?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Editar</a>
                                    <a href="<?php echo $link."/novo_endereco/".$retorno_id; ?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Incluir Endereço</a>
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
                                    <label for="nome">Nome Completo</label>
                                    <input type="text" id="nome" name="nome" class="form-control" required>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="email">E-mail</label>
                                            <input type="email" id="email" name="email" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="senha">Senha</label>
                                            <input type="password" id="senha" name="senha" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="cpf">CPF</label>
                                            <input type="text" id="cpf" name="cpf" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="data_nascimento">Data de Nascimento</label>
                                            <input type="text" id="data_nascimento" name="data_nascimento" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="telefone">Celular</label>
                                            <input type="text" id="telefone" name="telefone" class="form-control" required>
                                        </div>
                                    </div>
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

            $retorno = buscaUsuarios($id);

            $retorno_id = $retorno["id"];
            $retorno_nome = $retorno["nome"];
            $retorno_email = $retorno["email"];
            $retorno_senha = $retorno["senha"];
            $retorno_telefone = $retorno["telefone"];
            $retorno_cpf = $retorno["cpf"];
            $retorno_data_nascimento = $retorno["data_nascimento"];    
            $retorno_data_cadastro = $retorno["data_cadastro"];
            $retorno_data_alteracao = $retorno["data_alteracao"];

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
                                    <label for="nome">Nome Completo</label>
                                    <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $retorno_nome; ?>" required>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="email">E-mail</label>
                                            <input type="email" id="email" name="email" class="form-control" value="<?php echo $retorno_email; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="senha">Senha</label>
                                            <input type="password" id="senha" name="senha" class="form-control" value="<?php echo $retorno_senha; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="cpf">CPF</label>
                                            <input type="text" id="cpf" name="cpf" class="form-control" value="<?php echo $retorno_cpf; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="data_nascimento">Data de Nascimento</label>
                                            <input type="text" id="data_nascimento" name="data_nascimento" class="form-control" value="<?php echo $retorno_data_nascimento; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="telefone">Celular</label>
                                            <input type="text" id="telefone" name="telefone" class="form-control" value="<?php echo $retorno_telefone; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr>
                                
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="data_cadastro">Data de Cadastro</label>
                                            <input type="text" id="data_cadastro" name="data_cadastro" class="form-control" value="<?php echo $retorno_data_cadastro; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="data_alteracao">Data de Alteração</label>
                                            <input type="text" id="data_alteracao" name="data_alteracao" class="form-control" value="<?php echo $retorno_data_alteracao; ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                
                                <input type="hidden" id="acao" name="acao" value="editar" />
                                <input type="hidden" id="url" name="url" value="<?php echo $link; ?>" />
                                <input type="hidden" id="id" name="id" value="<?php echo $retorno_id; ?>" />
                                <input type="hidden" id="senha_old" name="senha_old" value="<?php echo $retorno_senha; ?>" />
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
        } else if ($URL[2] == "visualizar") { 
            $id = $URL[3];

            $retorno = buscaUsuarios($id);

            $retorno_id = $retorno["id"];
            $retorno_nome = $retorno["nome"];
            $retorno_email = $retorno["email"];
            $retorno_senha = $retorno["senha"];
            $retorno_telefone = $retorno["telefone"];
            $retorno_cpf = $retorno["cpf"];
            $retorno_data_nascimento = $retorno["data_nascimento"];    
            $retorno_data_cadastro = $retorno["data_cadastro"];
            $retorno_data_alteracao = $retorno["data_alteracao"];

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
                                    <label for="nome">Nome Completo</label>
                                    <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $retorno_nome; ?>" disabled>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="email">E-mail</label>
                                            <input type="email" id="email" name="email" class="form-control" value="<?php echo $retorno_email; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="senha">Senha</label>
                                            <input type="password" id="senha" name="senha" class="form-control" value="<?php echo $retorno_senha; ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="cpf">CPF</label>
                                            <input type="text" id="cpf" name="cpf" class="form-control" value="<?php echo $retorno_cpf; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="data_nascimento">Data de Nascimento</label>
                                            <input type="text" id="data_nascimento" name="data_nascimento" class="form-control" value="<?php echo $retorno_data_nascimento; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="telefone">Celular</label>
                                            <input type="text" id="telefone" name="telefone" class="form-control" value="<?php echo $retorno_telefone; ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr>
                                
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="data_cadastro">Data de Cadastro</label>
                                            <input type="text" id="data_cadastro" name="data_cadastro" class="form-control" value="<?php echo $retorno_data_cadastro; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="data_alteracao">Data de Alteração</label>
                                            <input type="text" id="data_alteracao" name="data_alteracao" class="form-control" value="<?php echo $retorno_data_alteracao; ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                
                                <a href="<?php echo $link."/novo"; ?>" class="btn btn-primary shiny">Novo</a>
                                <a href="<?php echo $link."/editar/".$id; ?>" class="btn btn-primary shiny">Editar</a>
                                <a href="<?php echo $link; ?>" class="btn btn-primary shiny">Pesquisa</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr>
            
            <div class="widget">
                <div class="widget-body">
                    <div class="table-toolbar">
                        <a id="editabledatatable_new" href="<?php echo $link."/novo_endereco/".$retorno_id; ?>" class="btn btn-primary">+ Novo Endereço</a>
                    </div>
                    <br>
                    <h5>Endereços</h5>
                    
                    <?php
                        $endereco = listaEnderecos($retorno_id);

                        if ($endereco != 0) {
                    ?>
                    
                    <table class="table table-striped table-hover table-bordered" id="simpledatatable">
                        <thead>
                            <tr role="row">
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>CEP</th>
                                <th>Estado</th>
                                <th>Cidade</th>
                                <th>Logradouro</th>
                                <th>Número</th>
                                <th>Bairro</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                for ($i=0; $i<count($endereco); $i++) {
                                    $endereco_id = $endereco[$i]["id"];
                                    $endereco_id_tipo = $endereco[$i]["id_tipo"];
                                    $endereco_tipo_nome = $endereco[$i]["tipo_nome"];
                                    $endereco_cep = $endereco[$i]["cep"];
                                    $endereco_logradouro = $endereco[$i]["logradouro"];
                                    $endereco_numero = $endereco[$i]["numero"];
                                    $endereco_bairro = $endereco[$i]["bairro"];
                                    $endereco_cidade = $endereco[$i]["cidade"];
                                    $endereco_estado = $endereco[$i]["estado"];
                                    
                                    $lugar = $endereco_logradouro.", ".$endereco_numero." - ".$endereco_bairro.", ".$endereco_cidade." - ".$endereco_estado;
 
                                    $maps = "https://www.google.com.br/maps/place/".$lugar;
                            ?>
                            
                            <tr>
                                <td><?php echo $endereco_id; ?></td>
                                <td><?php echo $endereco_tipo_nome; ?></td>
                                <td><?php echo $endereco_cep; ?></td>
                                <td><?php echo $endereco_estado; ?></td>
                                <td><?php echo $endereco_cidade; ?></td>
                                <td><?php echo $endereco_logradouro; ?></td>
                                <td><?php echo $endereco_numero; ?></td>
                                <td><?php echo $endereco_bairro; ?></td>
                                <td>
                                    <a href="<?php echo $maps; ?>" class="btn btn-info btn-xs" target="_blank"> Ver Mapa</a>
                                    <a href="<?php echo $link."/editar_endereco/".$retorno_id."/".$endereco_id; ?>" class="btn btn-info btn-xs"> Editar</a>
                                    <a href="<?php echo $link."/excluir_endereco/".$retorno_id."/".$endereco_id; ?>" class="btn btn-danger btn-xs"> Excluir</a>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <?php
                        }
                    ?> 
                </div>
            </div>
        </div>
    </div>


<?php
        } else if ($URL[2] == "novo_endereco") { 
            $id = $URL[3];

            $retorno = buscaUsuarios($id);

            $retorno_id = $retorno["id"];
            $retorno_nome = $retorno["nome"];
            $retorno_email = $retorno["email"];
            $retorno_senha = $retorno["senha"];
            $retorno_telefone = $retorno["telefone"];
            $retorno_cpf = $retorno["cpf"];
            $retorno_data_nascimento = $retorno["data_nascimento"];    
            $retorno_data_cadastro = $retorno["data_cadastro"];
            $retorno_data_alteracao = $retorno["data_alteracao"];

            $breadcrumb = montaBreadcrumb($principalBreadcrumb, $retorno_nome);
            $breadcrumb_subtitulo = "Novo Endereço";
?>

    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="widget">
                <div class="widget-body">
                    <div class="row">
                        <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="nome">Nome Completo</label>
                                            <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $retorno_nome; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="email">E-mail</label>
                                            <input type="email" id="email" name="email" class="form-control" value="<?php echo $retorno_email; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="data_cadastro">Data de Cadastro</label>
                                            <input type="text" id="data_cadastro" name="data_cadastro" class="form-control" value="<?php echo $retorno_data_cadastro; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="data_alteracao">Data de Alteração</label>
                                            <input type="text" id="data_alteracao" name="data_alteracao" class="form-control" value="<?php echo $retorno_data_alteracao; ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr>
                                
                                <a href="<?php echo $link; ?>" class="btn btn-primary shiny">Pesquisa</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr>
            
            <div class="widget">
                <div class="widget-body">
                    <h5>Endereços</h5>
                    
                    
                    <form role="form" method="post" action="acoes/<?php echo $link; ?>.php" enctype="multipart/form-data" id="form" name="form">
                        <div class="form-group">
                            <label for="id_tipo">Tipo de Endereço</label>
                            <select id="id_tipo" name="id_tipo" class="form-control" required>
                                <?php
                                    $tipos = listaTipos();

                                    if ($tipos != 0) {
                                        for ($i=0; $i<count($tipos); $i++) {
                                            $tipos_id = $tipos[$i]["id"];
                                            $tipos_nome = $tipos[$i]["nome"];
                                            
                                            echo "<option value='$tipos_id'>$tipos_nome</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="cep">CEP</label>
                                    <input type="text" id="cep" name="cep" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="estado">Estado</label>
                                    <input type="text" id="estado" name="estado" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="cidade">Cidade</label>
                                    <input type="text" id="cidade" name="cidade" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="logradouro">Logradouro</label>
                                    <input type="text" id="logradouro" name="logradouro" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="numero">Número</label>
                                    <input type="text" id="numero" name="numero" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="bairro">Bairro</label>
                                    <input type="text" id="bairro" name="bairro" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="acao" name="acao" value="novo_endereco" />
                        <input type="hidden" id="url" name="url" value="<?php echo $link; ?>" />
                        <input type="hidden" id="id" name="id" value="<?php echo $retorno_id; ?>" />
                        <input type="submit" class="btn btn-success shiny" value="Salvar Endereço" />
                        <a href="<?php echo $link."/visualizar/".$retorno_id; ?>" class="btn btn-primary shiny">Cancelar</a>
                    </form>
                    
                    
                </div>
            </div>
        </div>
    </div>


<?php
        } else if ($URL[2] == "editar_endereco") { 
            $id = $URL[3];
            $id_endereco = $URL[4];

            $retorno = buscaUsuarios($id);

            $retorno_id = $retorno["id"];
            $retorno_nome = $retorno["nome"];
            $retorno_email = $retorno["email"];
            $retorno_senha = $retorno["senha"];
            $retorno_telefone = $retorno["telefone"];
            $retorno_cpf = $retorno["cpf"];
            $retorno_data_nascimento = $retorno["data_nascimento"];    
            $retorno_data_cadastro = $retorno["data_cadastro"];
            $retorno_data_alteracao = $retorno["data_alteracao"];
            
        
            $endereco = buscaEnderecos($id_endereco);
            
            $endereco_id = $endereco["id"];
            $endereco_id_tipo = $endereco["id_tipo"];
            $endereco_tipo_nome = $endereco["tipo_nome"];    
            $endereco_cep = $endereco["cep"];
            $endereco_logradouro = $endereco["logradouro"];
            $endereco_numero = $endereco["numero"];
            $endereco_bairro = $endereco["bairro"];
            $endereco_cidade = $endereco["cidade"];
            $endereco_estado = $endereco["estado"];
            
        
        
            $breadcrumb = montaBreadcrumb($principalBreadcrumb, $retorno_nome);
            $breadcrumb_subtitulo = "Editar Endereço";
?>

    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="widget">
                <div class="widget-body">
                    <div class="row">
                        <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="nome">Nome Completo</label>
                                            <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $retorno_nome; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="email">E-mail</label>
                                            <input type="email" id="email" name="email" class="form-control" value="<?php echo $retorno_email; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="data_cadastro">Data de Cadastro</label>
                                            <input type="text" id="data_cadastro" name="data_cadastro" class="form-control" value="<?php echo $retorno_data_cadastro; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="data_alteracao">Data de Alteração</label>
                                            <input type="text" id="data_alteracao" name="data_alteracao" class="form-control" value="<?php echo $retorno_data_alteracao; ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr>
                                
                                <a href="<?php echo $link; ?>" class="btn btn-primary shiny">Pesquisa</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr>
            
            <div class="widget">
                <div class="widget-body">
                    <h5>Endereços</h5>
                    
                    
                    <form role="form" method="post" action="acoes/<?php echo $link; ?>.php" enctype="multipart/form-data" id="form" name="form">
                        <div class="form-group">
                            <label for="id_tipo">Tipo de Endereço</label>
                            <select id="id_tipo" name="id_tipo" class="form-control" required>
                                <?php
                                    $tipos = listaTipos();

                                    if ($tipos != 0) {
                                        for ($i=0; $i<count($tipos); $i++) {
                                            $tipos_id = $tipos[$i]["id"];
                                            $tipos_nome = $tipos[$i]["nome"];
                                            
                                            if ($endereco_id_tipo == $tipos_id) {
                                                echo "<option value='$tipos_id' selected>$tipos_nome</option>";
                                            } else {
                                                echo "<option value='$tipos_id'>$tipos_nome</option>";
                                            }
                                        }
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="cep">CEP</label>
                                    <input type="text" id="cep" name="cep" class="form-control" value="<?php echo $endereco_cep; ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="estado">Estado</label>
                                    <input type="text" id="estado" name="estado" class="form-control" value="<?php echo $endereco_estado; ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="cidade">Cidade</label>
                                    <input type="text" id="cidade" name="cidade" class="form-control" value="<?php echo $endereco_cidade; ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="logradouro">Logradouro</label>
                                    <input type="text" id="logradouro" name="logradouro" class="form-control" value="<?php echo $endereco_logradouro; ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="numero">Número</label>
                                    <input type="text" id="numero" name="numero" class="form-control" value="<?php echo $endereco_numero; ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="bairro">Bairro</label>
                                    <input type="text" id="bairro" name="bairro" class="form-control" value="<?php echo $endereco_bairro; ?>" required>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="acao" name="acao" value="editar_endereco" />
                        <input type="hidden" id="url" name="url" value="<?php echo $link; ?>" />
                        <input type="hidden" id="id" name="id" value="<?php echo $retorno_id; ?>" />
                        <input type="hidden" id="id_endereco" name="id_endereco" value="<?php echo $endereco_id; ?>" />
                        <input type="submit" class="btn btn-success shiny" value="Salvar Endereço" />
                        <a href="<?php echo $link."/visualizar/".$retorno_id; ?>" class="btn btn-primary shiny">Cancelar</a>
                    </form>
                    
                    
                </div>
            </div>
        </div>
    </div>


<?php
        } else if ($URL[2] == "excluir_endereco") { 
            $id = $URL[3];
            $id_endereco = $URL[4];

            $retorno = buscaUsuarios($id);

            $retorno_id = $retorno["id"];
            $retorno_nome = $retorno["nome"];
            $retorno_email = $retorno["email"];
            $retorno_senha = $retorno["senha"];
            $retorno_telefone = $retorno["telefone"];
            $retorno_cpf = $retorno["cpf"];
            $retorno_data_nascimento = $retorno["data_nascimento"];    
            $retorno_data_cadastro = $retorno["data_cadastro"];
            $retorno_data_alteracao = $retorno["data_alteracao"];
            
        
            $endereco = buscaEnderecos($id_endereco);
            
            $endereco_id = $endereco["id"];
            $endereco_id_tipo = $endereco["id_tipo"];
            $endereco_tipo_nome = $endereco["tipo_nome"];    
            $endereco_cep = $endereco["cep"];
            $endereco_logradouro = $endereco["logradouro"];
            $endereco_numero = $endereco["numero"];
            $endereco_bairro = $endereco["bairro"];
            $endereco_cidade = $endereco["cidade"];
            $endereco_estado = $endereco["estado"];
            
        
        
            $breadcrumb = montaBreadcrumb($principalBreadcrumb, $retorno_nome);
            $breadcrumb_subtitulo = "Editar Endereço";
?>

    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="widget">
                <div class="widget-body">
                    <div class="row">
                        <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="nome">Nome Completo</label>
                                            <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $retorno_nome; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="email">E-mail</label>
                                            <input type="email" id="email" name="email" class="form-control" value="<?php echo $retorno_email; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="data_cadastro">Data de Cadastro</label>
                                            <input type="text" id="data_cadastro" name="data_cadastro" class="form-control" value="<?php echo $retorno_data_cadastro; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="data_alteracao">Data de Alteração</label>
                                            <input type="text" id="data_alteracao" name="data_alteracao" class="form-control" value="<?php echo $retorno_data_alteracao; ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr>
                                
                                <a href="<?php echo $link; ?>" class="btn btn-primary shiny">Pesquisa</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr>
            
            <div class="widget">
                <div class="widget-body">
                    <h5>Endereços</h5>
                    
                    
                    <form role="form" method="post" action="acoes/<?php echo $link; ?>.php" enctype="multipart/form-data" id="form" name="form">
                        <div class="form-group">
                            <label for="id_tipo">Tipo de Endereço</label>
                            <select id="id_tipo" name="id_tipo" class="form-control" disabled>
                                <?php
                                    $tipos = listaTipos();

                                    if ($tipos != 0) {
                                        for ($i=0; $i<count($tipos); $i++) {
                                            $tipos_id = $tipos[$i]["id"];
                                            $tipos_nome = $tipos[$i]["nome"];
                                            
                                            if ($endereco_id_tipo == $tipos_id) {
                                                echo "<option value='$tipos_id' selected>$tipos_nome</option>";
                                            } else {
                                                echo "<option value='$tipos_id'>$tipos_nome</option>";
                                            }
                                        }
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="cep">CEP</label>
                                    <input type="text" id="cep" name="cep" class="form-control" value="<?php echo $endereco_cep; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="estado">Estado</label>
                                    <input type="text" id="estado" name="estado" class="form-control" value="<?php echo $endereco_estado; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="cidade">Cidade</label>
                                    <input type="text" id="cidade" name="cidade" class="form-control" value="<?php echo $endereco_cidade; ?>" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="logradouro">Logradouro</label>
                                    <input type="text" id="logradouro" name="logradouro" class="form-control" value="<?php echo $endereco_logradouro; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="numero">Número</label>
                                    <input type="text" id="numero" name="numero" class="form-control" value="<?php echo $endereco_numero; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="bairro">Bairro</label>
                                    <input type="text" id="bairro" name="bairro" class="form-control" value="<?php echo $endereco_bairro; ?>" disabled>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="acao" name="acao" value="excluir_endereco" />
                        <input type="hidden" id="url" name="url" value="<?php echo $link; ?>" />
                        <input type="hidden" id="id" name="id" value="<?php echo $retorno_id; ?>" />
                        <input type="hidden" id="id_endereco" name="id_endereco" value="<?php echo $endereco_id; ?>" />
                        <input type="submit" class="btn btn-danger shiny" value="Excluir Endereço" />
                        <a href="<?php echo $link."/visualizar/".$retorno_id; ?>" class="btn btn-primary shiny">Cancelar</a>
                    </form>
                    
                    
                </div>
            </div>
        </div>
    </div>


<?php
        }
?>