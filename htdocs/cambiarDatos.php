<?php
    require_once 'C:\xampp\phpMyAdmin\vendor\autoload.php';
    require_once('scripts/bd.php');

    function cleanData($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $error = false;
    $nickErr = $passErr = "";
    $nick = $pass = $nombre = $mail = "";

    if(empty($_POST['nick'])) {
        $error = true;
        $nickErr = "El usuario no puede estar vacio. ";
    }else{
        $nick = $_POST['nick'];
        $nick = cleanData($nick);
    }

    if(empty($_POST['pass'])){
        $error = true;
        $passErr = "La contraseña no puede estar vacia. ";
    }else{
        $pass = $_POST['pass'];
    }

    $mail = $_POST['mail'];
    $nombre = $_POST['name'];
    if($nombre != ""){
        $nombre = cleanData($nombre);
    }

    if($error == true){
        echo "<script type='text/javascript'>alert('$nickErr $passErr');</script>";
    }else{
        if( ($mail == "") && ($nombre == "") ){
            echo "<script type='text/javascript'>alert('Introduce al menos un campo para cambiar');</script>";
        }else{
            if($mail == ""){
                    cambiarNombreUsuario($nick, $pass, $nombre);
            }
            else if($nombre == ""){
                if( filter_var($mail, FILTER_VALIDATE_EMAIL) ){
                    cambiarCorreoUsuario($nick, $pass, $mail);
                }
            }else{
                cambiarDatosUsuario($nick, $pass, $nombre, $mail);
            }
        }
    }

    header("Location: index.php");
    exit();
?>