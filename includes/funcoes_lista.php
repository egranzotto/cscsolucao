<?php
    function listaUsuarios() {
        global $conn;
        
        $sql = mysqli_query($conn, "SELECT * FROM usuarios");
        
        $i=0;
        
        if (mysqli_num_rows($sql) > 0) {
            while ($row = mysqli_fetch_array($sql)) {
                $retorno[$i]["id"] = $row["id"];
                $retorno[$i]["nome"] = $row["nome"];
                $retorno[$i]["email"] = $row["email"];
                $retorno[$i]["senha"] = $row["senha"];
                $retorno[$i]["telefone"] = $row["telefone"];
                $retorno[$i]["cpf"] = $row["cpf"];
                $retorno[$i]["data_nascimento"] = mudaData($row["data_nascimento"],1);
                $retorno[$i]["data_cadastro"] = mudaData($row["data_cadastro"],1);
                $retorno[$i]["data_alteracao"] = mudaData($row["data_alteracao"],1);
                
                $i++;
            }
        } else {
            $retorno = 0;
        }
        
        return $retorno;
    }

    function listaEnderecos($id_usuario) {
        global $conn;
        
        $sql = mysqli_query($conn, "SELECT * FROM enderecos WHERE id_usuario='$id_usuario'");
        
        $i=0;
        
        if (mysqli_num_rows($sql) > 0) {
            while ($row = mysqli_fetch_array($sql)) {
                $retorno[$i]["id"] = $row["id"];
                $retorno[$i]["id_tipo"] = $row["id_tipo"];
                $retorno[$i]["cep"] = $row["cep"];
                $retorno[$i]["numero"] = $row["numero"];
                $retorno[$i]["logradouro"] = $row["logradouro"];
                $retorno[$i]["bairro"] = $row["bairro"];
                $retorno[$i]["cidade"] = $row["cidade"];
                $retorno[$i]["estado"] = $row["estado"];
                
                $retorno_tipo = buscaTipos($row["id_tipo"]);
                $retorno[$i]["tipo_nome"] = $retorno_tipo["nome"];
                
                $i++;
            }
        } else {
            $retorno = 0;
        }
        
        return $retorno;
    }


    function listaTipos() {
        global $conn;
        
        $sql = mysqli_query($conn, "SELECT * FROM tipos");
        
        $i=0;
        
        if (mysqli_num_rows($sql) > 0) {
            while ($row = mysqli_fetch_array($sql)) {
                $retorno[$i]["id"] = $row["id"];
                $retorno[$i]["nome"] = $row["nome"];
                
                $i++;
            }
        } else {
            $retorno = 0;
        }
        
        return $retorno;
    }
?>