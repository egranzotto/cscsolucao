<?php
    require("../includes/config.php");
    require("../includes/conexao.php");
    require("../includes/funcoes.php");
    
    if (isset($_POST["acao"])) {
        $acao = $_POST["acao"];
    } else {
        $acao = $_GET["acao"];
    }
    
    if ($acao == "logar") {
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $senha = md5($senha);

        $sql = mysqli_query($conn, "SELECT * FROM usuarios WHERE senha='$senha' AND email='$email'");
        
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_array($sql);
            
            $id_usuario = $row["id"];
                        
            $_SESSION["sessao_usr_id"] = $row["id"];
            $_SESSION["sessao_usr_nome"] = $row["nome"];
            $_SESSION["sessao_usr_email"] = $row["email"];
            $_SESSION["sessao_logado"] = "sim";
            
            header("Location: ../");
            
        } else {
            header("Location: ../aviso/erro_logar");
        }
        
        
    } else {
        header("Location: ../");
    }
?>