<?php
    function getEvento($idEvento) {
        $mysqli = new mysqli("mysql", "coronavirus", "covid19", "SIBW");

        if($mysqli->connect_errno) {
            echo("Fallo al conectar: " . $mysqli->connect_errno);
        }

        $res = $mysqli->query("SELECT nombre, lugar, fecha, imagen, descripcion FROM eventos WHERE id=" . $idEvento);

        $evento = array('nombre' => 'Nombre por defecto', 'lugar' => 'Lugar por defecto', 'fecha' => date("Y-m-d"), 'imagen' => '/img/alo.jpg', 'descripcion' => 'Descripción por defecto');

        if($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $evento = array('nombre' => $row['nombre'], 'lugar' => $row['lugar'], 'fecha' => $row['fecha'], 'imagen' => $row['imagen'], 'descripcion' => $row['descripcion']);
        }

        return $evento;
    }
?>