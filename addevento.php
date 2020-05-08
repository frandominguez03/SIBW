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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
        if(isset($_POST['name']) && isset($_POST['lugar']) && isset($_POST['fecha']) && isset($_POST['contenido'])) {
            // Saneamos las entradas
            $nombre = htmlspecialchars($_POST['name']);
            $lugar = htmlspecialchars($_POST['lugar']);
            $fecha = preg_replace("([^0-9/])", "", $_POST['fecha']);
            $contenido = htmlspecialchars($_POST['contenido']);

            if(isset($_FILES['imagen'])){
                $file_name = $_FILES['imagen']['name'];
                $file_size = $_FILES['imagen']['size'];
                $file_tmp = $_FILES['imagen']['tmp_name'];
                $file_type = $_FILES['imagen']['type'];
                $file_ext = strtolower(end(explode('.',$_FILES['imagen']['name'])));
                
                $extensions= array("jpeg","jpg","png");
                
                if(in_array($file_ext,$extensions) === true && $file_size < 2097152){
                    move_uploaded_file($file_tmp, "img/" . $file_name);
                    $ruta = "/img/" . $file_name;

                    $idEvento = $conexion->newEvento($nombre, $lugar, $fecha, $contenido, $ruta);

                    if($idEvento !== -1) {
                        header("refresh:2;url=evento.php?ev=" . $idEvento);
                        echo 'Evento creado.';
                    }
                }
            }

            exit();
        } 
    }

    echo $twig->render('addevento.html', ['identificado' => $identificado, 'usuario' => $usuario]);
?>