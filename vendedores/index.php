<?php
session_start();

if (empty($_SESSION)) {
    header("Location: index.php");
}
include(__DIR__ . '/../navbar.php');
require_once '../classes/vendedores.php';
require_once '../config.php';

$vendedores = new Vendedores();
$todosVendedores = $vendedores->todosVendedores();


if (isset($_GET['excluir_id'])) {
    $idExcluirVendedor = $_GET['excluir_id'];
    $vendedores->excluirVendedor($idExcluirVendedor);

    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendedores - Todos</title>
    <link rel="stylesheet" href="/styles.css">

</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-end mb-3">
            <a href="_form.php" class="btn btn-success" title="Novo"><i class="bi bi-person-vcard-fill"> Novo + </i></a>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($todosVendedores as $vendedor) : ?>
                    <tr>
                        <td><?= $vendedor['nome']; ?></td>
                        <td><?= $vendedor['email']; ?></td>
                        <td class="col-2">
                            <a class="btn btn-primary" href="_form.php?<?= $vendedor['id'] ?>" title="Editar"><i class="bi bi-pencil-square"></i></a>
                            <a class="btn btn-danger" href="index.php?excluir_id=<?= $vendedor['id'] ?>" title="Excluir"><i class="bi bi-trash3-fill"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

</body>

</html>