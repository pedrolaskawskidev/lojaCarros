<?php
session_start();

if (empty($_SESSION)) {
    header("Location: index.php");
}
include(__DIR__ . '/../navbar.php');
require_once '../classes/veiculos.php';
require_once '../config.php';

$veiculos = new Veiculos();
$todosVeiculos = $veiculos->todosVeiculos();

if (isset($_GET['excluir_id'])) {
    $idVeiculoParaExcluir = $_GET['excluir_id'];
    $veiculos->excluirVeiculo($idVeiculoParaExcluir);

    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veiculos - Todos</title>
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
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Ano</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($todosVeiculos as $veiculo) : ?>
                    <tr>
                        <td><?= $veiculo['nome']; ?></td>
                        <td><?= $veiculo['nome_modelo']; ?></td>
                        <td><?= $veiculo['ano_modelo']; ?></td>
                        <td>R$ <?= $veiculo['valor_modelo']; ?></td>
                        <td class="col-2">
                            <a class="btn btn-primary" href="_form.php?<?= $veiculo['id'] ?>" title="Editar"><i class="bi bi-pencil-square"></i></a>
                            <a class="btn btn-danger" href="index.php?excluir_id=<?= $veiculo['id'] ?>" title="Excluir"><i class="bi bi-trash3-fill"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>

</html>