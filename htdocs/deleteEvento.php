<?php
    require_once 'C:\xampp\phpMyAdmin\vendor\autoload.php';
    require_once('scripts/bd.php');

    $idEvento = $_POST["evento"];
    eliminarEvento($idEvento);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
?>