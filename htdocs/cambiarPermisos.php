<?php
    require_once 'C:\xampp\phpMyAdmin\vendor\autoload.php';
    require_once('scripts/bd.php');

    $usuario = $_POST["usuario"];
    $permiso = $_POST["permisos"];
    permisosUsuario($usuario, $permiso);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
?>