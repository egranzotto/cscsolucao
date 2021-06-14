<?php
    function buscaUsuarios($id) {
        global $conn;
        
        $sql = mysqli_query($conn, "SELECT * FROM usuarios WHERE id='$id'");
        
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_array($sql);

            $retorno["id"] = $row["id"];
            $retorno["nome"] = $row["nome"];
            $retorno["email"] = $row["email"];
            $retorno["senha"] = $row["senha"];
            $retorno["telefone"] = $row["telefone"];
            $retorno["cpf"] = $row["cpf"];
            $retorno["data_nascimento"] = mudaData($row["data_nascimento"],1);
            $retorno["data_cadastro"] = mudaData($row["data_cadastro"],1);
            $retorno["data_alteracao"] = mudaData($row["data_alteracao"],1);

        } else {
            $retorno = 0;
        }
        
        return $retorno;
    }


    function buscaTipos($id) {
        global $conn;
        
        $sql = mysqli_query($conn, "SELECT * FROM tipos WHERE id='$id'");
        
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_array($sql);

            $retorno["id"] = $row["id"];
            $retorno["nome"] = $row["nome"];

        } else {
            $retorno = 0;
        }
        
        return $retorno;
    }


    function buscaEnderecos($id) {
        global $conn;
        
        $sql = mysqli_query($conn, "SELECT * FROM enderecos WHERE id='$id'");
        
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_array($sql);
            
            $retorno["id"] = $row["id"];
            $retorno["id_tipo"] = $row["id_tipo"];
            $retorno["cep"] = $row["cep"];
            $retorno["numero"] = $row["numero"];
            $retorno["logradouro"] = $row["logradouro"];
            $retorno["bairro"] = $row["bairro"];
            $retorno["cidade"] = $row["cidade"];
            $retorno["estado"] = $row["estado"];

            $retorno_tipo = buscaTipos($row["id_tipo"]);
            $retorno["tipo_nome"] = $retorno_tipo["nome"];
                
        } else {
            $retorno = 0;
        }
        
        return $retorno;
    }
?>