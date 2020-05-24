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

    if(isset($_GET['ev']) && ctype_digit($_GET['ev'])) {
        $idEven = $_GET['ev'];
        $evento = $conexion->getEvento($idEven);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if($usuario['gestor'] == 1) {
            if(isset($_POST['name']) && is_string($_POST['name']) && !empty($_POST['name'])) {
                $conexion->modificarNombreEvento($idEven, htmlspecialchars($_POST['name']));
            }

            if(isset($_POST['lugar']) && is_string($_POST['lugar']) && !empty($_POST['lugar'])) {
                $conexion->modificarLugarEvento($idEven, htmlspecialchars($_POST['lugar']));
            }

            if(isset($_POST['date']) && !empty($_POST['date'])) {
                $fecha = preg_replace("([^0-9/])", "", $_POST['fecha']);
                $conexion->modificarFechaEvento($idEven, $fecha);
            }

            if(isset($_POST['etiquetas']) && !empty($_POST['etiquetas'])) {
                $conexion->addEtiquetas($idEven, htmlspecialchars($_POST['etiquetas']));
            }

            if(isset($_POST['publicado'])) {
                if(!$conexion->estaPublicado($idEven)) {
                    $conexion->publicarEvento($idEven);
                }
            }

            else if(!isset($_POST['publicado'])) {
                if($conexion->estaPublicado($idEven)) {
                    $conexion->despublicarEvento($idEven);
                }
            }

            if(isset($_FILES['imagen']) && !empty($_FILES['images'])){
                $file_name = $_FILES['imagen']['name'];
                $file_size = $_FILES['imagen']['size'];
                $file_tmp = $_FILES['imagen']['tmp_name'];
                $file_type = $_FILES['imagen']['type'];
                $file_ext = strtolower(end(explode('.',$_FILES['imagen']['name'])));
                
                $extensions= array("jpeg","jpg","png");
                
                if(in_array($file_ext,$extensions) === true && $file_size < 2097152){
                    move_uploaded_file($file_tmp, "img/" . $file_name);

                    $conexion->addImagenGaleria($idEven, $file_name);
                }
            }

            if(isset($_POST['descripcion']) && is_string($_POST['descripcion']) && !empty($_POST['descripcion'])) {
                $conexion->modificarDescripcionEvento($idEven, htmlspecialchars($_POST['descripcion']));
            }

            header("Location: gestioneventos.php");
        }
        exit();
      }

    echo $twig->render('modificarEvento.html', ['evento' => $evento, 'identificado' => $identificado, 'usuario' => $usuario]);
?>