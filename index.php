<?php
    require("includes/config.php");
    require("includes/conexao.php");
    require("includes/funcoes_url.php");
    require("includes/funcoes.php");
    require("includes/funcoes_lista.php");
    require("includes/funcoes_busca.php");
    require("includes/valida_logado.php");
    
    
    if ($sessao_logado == "sim") {
    
        $URL = retornaURL();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Teste Prático</title>
        
        <base href="<?php echo $config_site_base; ?>">

        <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sticky-footer-navbar/">

        <!-- Bootstrap core CSS -->
        <link href="asset/css/bootstrap.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="asset/css/custom.css" rel="stylesheet">
    </head>

    <body>

        <?php require("includes/menu.php"); ?>

        <!-- Begin page content -->
        <main role="main" class="container">
            <div class="page-breadcrumbs">
                <ul class="breadcrumb">

                </ul>
            </div>
               
            <?php 
                require(retornaPagina()); 
            ?>
        </main>

        <?php require("includes/rodape.php"); ?>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="asset/js/jquery-slim.min.js"><\/script>')</script>
        <script src="asset/js/popper.min.js"></script>
        <script src="asset/js/bootstrap.js"></script>
        <script src="asset/js/jquery.mask.js"></script>
        
        
        <?php
            if (file_exists('controle/' . $URL[1] . '.php')) {
                require("controle/" . $URL[1] . ".php");
            }
        ?>
        <script>
            $(document).ready(function(){
                var breadcrumb = '<?php echo $breadcrumb; ?>';
                var breadcrumb_subtitulo = '<?php echo $breadcrumb_subtitulo; ?>';

                $("ul.breadcrumb").html(breadcrumb);
                
                $("li.menu_<?php echo $URL[1]; ?>").addClass("active");
            });
        </script>
    </body>
</html>
<?php
    } else {
        
        $URL = retornaURL();
        
        $aviso = "nao";
        
        if (isset($URL[1]) AND isset($URL[2]) AND $URL[1] == "aviso") {
            if ($URL[2] == "erro_logar") {
                $aviso = "sim";
                $mensagem = "Login/Senha inválida.";
                
            } else {
                $aviso = "nao";
                $mensagem = "";
            }
        }
        
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Login - Teste Prático</title>
        
        <base href="<?php echo $config_site_base; ?>">

        <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sticky-footer-navbar/">

        <!-- Bootstrap core CSS -->
        <link href="asset/css/bootstrap.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="asset/css/custom.css" rel="stylesheet">
    </head>

    <body  class="text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <form id="form" class="form-signin" name="form" method="post" action="acoes/login.php">
                        <h1 class="h3 mb-3 font-weight-normal">Teste Prático</h1>
                        
                        <?php
                            if ($aviso == "sim") {
                        ?>
                            <h5><?php echo $mensagem; ?></h5>
                            <br>
                        <?php 
                            }
                        ?>
                           
                        <div class="form-group">
                            <label for="email" class="sr-only">E-mail</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="E-mail" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="senha" class="sr-only">Senha</label>
                            <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required>
                        </div>
                        <input type="submit" class="btn btn-primary btn-block" value="Logar">
                        <input type="hidden" id="acao" name="acao" value="logar" />
                        <br><br>
                        E-mail: adm@cscsolucao.com.br
                        <br>
                        Senha: 123456
                    </form>
                </div>
            </div>
        </div>
        <?php require("includes/rodape.php"); ?>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="asset/js/jquery-slim.min.js"><\/script>')</script>
        <script src="asset/js/popper.min.js"></script>
        <script src="asset/js/bootstrap.js"></script>
        <script src="asset/js/jquery.mask.min.js"></script>

    </body>
</html>

<?php
    }
?>