<?php 

?>
<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">TESTE PRÁTICO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item menu_inicio">
                    <a class="nav-link" href="inicio">Início</a>
                </li>
                <li class="nav-item menu_usuarios">
                    <a class="nav-link" href="usuarios">Usuários</a>
                </li>
                <li class="nav-item menu_tipos">
                    <a class="nav-link" href="tipos">Tipos</a>
                </li>
                <?php
                /*<li class="nav-item menu_api_google">
                    <a class="nav-link" href="api_google">API Google</a>
                </li>*/
                ?>
                <li class="nav-item menu_api_google">
                    <a class="nav-link" href="acoes/logout.php">Sair</a>
                </li>
            </ul>
        </div>
    </nav>
</header>