<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conexion = new BDGestion();
        $nick = htmlspecialchars($_POST['name']);
        $pass = $_POST['password'];
        $pass2 = $_POST['password2'];
        
        if($pass == $pass2) {
          if ($conexion->register($nick, $pass) === 1) {
          
            header("refresh:2;url=login.php");
            echo 'Registrado con éxito. Por favor, inicia sesión.';
          }
        }
        
        else {
          header("Location: register.php");
        }
        
        exit();
      }

    echo $twig->render('register.html', []);
?>