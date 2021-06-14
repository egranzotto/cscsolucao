<script>
    $("input#data_nasc").focusout(function() {
        var dataNasc = $(this).val();
        
        var array = new Array();
        array = dataNasc.split('-');
        var novaData = (array[2] + "." + array[1] + "." + array[0]);
        
        var retorno = calcularIdade(novaData);
        
        if (retorno < 18) {
            alert("Cliente não pode ser menor de idade!!!");
            $("input.btnSalvar").attr("disabled", 'disabled');
        } else {
            $("input.btnSalvar").removeAttr('disabled');
        }
    });
    
    
    
    function calcularIdade(data) {
        var now = new Date();
        var today = new Date(now.getYear(),now.getMonth(),now.getDate());

        var yearNow = now.getYear();
        var monthNow = now.getMonth();
        var dateNow = now.getDate();
        var dob = new Date(data.substring(6,10),
                data.substring(3,5)-1,                    
                 data.substring(0,2)                
                );

        var yearDob = dob.getYear();
        var monthDob = dob.getMonth();
        var dateDob = dob.getDate();
        var age = {};
        yearAge = yearNow - yearDob;

        if (monthNow >= monthDob)
            var monthAge = monthNow - monthDob;
        else {
            yearAge--;
            var monthAge = 12 + monthNow -monthDob;
        }

        if (dateNow >= dateDob)
            var dateAge = dateNow - dateDob;
        else {
            monthAge--;
            var dateAge = 31 + dateNow - dateDob;

            if (monthAge < 0) {
              monthAge = 11;
              yearAge--;
            }
          }

        age = {
                years: yearAge,
                months: monthAge,
                days: dateAge
            };
        return age.years;
    }
</script>