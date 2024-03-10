<?php
session_start();

if (empty($_SESSION)) {
    header("Location: index.php");
}
include(__DIR__ . '/../navbar.php');
require_once '../classes/modelos.php';
require_once '../classes/marcas.php';
require_once '../config.php';

$urlModelos = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);

$modelos = new Modelos();
$modelo = $modelos->todosModelos();

$abaModelo = "Modelo - Cadastrar";

if ($urlModelos) {

    $abaModelo = "Modelo - Editar";
    $idModelo = $urlModelos;

    $modelo = $modelos->selecionaModelo($idModelo);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $dadosModelo = [
        'id' => $_POST['idModelo'],
        'nome_modelo' => $_POST['modeloNome'],
        'ano_modelo' => $_POST['modeloAno'],
        'valor_modelo' => $_POST['modeloValor'],
    ];

    if (isset($_POST['idModelo']) && !empty($_POST['idModelo'])) {
        $modeloId = $_POST['idModelo'];
        $modelos->atualizarModelo($modeloId, $dadosModelo);
        return header("Location: index.php");
    }

    $modelos->criaModelo($dadosModelo);

    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $abaModelo ?></title>
    <link rel="stylesheet" href="/styles.css">
</head>

<body>
    <div class="container mt-5">

        <form  method="post">
            <div class="mb-3">
                <input type="hidden" name="idModelo" value="<?= isset($modelo['id']) ? $modelo['id'] : NULL; ?>">
            </div>
            <div class="mb-3">
                <label for="modeloNome" class="form-label">Modelo</label>
                <input type="text" class="form-control" name="modeloNome" placeholder="Modelo" value="<?= isset($modelo['nome_modelo'])  ? $modelo['nome_modelo'] : "" ?>">
            </div>
            <div class="mb-3">
                <label for="modeloAno" class="form-label">Ano</label>
                <input type="text" class="form-control" name="modeloAno" placeholder="Ano" value="<?= isset($modelo['ano_modelo'])  ? $modelo['ano_modelo'] : "" ?>">
            </div>
            <div class="mb-3">
                <label for="modeloValor" class="form-label">Valor</label>
                <input type="text" class="form-control" name="modeloValor" placeholder="Valor" value="<?= isset($modelo['valor_modelo'])  ? $modelo['valor_modelo'] : "" ?>">
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