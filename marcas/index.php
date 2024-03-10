<?php
session_start();

if (empty($_SESSION)) {
    header("Location: index.php");
}
include(__DIR__ . '/../navbar.php');
require_once '../classes/marcas.php';
require_once '../config.php';

$marcas = new Marcas();
$todasMarcas = $marcas->todasMarcas();


if (isset($_GET['excluir_id'])) {
    $idExcluirMarca = $_GET['excluir_id'];
    $marcas->excluirMarca($idExcluirMarca);

    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcas - Todas</title>
    <link rel="stylesheet" href="/styles.css">

</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-end mb-3">
            <a href="_form.php" class="btn btn-success" title="Editar"><i class="bi bi-badge-tm-fill"> Nova +</i></a>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Marca</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($todasMarcas as $marca) : ?>
                    <tr>
                        <td><?= $marca['nome']; ?></td>
                        <td class="col-2">
                            <a class="btn btn-primary" href="_form.php?<?= $marca['id'] ?>" title="Editar"><i class="bi bi-pencil-square"></i></a>
                            <a class="btn btn-danger" href="index.php?excluir_id=<?= $marca['id'] ?>" title="Excluir"><i class="bi bi-trash3-fill"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

</body>

</html>