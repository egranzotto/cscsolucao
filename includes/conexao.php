<?php
    $conn = mysqli_connect($config_banco_host, $config_banco_user, $config_banco_pass, $config_banco_base);
	
	if (mysqli_connect_errno()) {
		printf("Conexao falhou: %s\n", mysqli_connect_error());
		exit();
	}
?>