<?php

session_start();
unset($_SESSION['login']);
unset($_SESSION['nome']);
unset($_SESSION['tipo']);
session_destroy();
header("Location: index.php");
