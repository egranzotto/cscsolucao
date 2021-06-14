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
        $email = $_POST["email"];
        $senha = md5($_POST["senha"]);
        $cpf = $_POST["cpf"];
        $data_nascimento = mudaData($_POST["data_nascimento"],2);
        $telefone = $_POST["telefone"];
        
        
        mysqli_query($conn, "INSERT INTO usuarios (nome, email, senha, cpf, data_nascimento, telefone, data_cadastro, data_alteracao) 
                                          VALUES ('$nome', '$email', '$senha', '$cpf', '$data_nascimento', '$telefone', '$data_atual', '$data_atual')");
        
        $id = mysqli_insert_id($conn);
        
        header("location: ../$url/visualizar/$id");
        
        
    } else if ($acao == "editar") {
        $id = $_POST["id"];
        $url = $_POST["url"];
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = md5($_POST["senha"]);
        $cpf = $_POST["cpf"];
        $data_nascimento = mudaData($_POST["data_nascimento"],2);
        $telefone = $_POST["telefone"];
        $senha_old = $_POST["senha_old"];
        
        if ($senha != $senha_old) {
            $senha = md5($senha);
        }
        
        mysqli_query($conn, "UPDATE usuarios
                                SET nome='$nome',
                                    email='$email',
                                    cpf='$cpf',
                                    data_nascimento='$data_nascimento',
                                    telefone='$telefone',
                                    data_alteracao='$data_atual'
                                WHERE id='$id'");

        header("location: ../$url/visualizar/$id");
        
    
    } else if ($acao == "novo_endereco") {
        $id = $_POST["id"];
        $url = $_POST["url"];
        $id_tipo = $_POST["id_tipo"];
        $cep = $_POST["cep"];
        $estado = $_POST["estado"];
        $cidade = $_POST["cidade"];
        $logradouro = $_POST["logradouro"];
        $bairro = $_POST["bairro"];
        
        mysqli_query($conn, "INSERT INTO enderecos (id_usuario, id_tipo, cep, logradouro, bairro, cidade, estado) 
                                          VALUES ('$id', '$id_tipo', '$cep', '$logradouro', '$bairro', '$cidade', '$estado')");

        header("location: ../$url/visualizar/$id");
        
        
    } else if ($acao == "editar_endereco") {
        $id = $_POST["id"];
        $id_endereco = $_POST["id_endereco"];
        $url = $_POST["url"];
        $id_tipo = $_POST["id_tipo"];
        $cep = $_POST["cep"];
        $estado = $_POST["estado"];
        $cidade = $_POST["cidade"];
        $logradouro = $_POST["logradouro"];
        $bairro = $_POST["bairro"];
        
        mysqli_query($conn, "UPDATE enderecos
                                SET id_tipo='$id_tipo',
                                    cep='$cep',
                                    logradouro='$logradouro',
                                    bairro='$bairro',
                                    cidade='$cidade',
                                    estado='$estado'
                                WHERE id='$id_endereco'");
        
        header("location: ../$url/visualizar/$id");
        
        
    } else if ($acao == "excluir_endereco") {
        $id = $_POST["id"];
        $id_endereco = $_POST["id_endereco"];
        $url = $_POST["url"];
        
        mysqli_query($conn, "DELETE FROM enderecos WHERE id='$id_endereco' AND id_usuario='$id'");
        
        header("location: ../$url/visualizar/$id");
        
    } else {
        header("Location: logout.php");
    }
?>