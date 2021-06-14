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


    function listaProdutosCategoria() {
        global $conn;
        
        $sql = mysqli_query($conn, "SELECT * FROM produto_categoria");
        
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

    function listaProdutos($id_categoria="") {
        global $conn;
        
        if ($id_categoria == "") {
            $where = "";
        } else {
            $where = "WHERE id_categoria='$id_categoria'";
        }
        
        $sql = mysqli_query($conn, "SELECT * FROM produto $where");
        
        $i=0;
        
        if (mysqli_num_rows($sql) > 0) {
            while ($row = mysqli_fetch_array($sql)) {
                $retorno[$i]["id"] = $row["id"];
                $retorno[$i]["id_categoria"] = $row["id_categoria"];
                $retorno[$i]["nome"] = $row["nome"];
                $retorno[$i]["descricao"] = $row["descricao"];
                $retorno[$i]["valor"] = $row["valor"];
                
                $retorno_cat = buscaProdutosCategoria($row["id_categoria"]);
                $retorno[$i]["categoria_nome"] = $retorno_cat["nome"];
                    
                $i++;
            }
        } else {
            $retorno = 0;
        }
        
        return $retorno;
    }


    function listaPedidos() {
        global $conn;
        
        $sql = mysqli_query($conn, "SELECT * FROM pedido");
        
        $i=0;
        
        if (mysqli_num_rows($sql) > 0) {
            while ($row = mysqli_fetch_array($sql)) {
                $retorno[$i]["id"] = $row["id"];
                $retorno[$i]["id_cliente"] = $row["id_cliente"];
                $retorno[$i]["data"] = mudaDataHora($row["data"],3);
                $retorno[$i]["valor_total"] = $row["valor_total"];
                $retorno[$i]["status"] = statusPedido($row["status"]);
                
                $retorno_cli = buscaClientes($row["id_cliente"]);
                $retorno[$i]["cliente_nome"] = $retorno_cli["nome"];
                    
                $i++;
            }
        } else {
            $retorno = 0;
        }
        
        return $retorno;
    }
    
    
    function listaPedidosProdutos($pedido) {
        global $conn;
        
        $sql = mysqli_query($conn, "SELECT * FROM pedido_produto WHERE id_pedido='$pedido'");
        
        $i=0;
        
        if (mysqli_num_rows($sql) > 0) {
            while ($row = mysqli_fetch_array($sql)) {
                $retorno[$i]["id"] = $row["id"];
                $retorno[$i]["id_pedido"] = $row["id_pedido"];
                $retorno[$i]["id_categoria"] = $row["id_categoria"];
                $retorno[$i]["id_produto"] = $row["id_produto"];
                $retorno[$i]["quant"] = $row["quant"];
                $retorno[$i]["valor_unit"] = $row["valor_unit"];
                $retorno[$i]["valor_total"] = $row["valor_total"];
                
                
                $retorno_prod = buscaProdutos($row["id_produto"]);
                $retorno[$i]["produto_nome"] = $retorno_prod["nome"];
                
                $retorno_cat = buscaProdutosCategoria($row["id_categoria"]);
                $retorno[$i]["categoria_nome"] = $retorno_cat["nome"];
                    
                $i++;
            }
        } else {
            $retorno = 0;
        }
        
        return $retorno;
    }
?>