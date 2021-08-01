<?php
    require_once 'C:\xampp\phpMyAdmin\vendor\autoload.php';
    require_once('scripts/bd.php');

    function cleanData($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $nick = $_POST['nick'];
    $pass = $_POST['pass'];

    $nick = cleanData($nick);
    $pass = cleanData($pass);

    if(checkLogin($nick, $pass)){
        session_start();
        $_SESSION['nickUser'] = $nick;
    }

    header("Location: index.php");
    exit();
?>
