<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    $conexion = new BDGestion();
    $verificada = false;

    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(!empty($_POST['newName'])) {
            // Verificamos que la contraseña es válida
            if(is_string($_POST['password'])) {
                if($conexion->checkLogin($_SESSION['nameUsuario'], $_POST['password'])) {
                    $verificada = true;
                }
            }

            if($verificada) {
                if(is_string($_POST['newName'])) {
                    $nuevoNombre = $_POST['newName'];
                }

                $conexion->cambiarNombre($_SESSION['nameUsuario'], $nuevoNombre);
                $_SESSION['nameUsuario'] = $nuevoNombre;
                header("refresh:1;url=perfil.php");
                echo 'Nombre cambiado con éxito.';
            }

            $verificada = false;
        }

        if(!empty($_POST['newPass']) && !empty($_POST['newPassConfirm'])) {
            if((is_string($_POST['newPass']) && is_string($_POST['newPassConfirm'])) && $_POST['newPass'] == $_POST['newPassConfirm']) {
                // Verificamos que la contraseña es válida
                if(is_string($_POST['password'])) {
                    if($conexion->checkLogin($_SESSION['nameUsuario'], $_POST['password'])) {
                        $verificada = true;
                    }
                }

                if($verificada) {
                    $conexion->cambiarPass($_SESSION['nameUsuario'], $_POST['newPass']);
                    session_destroy();
                    header("refresh:3;url=login.php");
                    echo 'Contraseña cambiada con éxito. Deberás iniciar sesión...';
                }  
            }
        }
    }

    if(isset($_SESSION['nameUsuario'])) {
        $usuario = $conexion->cargarUsuario($_SESSION['nameUsuario']);
    }

    $identificado = false;

    if(isset($_SESSION['identificado'])) {
        $identificado = true;
    }

    echo $twig->render('perfil.html', ['usuario' => $usuario, 'identificado' => $identificado]);
?>