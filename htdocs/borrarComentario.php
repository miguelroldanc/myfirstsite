<?php
    require_once 'C:\xampp\phpMyAdmin\vendor\autoload.php';
    require_once('scripts/bd.php');

    $idComentario = $_POST["idComentario"];
    borrarComentario($idComentario);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
?>