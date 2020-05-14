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

    if(isset($_GET['ev']) && ctype_digit($_GET['ev'])) {
        $idEv = $_GET['ev'];
    }

    else {
        $idEv = -1;
    }

    if($idEv != -1 && $identificado && ($usuario['moderador'] == 1 || $usuario['gestor'] == 1 || $usuario['super'] == 1)) {
        if(isset($_GET['comen']) && ctype_digit($_GET['comen']) && isset($_GET['delete']) && $_GET['delete'] == true) {
            $conexion->borrarComentario($_GET['comen']);
            header("Location: evento.php?ev=" . $idEv);
        }
    }

    $evento = $conexion->getEvento($idEv);
    $comentarios = $conexion->getComentarios($idEv);
    $palabras = $conexion->getPalabrasCensuradas();
    $galeria = $conexion->getGaleria($idEv);
    $etiquetas = $conexion->getEtiquetas($idEv);

    echo $twig->render('evento.html', ['evento' => $evento, 'comentarios' => $comentarios, 'palabras' => $palabras, 'galeria' => $galeria, 'etiquetas' => $etiquetas, 'usuario' => $usuario, 'identificado' => $identificado]);
?>