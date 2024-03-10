<?php
session_start();

if (empty($_POST) || empty($_POST['login']) || empty($_POST['passwd'])) {
    exit();
}

include('config.php');

$user = $_POST['login'];
$passwd = $_POST['passwd'];

$db = new Database();
$conn = $db->getConexao();

$sqlLogin = "SELECT * FROM users WHERE usuario = :usuario AND senha = :senha";
$stmt = $conn->prepare($sqlLogin);
$stmt->bindParam(':usuario', $user, PDO::PARAM_STR);
$stmt->bindParam(':senha', $passwd, PDO::PARAM_STR);
$stmt->execute();
$return = $stmt->fetch(PDO::FETCH_ASSOC);

$qtd = $stmt->rowCount();

if ($qtd > 0) {
    $_SESSION['login'] = $user;
    $_SESSION['nome'] = $return['nome'];
    $_SESSION['tipo'] = $return['tipo'];
    header("Location: dashboard.php");
    exit();
} else {
    print "<script> alert ('Usuário e/ou senha incorreta(s)'); </script>";
    header("Location: index.php");
    exit();
}
?>
