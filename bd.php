<?php
class BDGestion {
    private static $conexion;

    public function __construct() {
        $this->conexion = new mysqli("mysql", "coronavirus", "covid19", "SIBW");

        if($conexion->connect_errno) {
            echo("Fallo al conectar: " . $conexion->connect_errno);
        }
    }

    function getEvento($idEvento) {
        $res = $this->conexion->query("SELECT nombre, lugar, fecha, imagen, descripcion FROM eventos WHERE id=" . $idEvento);

        $evento = array('nombre' => 'Nombre por defecto', 'lugar' => 'Lugar por defecto', 'fecha' => date("Y-m-d"), 'imagen' => '/img/alo.jpg', 'descripcion' => 'Descripción por defecto');

        if($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $evento = array('nombre' => $row['nombre'], 'lugar' => $row['lugar'], 'fecha' => $row['fecha'], 'imagen' => $row['imagen'], 'descripcion' => $row['descripcion']);
        }

        return $evento;
    }

    function getComentarios($idEvento) {
        $res = $this->conexion->query("SELECT autor, fecha, contenido FROM comentarios WHERE idEven=" . $idEvento);

        $comentarios = array();

        /* Con esto tenemos un array multidimensional para obtener todos los comentarios a la vez */
        while($row = mysqli_fetch_row($res)) {
            $comentarios[] = $row;
        }

        return $comentarios;
    }

    function getPalabrasCensuradas() {
        $res = $this->conexion->query("SELECT palabra from palabras_censuradas");

        $palabras = array();

        if($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                array_push($palabras, $row['palabra']);
            }
        }

        return json_encode($palabras);
    }

    function getGaleria() {
        $res = $this->conexion->query("SELECT src from galeria");

        $img = array();

        if($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                array_push($img, $row['src']);
            }
        }

        return $img;
    }
}
?>