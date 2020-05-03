<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    session_start();
    $identificado = false;

    if(isset($_SESSION['identificado'])) {
        $identificado = true;
    }

    echo $twig->render('index.html', ['identificado' => $identificado]);
?>