<?php
    if (isset($_SESSION["sessao_logado"]) AND $_SESSION["sessao_logado"] == "sim") {
        
        $sessao_usr_id = $_SESSION["sessao_usr_id"];
        $sessao_usr_nome = $_SESSION["sessao_usr_nome"];
        $sessao_usr_email = $_SESSION["sessao_usr_email"];
        $sessao_logado = $_SESSION["sessao_logado"];
        
    } else {
       // header("Location: acoes/logout.php");
        $sessao_logado = "nao";
    }
?>