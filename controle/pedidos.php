<script>
    $("select#id_categoria").change(function() {
        var id_categoria = $(this).val();
        
        $("select#id_produto").load("acoes/pedidos.php?acao=buscaProduto&id_categoria=" + id_categoria);
    });
</script>