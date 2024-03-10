<?php
session_start();

if (empty($_SESSION)) {
    header("Location: index.php");
}
include(__DIR__ . '/../navbar.php');
require_once '../classes/modelos.php';
require_once '../classes/marcas.php';
require_once '../config.php';

$modelos = new Modelos();
$todosModelos = $modelos->todosModelos();


if (isset($_GET['excluir_id'])) {
    $idExcluirModelo = $_GET['excluir_id'];
    $modelos->excluirModelo($idExcluirModelo);

    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelos - Todos</title>
    <link rel="stylesheet" href="/styles.css">

</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-end mb-3">
            <a href="_form.php" class="btn btn-success" title="Editar"><i class="bi bi-car-front-fill"> Novo +</i></a>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Modelo</th>
                    <th scope="col">Ano</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($todosModelos as $modelo) : ?>
                    <tr>
                        <td><?= $modelo['nome_modelo']; ?></td>
                        <td><?= $modelo['ano_modelo']; ?></td>
                        <td>R$ <?= $modelo['valor_modelo']; ?></td>
                        <td class="col-2">
                            <a class="btn btn-primary" href="_form.php?<?= $modelo['id'] ?>" title="Editar"><i class="bi bi-pencil-square"></i></a>
                            <a class="btn btn-danger" href="index.php?excluir_id=<?= $modelo['id'] ?>" title="Excluir"><i class="bi bi-trash3-fill"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

</body>

</html>