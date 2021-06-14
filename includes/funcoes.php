<?php
	function mudaData($data, $tipo=1) {
		if ($data == "") {
            $data = "-";
        } else {
            if ($tipo == 1) {
                // aaaa-mm-dd -> dd/mm/aaaa
                $aux = explode("-",$data);
                $data = $aux[2]."/".$aux[1]."/".$aux[0];
            } else if ($tipo == 2) {
                // dd/mm/aaaa -> aaaa-mm-dd
                $aux = explode("/",$data);
                $data = $aux[2]."-".$aux[1]."-".$aux[0];
            } else if ($tipo == 3) {
                // aaaa-mm-dd -> dia de mês de ano
                $aux = explode("-",$data);
                $data = $aux[2]." de ".mes($aux[1])." de ".$aux[0];
            }
        }
		return $data;
	}
    
    function correios($cep){
        // formatar o cep removendo caracteres nao numericos
        $cep = preg_replace("/[^0-9]/", "", $cep);
        $url = "http://viacep.com.br/ws/$cep/xml/";

        $xml = simplexml_load_file($url);
        return $xml;
        
        //$endereco = correios("78050-260"); 
        //echo $endereco->uf;
        //echo $endereco->localidade;
        //echo $endereco->logradouro;
        //echo $endereco->bairro;
    }
	

/****************************************************/
/******************** Breadcrumb ********************/
    function montaBreadcrumb($parametro_1="", $parametro_2="", $parametro_3="", $parametro_4="", $parametro_5="", $parametro_6="") {
        global $conn;
        
//        <li><a href="#">Home</a></li>
//        <li><a href="#">Shortcodes</a></li>
//	  	  <li class="active">Animations</li>
        
        $breadcrumb = '<li class="breadcrumb-item"><a href="inicio">Início</a></li>';
            
        if ($parametro_1 != "") {
            $breadcrumb = $breadcrumb.'<li class="breadcrumb-item active">'.$parametro_1.'</li>';
        }
        if ($parametro_2 != "") {
            $breadcrumb = $breadcrumb.'<li class="breadcrumb-item active">'.$parametro_2.'</li>';
        }
        if ($parametro_3 != "") {
            $breadcrumb = $breadcrumb.'<li class="breadcrumb-item active">'.$parametro_3.'</li>';
        }
        if ($parametro_4 != "") {
            $breadcrumb = $breadcrumb.'<li class="breadcrumb-item active">'.$parametro_4.'</li>';
        }
        if ($parametro_5 != "") {
            $breadcrumb = $breadcrumb.'<li class="breadcrumb-item active">'.$parametro_5.'</li>';
        }
        if ($parametro_6 != "") {
            $breadcrumb = $breadcrumb.'<li class="breadcrumb-item active">'.$parametro_6.'</li>';
        }
            
        return $breadcrumb;
    }

?>