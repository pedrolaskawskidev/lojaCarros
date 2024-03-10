<?php
session_start();

if (empty($_SESSION)) {
    header("Location: index.php");
}
include(__DIR__ . '/../navbar.php');
require_once '../classes/veiculos.php';
require_once '../config.php';

$urlVeiculo = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
$veiculos = new Veiculos();

$abaVeiculo = "Veiculo - Cadastrar";
$marcas = $veiculos->todasMarcas();

if ($urlVeiculo) {

    $abaVeiculo = "Veiculo - Editar";
    $idVeiculo = $urlVeiculo;

    $veiculo = $veiculos->selecionaVeiculo($idVeiculo);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $dadosVeiculo = [
        'id' => $_POST['idModeloVeiculo'],
        'nome_modelo' => $_POST['modeloNome'],
        'ano_modelo' => $_POST['modeloAno'],
        'marca_modelo' => $_POST['modeloMarca'],
        'valor_modelo' => $_POST['modeloValor'],
    ];

    if (isset($_POST['idModeloVeiculo']) && !empty($_POST['idModeloVeiculo'])) {
        $veiculoId = $_POST['idModeloVeiculo'];
        $veiculos->atualizarVeiculo($veiculoId, $dadosVeiculo);
        return header("Location: index.php");
    }

    $veiculos->criaVeiculo($dadosVeiculo);

    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $abaVeiculo ?></title>
    <link rel="stylesheet" href="/styles.css">
</head>

<body>
    <div class="container mt-5">

        <form  method="post">
            <div class="mb-3">
                <input type="hidden" name="idModeloVeiculo" value="<?= isset($veiculo['id']) ? $veiculo['id'] : NULL; ?>">
                <label for="modeloMarca" class="form-label">Marca</label>
                <select class="form-select" name="modeloMarca">
                    <option>Selecione a marca</option>
                    <?php foreach ($marcas as $marca) : ?>
                        <?php $marcaSelecionada = ($veiculo['marca_modelo'] == $marca['id']) ? 'selected' : '' ?>
                        <option value="<?= $marca['id'] ?>" <?= $marcaSelecionada ?>> <?= $marca['nome'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="modeloNome" class="form-label">Modelo</label>
                <input type="text" class="form-control" name="modeloNome" placeholder="Modelo" value="<?= isset($veiculo['nome_modelo'])  ? $veiculo['nome_modelo'] : "" ?>">
            </div>
            <div class="mb-3">
                <label for="modeloAno" class="form-label">Ano</label>
                <input type="text" class="form-control" name="modeloAno" placeholder="Ano" value="<?= isset($veiculo['ano_modelo'])  ? $veiculo['ano_modelo'] : "" ?>">
            </div>
            <div class="mb-3">
                <label for="modeloValor" class="form-label">Valor</label>
                <input type="text" class="form-control" name="modeloValor" placeholder="Valor" value="<?= isset($veiculo['valor_modelo'])  ? $veiculo['valor_modelo'] : "" ?>">
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