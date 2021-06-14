<script>
    $('#cep').mask('99999-999');
    $('#telefone').mask('(99)99999-9999');
    $('#data_nascimento').mask('99/99/9999');
    $('#cpf').mask('999.999.999-99');
    
    
    $("input#cep").focusout(function() {
        var cep = $(this).val();
        
        //alert(cep);
        
        
     /*   $.ajax({
            method: "POST",
            url: "acoes/correios.php",
            data: { acao: "estado", cep: cep },
            dataType: "html", 
            success: function(data){
                //estado = data;
                
                alert("aaa");
            }
        });
        */
        
        //var estado = $.load("acoes/correios.php?acao=estado&cep=" + cep);
        //$("input#cidade").load("acoes/correios.php?acao=cidade&cep=" + cep);
        //$("input#logradouro").load("acoes/correios.php?acao=logradouro&cep=" + cep);
        //$("input#bairro").load("acoes/correios.php?acao=bairro&cep=" + cep);
        
        
    });
</script>