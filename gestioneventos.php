<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    session_start();
    $conexion = new BDGestion();
    $identificado = false;

    if(isset($_SESSION['identificado'])) {
        $identificado = true;
    }

    if($identificado) {
        $usuario = $conexion->cargarUsuario($_SESSION['nameUsuario']);
    }

    $eventos = array();

    if($usuario['gestor'] == 1) {
        $eventos = $conexion->getAllEventos();
    }

    echo $twig->render('gestioneventos.html', ['identificado' => $identificado, 'usuario' => $usuario, 'eventos' => $eventos]);
?>