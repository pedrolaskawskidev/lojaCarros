<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand"  href="/dashboard.php">Loja Carros</a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Veiculos
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/veiculos/index.php">Todos</a></li>
                    <li><a class="dropdown-item" href="/marcas/index.php">Marca</a></li>
                    <li><a class="dropdown-item" href="/modelos/index.php">Modelo</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Vendedores
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/vendedores/index.php">Todos</a></li>
                    <li><a class="dropdown-item" href="#">Novo</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Vendas
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Todas</a></li>
                    <li><a class="dropdown-item" href="#">Nova</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Clientes
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Todos</a></li>
                    <li><a class="dropdown-item" href="#">Novo</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>