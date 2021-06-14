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
        $data_nasc = $_POST["data_nasc"];
        
        mysqli_query($conn, "INSERT INTO cliente (nome, data_nasc) 
                                          VALUES ('$nome', '$data_nasc')");
        
        $id = mysqli_insert_id($conn);
        
        header("location: ../$url/visualizar/$id");
        
        
    } else if ($acao == "editar") {
        $id = $_POST["id"];
        $url = $_POST["url"];
        $nome = $_POST["nome"];
        $data_nasc = $_POST["data_nasc"];
        
        if ($senha != $senha_old) {
            $senha = md5($senha);
        }
        
        mysqli_query($conn, "UPDATE cliente
                                SET nome='$nome',
                                    data_nasc='$data_nasc'
                              WHERE id='$id'");

        header("location: ../$url/visualizar/$id");
        
        
    } else {
        header("Location: logout.php");
    }
?>