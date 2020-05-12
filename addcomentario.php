<?php
    include("bd.php");

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

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $identificado && $idEv != -1) { 
        if(isset($_POST['comentario'])) {
            // Saneamos las entradas
            $comentario = htmlspecialchars($_POST['comentario']);
            $conexion->newComentario($idEv, $_SESSION['nameUsuario'], $comentario);

            header("Location: evento.php?ev=" . $idEv);

            exit();
        } 
    }
?>