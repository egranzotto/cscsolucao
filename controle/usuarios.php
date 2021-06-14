<script>
    $('#cep').mask('99999-999');
    $('#telefone').mask('(99)99999-9999');
    $('#data_nascimento').mask('99/99/9999');
    $('#cpf').mask('999.999.999-99');
    
    $("#cep").blur(function() {
        var cep = $(this).val();
        var cep_old = $("input#cep_old").val();
        var url = $("input#url").val();
        var acao = $("input#acao").val();
        var id = $("input#id").val();
        
        
        if (cep != cep_old) {
            
            if (acao == "editar_endereco") {
                var id_endereco = $("input#id_endereco").val();
                location.href = url + "/" + acao + "/" + id + "/" + id_endereco + "/" + cep;
            } else {
                location.href = url + "/" + acao + "/" + id + "/" + cep;
            }
        }
    });
    
    
// Não foi utilizado essa função por causa de problema com o Bootstrap e jQuery
// Erro no $.getJSON
/*
    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#logradouro").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#estado").val("");
    }
    
    $("#cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#rua").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#uf").val("...");
                $("#ibge").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#logradouro").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#estado").val(dados.uf);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
*/
</script>