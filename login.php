<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conexion = new BDGestion();
        $nick = $_POST['name'];
        $pass = $_POST['password'];
        
        if ($conexion->checkLogin($nick, $pass)) {
          session_start();

          $_SESSION['nameUsuario'] = $nick;  // guardo en la sesión el nick del usuario que se ha logueado
          $_SESSION['identificado'] = true;

          header("refresh:3;url=index.php");
          echo 'Identificado. Redirigiéndote a la página principal...';
        }
        
        else {
            header("Location: login.php");
        }
        
        exit();
      }

    echo $twig->render('login.html', []);
?>