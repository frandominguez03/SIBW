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

    /* Comprobar los datos de inicio de sesión de un usuario */
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

            $register = $this->conexion->query("INSERT INTO usuarios (name, password, moderador, gestor, super) VALUES ('$nick', '$pass', '$moderador', '$gestor', '$super')");
            return 1;
        }
    }

    /* Cargamos un usuario desde la base de datos */
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

    /* Función para crear un evento */
    function newEvento($nombre, $lugar, $fecha, $contenido, $ruta) {
        $insertar = $this->conexion->query("INSERT INTO eventos (nombre, lugar, fecha, imagen, descripcion) VALUES ('$nombre', '$lugar', '$fecha', '$ruta', '$contenido')");

        $res = $this->conexion->query("SELECT id FROM eventos WHERE nombre='$nombre'");

        if($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $idEvento = array('id' => $row['id']);

            if($idEvento['id'] > 0) {
                return $idEvento['id'];
            }
        }

        return -1;
    }

    /* Función para crear un comentario */
    function newComentario($idEvento, $autor, $comentario) {
        $fecha = date("Y-m-d");
        $this->conexion->query("INSERT INTO comentarios (idEven, autor, fecha, contenido, editado) VALUES ('$idEvento', '$autor', '$fecha', '$comentario', '0')");
    }

    /* Función para cargar todos los eventos de la base de datos */
    function getAllEventos() {
        $res = $this->conexion->query("SELECT * from eventos");

        $eventos = array();

        /* Con esto tenemos un array multidimensional para obtener todos los comentarios a la vez */
        while($row = mysqli_fetch_row($res)) {
            $eventos[] = $row;
        }

        return $eventos;
    }

    /* Función para borrar un evento */
    function borrarEvento($idEvento) {
        $res = $this->conexion->query("DELETE FROM eventos WHERE id='$idEvento'");
    }

    /* Función para cargar todos los usuarios de la base de datos */
    function getAllUsuarios() {
        $res = $this->conexion->query("SELECT * from usuarios");

        $usuarios = array();

        /* Con esto tenemos un array multidimensional para obtener todos los comentarios a la vez */
        while($row = mysqli_fetch_row($res)) {
            $usuarios[] = $row;
        }

        return $usuarios;
    }

    /* Función para cambiar el rol */
    function cambiarPermisos($idUser, $opcion, $rol) {
        $cambio = $opcion ? 1 : 0;
        switch($rol) {
            case 'moderador':
                $res = $this->conexion->query("UPDATE usuarios SET moderador='$cambio' WHERE id='$idUser'");
            break;

            case 'gestor':
                $res = $this->conexion->query("UPDATE usuarios SET gestor='$cambio', moderador='$cambio' WHERE id='$idUser'");
            break;

            case 'super':
                $res = $this->conexion->query("UPDATE usuarios SET gestor='$cambio', moderador='$cambio', super='$cambio' WHERE id='$idUser'");
            break;
        }
    }

    /* Función pra cambiar el nombre */
    function cambiarNombre($antiguo, $nuevo) {
        $res = $this->conexion->query("UPDATE usuarios SET name='$nuevo' WHERE name='$antiguo'");
    }

    /* Función para cambiar la contraseña */
    function cambiarPass($user, $pass) {
        $nuevo = password_hash($pass, PASSWORD_DEFAULT);
        $res = $this->conexion->query("UPDATE usuarios SET password='$nuevo' WHERE name='$user'");
    }

    /* Función para borrar un comentario */
    function borrarComentario($idComen) {
        $res = $this->conexion->query("DELETE FROM comentarios WHERE idComen='$idComen'");
    }

    /* Función para modificar el nombre de un evento */
    function modificarNombreEvento($idEvento, $nombre) {
        $this->conexion->query("UPDATE eventos SET name='$nombre' WHERE id='$idEvento'");
    }

    /* Función para modificar el lugar de un evento */
    function modificarLugarEvento($idEvento, $lugar) {
        $this->conexion->query("UPDATE eventos SET lugar='$lugar' WHERE id='$idEvento'");
    }

    /* Función para modificar la fecha de un evento */
    function modificarFechaEvento($idEvento, $fecha) {
        $this->conexion->query("UPDATE eventos SET fecha='$fecha' WHERE id='$idEvento'");
    }

    /* Función para modificar la imagen de un evento */
    function modificarImagenEvento($idEvento, $img) {
        $this->conexion->query("UPDATE eventos SET imagen='$img' WHERE id='$idEvento'");
    }

    /* Función para modificar la descripción de un evento */
    function modificarDescripcionEvento($idEvento, $nombre) {
        $this->conexion->query("UPDATE eventos SET descripcion='$descripcion' WHERE id='$idEvento'");
    }
}
?>