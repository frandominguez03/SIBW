<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conexion = new BDGestion();
        $nick = $_POST['name'];
        $pass = $_POST['password'];
        
        if ($conexion->register($nick, $pass) === 1) {
          
          header("refresh:3;url=login.php");
          echo 'Registrado con éxito. Por favor, inicia sesión.';
        }
        
        else {
          header("Location: register.php");
        }
        
        exit();
      }

    echo $twig->render('register.html', []);
?>