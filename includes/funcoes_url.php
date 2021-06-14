<?php
    function retornaURL() {
        global $config_pasta_raiz;
        
        $REQUEST_URI = filter_input(INPUT_SERVER, 'REQUEST_URI');
//        $REQUEST_URI = str_replace($config_pasta_raiz, "/", $REQUEST_URI);
        $INITE = strpos($REQUEST_URI, '?');
        
        if ($INITE) {
            $REQUEST_URI = substr($REQUEST_URI, 0, $INITE);
        }

        $REQUEST_URI_PASTA = substr($REQUEST_URI, 1);
        $URL = explode('/', $REQUEST_URI_PASTA);
        
        return $URL;
    }
    

    function retornaPagina() {
        $URL = retornaURL();
        
        $pagina = '_paginas/404.php';
        
        if (!isset($URL[1]) OR $URL[1] == "") {
            $pagina = '_paginas/inicio.php';
        } else if (file_exists('_paginas/' . $URL[1] . '.php')) {
            $pagina = '_paginas/' . $URL[1] . '.php';
        } else if (is_dir('_paginas/' . $URL[1]) && (!isset($URL[2]) OR $URL[2] == "")) {
            $pagina = '_paginas/inicio/index.php';
        } else if (is_dir('_paginas_/' . $URL[1]) && file_exists('_paginas/' . $URL[1] . '/' . $URL[2] . '.php')) {
            $pagina = '_paginas/' . $URL[1] . '/' . $URL[2] . '.php';
        }
        
        return $pagina;
    }
?>