<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    $conexion = new BDGestion();

    session_start();

    if(isset($_SESSION['nameUsuario'])) {
        $usuario = $conexion->cargarUsuario($_SESSION['nameUsuario']);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['newName'])) {
            if(is_string($_POST['newName'])) {
                $nuevoNombre = $_POST['newName'];
            }
            
            $conexion->cambiarNombre($_SESSION['nameUsuario'], real_escape_string($nuevoNombre));
        }
        
        $nick = $_POST['name'];
        $pass = $_POST['password'];

        if ($conexion->register($nick, $pass) === 1) {
            
            header("refresh:3;url=index.php");
            echo 'Cambios realizados con éxito. Redirigiendo...';
        }

        else {
            header("Location: perfil.php");
        }

        exit();
    }

    $identificado = false;

    if(isset($_SESSION['identificado'])) {
        $identificado = true;
    }

    echo $twig->render('perfil.html', ['usuario' => $usuario, 'identificado' => $identificado]);
?>