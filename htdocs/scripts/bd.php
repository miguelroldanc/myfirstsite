<?php

    # Conectar a la BD
    function connect() {
        $mysqli = new mysqli("localhost","coronavirus","covid19","SIBW");
        if($mysqli->connect_errno){
            echo("Fallo al conectar: " . $mysqli->connect_error);
            exit();
        }
        
        return $mysqli;
    }
    
    # Obtener un evento
    function getEvento($idEvento) {
        $mysql = connect();
        
        $evento = array('id' => '0',
                        'titulo' => 'Lorem ipsum', 
                        'subtitulo' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit',
                        'resumen' => 'In id eleifend lorem. Mauris sit amet mauris cursus, mattis elit vestibulum, lacinia turpis. Donec euismod felis vitae risus suscipit rhoncus. Duis pellentesque nulla iaculis diam consequat rutrum. Aliquam aliquam velit sem, vitae pharetra ex condimentum pellentesque. Maecenas sit amet lobortis tortor. Fusce varius hendrerit ex sed aliquet. Donec turpis.',
                        'img_link' => 'logo.png'
                        );
        
        $res = $mysql->query("SELECT id, titulo,subtitulo,resumen,img_link FROM eventos WHERE id=" . $idEvento);
        if($res->num_rows > 0){
            $row = $res->fetch_assoc();
            $evento = array('id'=> $row['id'], 'titulo' => $row['titulo'], 'subtitulo' => $row['subtitulo'], 'resumen' => $row['resumen'], 'img_link' => $row['img_link']);
        }
        
        $arr = array('/images/',$evento['img_link']);
        $evento['img_link'] = join("",$arr);
        return $evento;
    }
    
    # Comprobar el numero de eventos
    function getNumEventos(){
        $mysql = connect();
        $res = $mysql->query("SELECT COUNT(*) FROM eventos");
        return $res;
    }
    
    # Encontrar un evento por su nombre
    function find($nombreEvento){
        $mysql = connect();
        $res = $mysql->query("SELECT id FROM eventos WHERE titulo==$nombreEvento");
        $evento = $res->fetch_assoc();
        return $evento;
    }
    
    # Obtener todos los comentarios
    function getAllComentarios(){
        $mysql = connect();
        $res = $mysql->query("SELECT usuario,fecha,comentario FROM comentarios");
        return $res;
    }
    
    # Obtener todos los comentarios de un evento
    function getComentariosEvento($idEvento){
        $mysql = connect();
        $res = $mysql->query("SELECT id,usuario,fecha,comentario FROM comentarios WHERE evento=" . $idEvento);
        return $res;
    }

    # Subir un comentario a la BD
    function subirComentarioBD($nombre, $comentario, $evento){
        $mysql = connect();
        $query = "INSERT INTO comentarios(evento, fecha, usuario, comentario) VALUES(?, SYSDATE(), ?, ?)";
        if( $res = $mysql->prepare($query) ){
            $res->bind_param("iss", $evento, $nombre, $comentario);
            $res->execute();
        }
    }
    
    # Obtener todas las palabras malsonantes de la BD
    function getBadWords(){
        $mysql = connect();
        $query = "SELECT palabra FROM palabrotas";
        $index = 0;
        $data = array();

        if($res = $mysql->query($query)){
            while($row = mysqli_fetch_row($res)){
                $data[$index] = $row[0];
                $index++;
            }
        }

        return $data;
    }

    # Verificar inicio de sesion de un usuario
    # Para las contraseñas se ha utilizado password_hash('user_pass', PASSWORD_DEFAULT)
    function checkLogin($nick, $password){
        $mysql = connect();
        $res = $mysql->query("SELECT USUARIO,PASS FROM USUARIOS WHERE USUARIO='" . $nick . "'");
        $usuario = $res->fetch_assoc();

        if( !empty($usuario)){
            if(password_verify($password, $usuario['PASS'])){
                return true;
            }
        }

        return false;
    }

    # Devuelve la informacion de un usuario
    function getUsuario($nick){
        $mysql = connect();
        $res = $mysql->query("SELECT * FROM USUARIOS WHERE USUARIO='" . $nick . "'");
        $usuario = $res->fetch_assoc();
        return $usuario;    
    }

    # Dar de alta un nuevo usuario
    function newUser($nick, $pass, $nombre, $mail){
        $mysql = connect();
        $query = "INSERT INTO usuarios(usuario, correo, nombre, pass) VALUES (?, ?, ?, ?)";
        if( $res = $mysql->prepare($query) ){
            $res->bind_param("ssss", $nick, $mail, $nombre, $pass);
            $res->execute();
        }
    }

    # Cambiar el nombre de un usuario
    function cambiarNombreUsuario($nick, $pass, $nombre){
        $mysql = connect();
        if(checkLogin($nick, $pass)){
            $query = "UPDATE usuarios SET nombre=? WHERE usuario = ?";
            if( $res = $mysql->prepare($query) ){
                $res->bind_param("ss", $nombre, $nick);
                $res->execute();
            }
        }        
    }

    # Cambiar el correo de un usuario
    function cambiarCorreoUsuario($nick, $pass, $correo){
        $mysql = connect();
        if(checkLogin($nick, $pass)){
            $query = "UPDATE usuarios SET correo=? WHERE usuario = ?";
            if( $res = $mysql->prepare($query) ){
                $res->bind_param("ss", $correo, $nick);
                $res->execute();
            }
        }        
    }

    # Cambiar datos de un usuario
    function cambiarDatosUsuario($nick, $pass, $nombre, $mail){
        $mysql = connect();
        if(checkLogin($nick, $pass)){
            $query = "UPDATE usuarios SET nombre = ? , correo = ? WHERE usuario = ?";
            if( $res = $mysql->prepare($query) ){
                $res->bind_param("sss", $nombre, $mail, $nick);
                $res->execute();
            }
        }
    }

    # Obtener todos los usuarios
    function obtenerUsuarios(){
        $mysql = connect();
        $res = $mysql->query("SELECT * FROM USUARIOS");
        return $res;
    }

    # Cambiar permisos de un usuario
    function permisosUsuario($nick, $nuevoPermiso){
        $mysql = connect();
        $query = "UPDATE usuarios SET tipo=? where usuario=?";
        if($res = $mysql->prepare($query)){
            $res->bind_param("ss",$nuevoPermiso,$nick);
            $res->execute();
        }
    }

    # Comprobar existencia de comentario
    function existeComentario($idComentario){
        $mysql = connect();
        $query = "SELECT COUNT(*) FROM COMENTARIOS WHERE id=?";
        if($res = $mysql->prepare($query)){
            $res->bind_param("i", $idComentario);
            $cuenta = $res->execute();
            return ($cuenta > 0)? true : false;
        }

        return false;
    }

    # Editar comentario
    function editarComentario($idComentario, $nuevoComentario){
        if(existeComentario($idComentario)){
            $mysql = connect();
            $query = "UPDATE comentarios SET comentario=? WHERE id=?";
            if($res = $mysql->prepare($query)){
                $res->bind_param("si", $nuevoComentario, $idComentario);
                $res->execute();
            }
        }
    }

    # Borrar comentario
    function borrarComentario($idComentario){
        if(existeComentario($idComentario)){
            $mysql = connect();
            $query = "DELETE FROM comentarios WHERE id=?";
            if($res = $mysql->prepare($query)){
                $res->bind_param("i", $idComentario);
                $res->execute();
            }
        }
    }

    # Modificar un evento
    function modificarEvento($idEvento,$titulo,$subtitulo,$resumen){
        $mysql = connect();
        $evento = getEvento($idEvento);
        if($titulo != "") $evento['titulo'] = $titulo;
        if($subtitulo != "") $evento['subtitulo'] = $subtitulo;
        if($resumen != "") $evento['resumen'] = $resumen;
        $query = "UPDATE eventos SET titulo=?,subtitulo=?,resumen=?) WHERE id=?";
        if($res = $mysql->prepare($query)){
            $res->bind_param("sssi", $evento['titulo'], $evento['subtitulo'], $evento['resumen'], $idEvento);
            $res->execute();
        }
    }

    # Borrar evento
    function eliminarEvento($idEvento){
        $mysql = connect();
        $query = "DELETE FROM eventos WHERE id=?";
        if($res = $mysql->prepare($query)){
            $res->bind_param("i", $idEvento);
            $res->execute();
        }
    }

    # Añadir evento
    function anadirEvento($titulo,$subtitulo,$resumen,$img){
        $mysql = connect();
        $query = "INSERT INTO eventos(titulo,subtitulo,resumen,img_link)VALUES(?,?,?,?)";
        if( ($titulo!= "") and ($subtitulo != "") and ($resumen != "") and ($img != "") ){
            if($res = $mysql->prepare($query)){
                $res->bind_param("ssss",$titulo,$subtitulo,$resumen,$img);
                $res->execute();

                $arr = array('/images/',$img);
                $img = join("",$arr);
                $idEvento = find($titulo);
                addPreview($idEvento, $titulo, $subtitulo, $img);
            }
        }
    }

    # Mostrar todos los eventos
    function obtenerEventos(){
        $mysql = connect();
        $res = $mysql->query("SELECT id,titulo FROM eventos");
        return $res;
    }
?>