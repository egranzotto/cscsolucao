<?php
    require("../includes/config.php");
    require("../includes/conexao.php");
    require("../includes/funcoes.php");
    require("../includes/valida_logado.php");
    
    if (isset($_POST["acao"])) {
        $acao = $_POST["acao"];
    } else {
        $acao = $_GET["acao"];
    }
    
    if ($acao == "novo") {
        $url = $_POST["url"];
        $nome = $_POST["nome"];
            
        mysqli_query($conn, "INSERT INTO tipos (nome) VALUES ('$nome')");
        
        $id = mysqli_insert_id($conn);
        
        header("location: ../$url/visualizar/$id");
        
        
    } else if ($acao == "editar") {
        $id = $_POST["id"];
        $url = $_POST["url"];
        $nome = $_POST["nome"];

        mysqli_query($conn, "UPDATE tipos 
                                SET nome='$nome'
                              WHERE id='$id'");
        
        header("location: ../$url/visualizar/$id");
        
    } else {
        header("Location: logout.php");
    }
?>