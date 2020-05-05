<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    session_start();
    $identificado = false;

    if(isset($_SESSION['identificado'])) {
        $identificado = true;
    }

    if(isset($_GET['ev']) && ctype_digit($_GET['ev'])) {
        $idEv = $_GET['ev'];
    }

    else {
        $idEv = -1;
    }

    $conexion = new BDGestion();

    $evento = $conexion->getEvento($idEv);
    $comentarios = $conexion->getComentarios($idEv);
    $palabras = $conexion->getPalabrasCensuradas();

    if($idEv == 1) {
        $galeria = $conexion->getGaleria();
    }

    echo $twig->render('evento.html', ['evento' => $evento, 'comentarios' => $comentarios, 'palabras' => $palabras, 'galeria' => $galeria, 'identificado' => $identificado]);
?>