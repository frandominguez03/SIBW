<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    $conexion = new BDGestion();
    $comentario = array();

    session_start();

    if(isset($_SESSION['nameUsuario'])) {
        $usuario = $conexion->cargarUsuario($_SESSION['nameUsuario']);
    }

    $identificado = false;

    if(isset($_SESSION['identificado'])) {
        $identificado = true;
    }

    if(isset($_GET['comen']) && ctype_digit($_GET['comen'])) {
        if($usuario['moderador'] == 1 && $identificado) {
            $idComen = $_GET['comen'];
            $comentario = $conexion->obtenerComentario($idComen);
            $evento = $conexion->getEvento($idEv);
        }
    }

    if(isset($_GET['ev']) && ctype_digit($_GET['ev'])) {
        $idEven = $_GET['ev'];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if($usuario['moderador'] == 1 && $identificado) {
            if(isset($_POST['contenido'])) {
                $conexion->modificarComentario($idComen, htmlspecialchars($_POST['contenido']));

                header("refresh:2;url=evento.php?ev=" . $idEven);
                echo 'Cambios realizados con éxito. Redirigiendo...';
            }
        }
        exit();
      }

    echo $twig->render('modificarComentario.html', ['evento' => $evento, 'comentario' => $comentario, 'identificado' => $identificado, 'usuario' => $usuario]);
?>