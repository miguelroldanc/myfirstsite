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
    $nickErr = $nombreErr = $mailErr = $passErr = "";
    $nick = $pass = $nombre = $mail = "";

    if(empty($_POST['nick'])) {
        $error = true;
        $nickErr = "El usuario no puede estar vacio. ";
    }else{
        $nick = $_POST['nick'];
        $nick = cleanData($nick);
    }

    if(empty($_POST['nombre'])) {
        $error = true;
        $nombreErr = "El nombre no es correcto. ";
    }else{
        $nombre = $_POST['nombre'];
        $nombre = cleanData($nombre);
    }

    if(empty($_POST['mail'])) {
        $error = true;
        $mailErr = "El correo no es correcto. ";
    }else{
        $mail = $_POST['mail'];
        $mail = cleanData($mail);
    }

    if(empty($_POST['pass'])){
        $error = true;
        $passErr = "La contraseña no es correcta. ";
    }else{
        $pass = $_POST['pass'];
        $pass = password_hash($pass, PASSWORD_DEFAULT);
    }

    if($error == true){
        echo "<script type='text/javascript'>alert('$nickErr $nombreErr $mailErr $passErr');</script>";
    }else{
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
            newUser($nick, $pass, $nombre, $mail);

            session_start();
            $_SESSION['nickUser'] = $nick;

            header("Location: index.php");
            exit();
        }else{
            echo "<script type='text/javascript'>alert('El correo no es valido');</script>";
        }
    }
?>