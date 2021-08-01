<?php
    require_once 'C:\xampp\phpMyAdmin\vendor\autoload.php';
    require_once('scripts/bd.php');

    $idEvento = $_POST["evento"];
    $titulo = $_POST["titulo"];
    $subtitutlo = $_POST["subtitutlo"];
    $resumen = $_POST["resumen"];

    modificarEvento($idEvento,$titulo,$subtitulo,$resumen);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
?>