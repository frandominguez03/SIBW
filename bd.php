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
        $res = $this->conexion->query("SELECT id, nombre, lugar, fecha, imagen, descripcion FROM eventos WHERE id=" . $idEvento);

        $evento = array('nombre' => 'Nombre por defecto', 'lugar' => 'Lugar por defecto', 'fecha' => date("Y-m-d"), 'imagen' => '/img/alo.jpg', 'descripcion' => 'Descripción por defecto');

        if($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $evento = array('id' => $row['id'], 'nombre' => $row['nombre'], 'lugar' => $row['lugar'], 'fecha' => $row['fecha'], 'imagen' => $row['imagen'], 'descripcion' => $row['descripcion']);
        }

        return $evento;
    }

    /* Todos los comentarios de un evento */
    function getComentarios($idEvento) {
        $res = $this->conexion->query("SELECT idComen, autor, fecha, contenido, editado FROM comentarios WHERE idEven=" . $idEvento);

        $comentarios = array();

        /* Con esto tenemos un array multidimensional para obtener todos los comentarios a la vez */
        while($row = mysqli_fetch_row($res)) {
            $comentarios[] = $row;
        }

        return $comentarios;
    }

    /* Solo un comentario */
    function obtenerComentario($idComen) {
        $res = $this->conexion->query("SELECT idComen, idEven, autor, fecha, contenido FROM comentarios WHERE idComen=" . $idComen);

        if($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $comentario = array('idComen' => $row['idComen'], 'idEven' => $row['idEven'], 'autor' => $row['autor'], 'fecha' => $row['fecha'], 'contenido' => $row['contenido']);
        }

        return $comentario;
    }

    /* Obtener todos los comentarios */
    function getAllComentarios() {
        $res = $this->conexion->query("SELECT * from comentarios");

        $comentarios = array();

        /* Con esto tenemos un array multidimensional para obtener todos los comentarios a la vez */
        while($row = mysqli_fetch_row($res)) {
            $comentarios[] = $row;
        }

        return $comentarios;
    }

    /* Modificar un comentario */
    function modificarComentario($idComen, $contenido) {
        $res = $this->conexion->query("UPDATE comentarios SET contenido='$contenido', editado='1' WHERE idComen='$idComen'");
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
        $res = $this->conexion->query("SELECT password from usuarios WHERE name='" . $nick . "'");

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
        $res = $this->conexion->query("SELECT id, name, moderador, gestor, super from usuarios WHERE name='" . $nick . "'");

        $usuario = array();

        /* Con esto tenemos un array multidimensional para obtener todos los comentarios a la vez */
        if($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $usuario = array('id' => $row['id'], 'name' => $row['name'], 'moderador' => $row['moderador'], 'gestor' => $row['gestor'], 'super' => $row['super']);
        }

        return $usuario;
    }

    function cambiarNombre($antiguo, $nuevo) {
        $res = $this->conexion->query("UPDATE usuarios SET name='$nuevo' WHERE name='$antiguo'");
    }

    function cambiarPass($user, $pass) {
        $nuevo = password_hash($pass, PASSWORD_DEFAULT);
        $res = $this->conexion->query("UPDATE usuarios SET password='$nuevo' WHERE name='$user'");
    }

    function borrarComentario($idComen) {
        $res = $this->conexion->query("DELETE FROM comentarios WHERE idComen='$idComen'");
        var_dump($res);
    }
}
?>