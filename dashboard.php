<?php
session_start();

if (empty($_SESSION)) {
    header("Location: index.php");
}
include (__DIR__ .'/navbar.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    logou!
</body>

</html>