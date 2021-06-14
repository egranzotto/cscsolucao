<?php
    require("../../config/config.php");
    require("../includes/conexao.php");
    require("../includes/funcoes.php");
    require("../includes/valida_logado.php");
    
    if (isset($_POST["acao"])) {
        $acao = $_POST["acao"];
    } else {
        $acao = $_GET["acao"];
    }
    
    
    if ($acao == "altera_perfil_site") {
        $_SESSION["sessao_usr_id_site"] = $_POST["perfil_site"];
        
        
    } else {
        header("Location: logout.php");
    }
?>