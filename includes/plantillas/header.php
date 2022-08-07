<?php
if(!isset($_SESSION)){
    session_start();
}
$auth = $_SESSION['login'] ?? false; // si no existe se pondra false

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Cajerito</title>
</head>

<body>
    <header class="header">

        <a class="nav"  href="index.php">
            <img class="logo" src="img/logo.png" alt="">
            <h1 class="titulo">CAJERO AMIKO</h1>
        </a>
        <?php if($auth):?>
            <a href="cerrar-sesion.php">Cerrar Sesion</a>
        <?php endif;?>

    </header>