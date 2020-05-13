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

    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        if($usuario['gestor'] == 1) {
            if(isset($_GET['ev']) && ctype_digit($_GET['ev']) && isset($_GET['delete']) && is_string($_GET['delete']) && $_GET['delete'] == true) {
                $conexion->borrarEvento($_GET['ev']);

                if(isset($_GET['evento']) && $_GET['evento'] == true) {
                    header("Location: index.php");
                }

                else {
                    header("Location: gestioneventos.php");
                }
            }
        }
    }

    $eventos = array();

    if($usuario['gestor'] == 1) {
        $eventos = $conexion->getAllEventos();
    }

    echo $twig->render('gestioneventos.html', ['identificado' => $identificado, 'usuario' => $usuario, 'eventos' => $eventos]);
?>