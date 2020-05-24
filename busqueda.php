<?php
    include("bd.php");

    $conexion = new BDGestion();

    $resultados = $conexion->busquedaEventos(htmlspecialchars($_GET['valor']));

    echo(json_encode($resultados));
    return json_encode($resultados);
?>