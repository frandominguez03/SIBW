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
        $res = $this->conexion->query("SELECT palabra from palabras");

        $img = array();

        if($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                array_push($img, $row['palabra']);
            }
        }

        return $img;
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

    function checkLogin($nick, $pass) {
        $res = $this->conexion->query("SELECT * from usuarios WHERE name='" . $nick . "'");

        if($res->num_rows > 0) {
            $row = $res->fetch_assoc();
        }

        if(password_verify($pass, $row['password'])) {
            return true;
        }

        return false;
    }

    /* Devuelve 1 si el registro se ha completado, 0 si no se ha podido completar por que el nombre de usuario ya existía */
    function register($nick, $pass) {
        $res = $this->conexion->query("SELECT * from usuarios WHERE name='" . $nick . "'");

        if($res->num_rows > 0) {
            return 0;
        }

        else if(is_string($nick) && is_string($pass)) {
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            $moderador = 0;
            $gestor = 0;
            $super = 0;

            $register = $this->conexion->query("INSERT into usuarios (name, password, moderador, gestor, super) VALUES ('$nick', '$pass', '$moderador', '$gestor', '$super')");
            return 1;
        }
    }

    function cargarUsuario($nick) {
        $res = $this->conexion->query("SELECT * from usuarios WHERE name='" . $nick . "'");

        $usuario = array();

        /* Con esto tenemos un array multidimensional para obtener todos los comentarios a la vez */
        if($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $usuario = array('id' => $row['id'], 'name' => $row['name'], 'moderador' => $row['moderador'], 'gestor' => $row['gestor'], 'super' => $row['super']);
        }

        return $usuario;
    }
}
?>