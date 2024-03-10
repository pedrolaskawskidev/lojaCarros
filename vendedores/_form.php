<?php
session_start();

if (empty($_SESSION)) {
    header("Location: index.php");
}
include(__DIR__ . '/../navbar.php');
require_once '../classes/vendedores.php';
require_once '../config.php';

$urlVendedores = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);

$vendedores = new Vendedores();
$vendedor = $vendedores->todosVendedores();

$abaVendedor = "Vendedor - Cadastrar";

if ($urlVendedores) {

    $abaVendedor = "Vendedor - Editar";
    $idVendedor = $urlVendedores;

    $vendedor = $vendedores->selecionaVendedor($idVendedor);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $dadosVendedor = [
        'id' => $_POST['idVendedor'],
        'nome' => $_POST['nome'],
        'email' => $_POST['email'],
    ];

    if (isset($_POST['idVendedor']) && !empty($_POST['idVendedor'])) {
        $vendedorId = $_POST['idVendedor'];
        $vendedores->atualizarVendedor($vendedorId, $dadosVendedor);
        return header("Location: index.php");
    }

    $vendedores->criaVendedor($dadosVendedor);

    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $abaVendedor ?></title>
    <link rel="stylesheet" href="/styles.css">
</head>

<body>
    <div class="container mt-5">

        <form  method="post">
            <div class="mb-3">
                <input type="hidden" name="idVendedor" value="<?= isset($vendedor['id']) ? $vendedor['id'] : NULL; ?>">
            </div>
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" placeholder="Nome" value="<?= isset($vendedor['nome'])  ? $vendedor['nome'] : "" ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" placeholder="Email" value="<?= isset($vendedor['email'])  ? $vendedor['email'] : "" ?>">
            </div>
            <div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>