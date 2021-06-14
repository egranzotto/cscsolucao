<?php
    require("../includes/config.php");
    require("../includes/conexao.php");
    require("../includes/funcoes_lista.php");
    require("../includes/funcoes_busca.php");
    require("../includes/funcoes.php");
    require("../includes/valida_logado.php");
    
    if (isset($_POST["acao"])) {
        $acao = $_POST["acao"];
    } else {
        $acao = $_GET["acao"];
    }
    
    if ($acao == "alterar_senha") {
        $url = $_POST["url"];
        
        $senha_antiga = md5($_POST["senha_antiga"]);
        $nova_senha = md5($_POST["nova_senha"]);
        $confirma_senha = md5($_POST["confirma_senha"]);
        
        
        $sql = mysqli_query($conn, "SELECT * FROM usuario WHERE id='$sessao_usr_id' AND senha='$senha_antiga'");
        
        if (mysqli_num_rows($sql) > 0) {
            if ($nova_senha == $confirma_senha) {
                
                mysqli_query($conn, "UPDATE usuario 
                                        SET senha='$nova_senha'
                                      WHERE id='$sessao_usr_id'");
                
                header("location: ../$url/sucesso");
            } else {
                header("location: ../$url/senha_diferente");
            }
        } else {
            header("location: ../$url/senha_errada");
        }
        
        
    } else {
        header("Location: logout.php");
    }
?>