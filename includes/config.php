<?php
    session_start();

    set_time_limit(0);

    $config_pasta_raiz = "/csc/";                   // DADOS A SER ALTERADO
    $config_link_acesso = "http://localhost/csc/";  // DADOS A SER ALTERADO

    $config_banco_host = "localhost";           // DADOS A SER ALTERADO
    $config_banco_user = "root";                // DADOS A SER ALTERADO
    $config_banco_pass = "";                    // DADOS A SER ALTERADO
    $config_banco_base = "csc";               // DADOS A SER ALTERADO        


    $config_site_base = $config_pasta_raiz;
    
    $data_atual = date("Y-m-d");
    $data_hora = date("Y-m-d H:i:s");
?>