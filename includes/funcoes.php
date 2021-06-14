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
    

    function mudaDataHora($data_hora, $tipo=1) {
        $aux = explode(" ", $data_hora);
        $data = $aux[0];
        $hora = $aux[1];
        
        if ($tipo == 1) {
            $data = explode("-", $data);
            $hora = explode(":", $hora);
            
            $retorno["ano"] = $data[0];
            $retorno["mes"] = $data[1];
            $retorno["dia"] = $data[2];
            $retorno["hora"] = $hora[0];
            $retorno["minuto"] = $hora[1];
            $retorno["segundo"] = $hora[2];
            
        } else if ($tipo == 2) {
            $data = explode("-", $data);
            $hora = explode(":", $hora);
            
            $retorno["ano"] = $data[0];
            $retorno["mes"] = mes($data[1], 2);
            $retorno["dia"] = $data[2];
            $retorno["hora"] = $hora[0];
            $retorno["minuto"] = $hora[1];
            $retorno["segundo"] = $hora[2];
            
        } else if ($tipo == 3) {
            $data = explode("-", $data);
            $hora = explode(":", $hora);
            
            $retorno = $data[2]."/".$data[1]."/".$data[0]." as ".$hora[0]."/".$hora[1]."hs";
            
        } else if ($tipo == 4) {
            // aaaa-mm-dd hh:mm:ss -> mm dd, aaaa hh:mm:ss
            $data = explode("-", $data);
            $hora = explode(":", $hora);
            
            $retorno = $data[1]." ".$data[2].", ".$data[0]." ".$hora[0].":".$hora[1].":".$hora[2];
        
        } else if ($tipo == 5) {
            // aaaa-mm-dd hh:mm:ss -> dd/mm/aaaa hh:mm:ss
            $data = explode("-", $data);
            $hora = explode(":", $hora);
            
            $retorno = $data[2]."/".$data[1]."/".$data[0]." ".$hora[0].":".$hora[1].":".$hora[2];
            
        } else if ($tipo == 6) {
            // dd/mm/aaaa hh:mm:ss -> aaaa-mm-dd hh:mm:ss
            $data = explode("/", $data);
            $hora = explode(":", $hora);
            
            $retorno = $data[2]."-".$data[1]."-".$data[0]." ".$hora[0].":".$hora[1].":".$hora[2];
            
        } else if ($tipo == 7) {
            // aaaa-mm-dd hh:mm:ss -> dd mmm
            $data = explode("-", $data);
            $hora = explode(":", $hora);
            
            $retorno["dia"] = $data[2];
            $retorno["mes"] = mes($data[1], 2);
            
        } else if ($tipo == 8) {
            // aaaa-mm-dd hh:mm:ss -> JAN dd SEXTA 24h59
            $dia_semana_numero = date('w', strtotime($data));
            
            $data = explode("-", $data);
            $hora = mudaHora($hora);
            
            $retorno["dia"] = $data[2];
            $retorno["dia_semana"] = diaSemana($dia_semana_numero, 2);
            $retorno["mes"] = mes($data[1], 2);
            $retorno["hora"] = mudaHora($hora, 3);
            
        } else if ($tipo == 9) {
            // aaaa-mm-dd hh:mm:ss -> JAN dd SEXTA 24h59
            $dia_semana_numero = date('w', strtotime($data));
            
            $data = explode("-", $data);
            $hora = mudaHora($hora);
            
            $dia = $data[2];
            $dia_semana = diaSemana($dia_semana_numero, 2);
            $mes = mes($data[1], 2);
            $hora = mudaHora($hora, 3);
            
            $retorno = $mes." ".$dia." ".$dia_semana.", ".$hora;
            
        } else {
            $retorno = 0;
        }
        
        return $retorno;
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



/*************************************************************/
/********************** DADOS ESTATICOS **********************/
    function simNao($parametro) {
        if ($parametro == 0) {
            $retorno = "Não";
        } else if ($parametro == 1) {
            $retorno = "Sim";
        } else {
            $retorno = "-";
        }
        
        return $retorno;
    }

    function perfil($perfil) {
        if ($perfil == "A") {
            $retorno = "Administrador";
        } else if ($perfil == "G") {
            $retorno = "Gestor";
        } else {
            $retorno = "-";
        }
        
        return $retorno;
    }

    function status($status) {
        if ($status == 0) {
            $retorno = "<b class='red'>Inativo</b>";
        } else if ($status == 1) {
            $retorno = "<b>Ativo</b>";
        } else {
            $retorno = "-";
        }
        
        return $retorno;
    }

    function tipo($tipo) {
        if ($tipo == "materia") {
            $retorno = "Matéria";
        } else if ($tipo == "video") {
            $retorno = "Vídeo";
        } else {
            $retorno = "-";
        }
        
        return $retorno;
    }
    
    function statusPedido($status) {
        if ($status == "F") {
            $retorno = "Fechado";
        } else if ($status == "A") {
            $retorno = "Aberto";
        } else {
            $retorno = "-";
        }
        
        return $retorno;
    }


?>