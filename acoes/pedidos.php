<?php
    require("../includes/config.php");
    require("../includes/conexao.php");
    require("../includes/funcoes.php");
    require("../includes/funcoes_lista.php");
    require("../includes/funcoes_busca.php");
    require("../includes/valida_logado.php");
    
    if (isset($_POST["acao"])) {
        $acao = $_POST["acao"];
    } else {
        $acao = $_GET["acao"];
    }
    
    if ($acao == "criarPedido") {
        
        mysqli_query($conn, "INSERT INTO pedido (id_cliente, data, valor_total, status) VALUES ('0', '$data_hora', '0', 'A')");
        
        $id = mysqli_insert_id($conn);
        
        header("location: ../pedidos/editar/$id");
        
        
    } else if ($acao == "incluirProduto") {
        $id = $_POST["id"];
        $url = $_POST["url"];
        $id_categoria = $_POST["id_categoria"];
        $id_produto = $_POST["id_produto"];
        $quant = $_POST["quant"];
        
        $retorno = buscaProdutos($id_produto);
        
        $valor = $retorno["valor"];
        $valor_total = $quant * $valor;
        
        
        $sql = mysqli_query($conn, "SELECT * FROM pedido_produto WHERE id_pedido='$id' AND id_produto='$id_produto'");
        
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_array($sql);
            $aux_id = $row["id"];
            $aux_quant = $quant + $row["quant"];
            $aux_valor_total = $valor_total + $row["valor_total"];
            
            mysqli_query($conn, "UPDATE pedido_produto 
                                    SET valor_total='$aux_valor_total',
                                        quant='$aux_quant'
                                  WHERE id='$aux_id'");
        } else {
            mysqli_query($conn, "INSERT INTO pedido_produto (id_pedido, id_categoria, id_produto, quant, valor_unit, valor_total) 
                                 VALUES ('$id', '$id_categoria', '$id_produto', '$quant', '$valor', '$valor_total')");
        }
        
        
        $retorno = listaPedidosProdutos($id);
        
        $valor_total_pedido = 0;
        
        if ($retorno != 0) {
            for ($i=0; $i<count($retorno); $i++) {
                $valor_total_pedido = $valor_total_pedido + $retorno[$i]["valor_total"];
            }
        } else {
            $valor_total_pedido = $valor_total;
        }
        
        mysqli_query($conn, "UPDATE pedido 
                                SET valor_total='$valor_total_pedido'
                              WHERE id='$id'");
        
        header("location: ../$url/editar/$id");
        
        
    } else if ($acao == "excluirProduto") {
        $id = $_GET["id"];
        $id_produto = $_GET["id_produto"];
        
        mysqli_query($conn, "DELETE FROM pedido_produto WHERE id='$id_produto'");
        
        
        $retorno = listaPedidosProdutos($id);
        
        $valor_total_pedido = 0;
        
        if ($retorno != 0) {
            for ($i=0; $i<count($retorno); $i++) {
                $valor_total_pedido = $valor_total_pedido + $retorno[$i]["valor_total"];
            }
        } else {
            $valor_total_pedido = $valor_total;
        }
        
        mysqli_query($conn, "UPDATE pedido 
                                SET valor_total='$valor_total_pedido'
                              WHERE id='$id'");
        
        header("location: ../pedidos/editar/$id");
        
        
    } else if ($acao == "buscaProduto") {
        $id_categoria = $_GET["id_categoria"];
        
        if ($id_categoria != "") {
            $retorno_prod = listaProdutos($id_categoria);

            if ($retorno_prod != 0) {
                echo "<option value=''>Selecione um Produto</option>";

                for ($i=0; $i<count($retorno_prod); $i++) {
                    $prod_id = $retorno_prod[$i]["id"];
                    $prod_nome = $retorno_prod[$i]["nome"];

                    echo "<option value='$prod_id'>$prod_nome</option>";
                }
            } else {
                echo "<option value=''>Nenhum Produto Encontrado</option>";
            }
        } else {
            echo "<option value=''>Selecione Uma Categoria Antes</option>";
        }
        
        
        
    } else if ($acao == "editar") {
        $id = $_POST["id"];
        $url = $_POST["url"];
        $id_cliente = $_POST["id_cliente"];

        mysqli_query($conn, "UPDATE pedido 
                                SET id_cliente='$id_cliente'
                              WHERE id='$id'");
        
        header("location: ../$url/editar/$id");
        
        
    } else if ($acao == "fecharPedido") {
        $id_pedido = $_GET["id_pedido"];

        mysqli_query($conn, "UPDATE pedido 
                                SET data='$data_hora',
                                    status='F'
                              WHERE id='$id_pedido'");
        
        header("location: ../pedidos/visualizar/$id_pedido");
        
    } else {
        header("Location: logout.php");
    }
?>