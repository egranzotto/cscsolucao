<?php
    require("../includes/config.php");
    require("../includes/conexao.php");
    require("../includes/funcoes.php");
    require("../includes/valida_logado.php");

    function correios($cep){
        // formatar o cep removendo caracteres nao numericos
        $cep = preg_replace("/[^0-9]/", "", $cep);
        $url = "http://viacep.com.br/ws/$cep/xml/";

        $xml = simplexml_load_file($url);
        return $xml;
    }
    
    $endereco = correios("78050-260"); 
    
    $estado = $endereco->uf;
    $cidade = $endereco->localidade;
    $logradouro = $endereco->logradouro;
    $bairro = $endereco->bairro;
    
    $acao = $_POST["acao"];
    $cep = $_POST["cep"];

    if ($acao == "estado") {
        echo $estado;
        
    } else if ($acao == "cidade") {
        echo $cidade;
        
    } else if ($acao == "logradouro") {
        echo $logradouro;
        
    } else if ($acao == "bairro") {
        echo $bairro;
    }
?>