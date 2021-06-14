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
        $id_categoria = $_POST["id_categoria"];
        $nome = $_POST["nome"];
        $descricao = $_POST["descricao"];
        $valor = $_POST["valor"];
            
        mysqli_query($conn, "INSERT INTO produto (id_categoria, nome, descricao, valor) VALUES ('$id_categoria', '$nome', '$descricao', '$valor')");
        
        $id = mysqli_insert_id($conn);
        
        header("location: ../$url/visualizar/$id");
        
        
    } else if ($acao == "editar") {
        $id = $_POST["id"];
        $url = $_POST["url"];
        $id_categoria = $_POST["id_categoria"];
        $nome = $_POST["nome"];
        $descricao = $_POST["descricao"];
        $valor = $_POST["valor"];

        mysqli_query($conn, "UPDATE produto 
                                SET id_categoria='$id_categoria',
                                    nome='$nome',
                                    descricao='$descricao',
                                    valor='$valor'
                              WHERE id='$id'");
        
        header("location: ../$url/visualizar/$id");
        
    } else {
        header("Location: logout.php");
    }
?>