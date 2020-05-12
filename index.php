<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    session_start();
    $conexion = new BDGestion();

    $identificado = false;
    $usuario = array();

    if(isset($_SESSION['identificado'])) {
        $identificado = true;
        $usuario = $conexion->cargarUsuario($_SESSION['nameUsuario']);
    }

    $eventos = $conexion->getAllEventos();

    echo $twig->render('index.html', ['identificado' => $identificado, 'usuario' => $usuario, 'eventos' => $eventos]);
?>