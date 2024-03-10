<?php
session_start();

if (empty($_SESSION)) {
    header("Location: index.php");
}
include(__DIR__ . '/../navbar.php');
require_once '../classes/marcas.php';
require_once '../config.php';

$urlMarcas = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
$marcas = new Marcas();

$abaMarca = "Marca - Cadastrar";
$marca = $marcas->todasMarcas();

if ($urlMarcas) {

    $abaMarca = "Marca - Editar";
    $idMarca = $urlMarcas;

    $marca = $marcas->selecionaMarca($idMarca);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $dadosMarca = [
        'id' => $_POST['idModeloVeiculo'],
        'nome' => $_POST['marcaNome']
    ];

    if (isset($_POST['idMarca']) && !empty($_POST['idMarca'])) {
        
        $marcaId = $_POST['idMarca'];
        $marcas->atualizarMarca($marcaId, $dadosMarca);
        return header("Location: index.php");
    }

    $marcas->criaMarca($dadosMarca);

    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $abaMarca ?></title>
    <link rel="stylesheet" href="/styles.css">
</head>

<body>
    <div class="container mt-5">

        <form  method="post">
            <div class="mb-3">
                <input type="hidden" name="idMarca" value="<?= isset($marca['id']) ? $marca['id'] : NULL; ?>">
            </div>
            <div class="mb-3">
                <label for="marcaNome" class="form-label">Nome</label>
                <input type="text" class="form-control" name="marcaNome" placeholder="Marca" value="<?= isset($marca['nome'])  ? $marca['nome'] : "" ?>">
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