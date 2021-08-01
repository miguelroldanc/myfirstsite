<?php
    require_once 'C:\xampp\phpMyAdmin\vendor\autoload.php';
    require_once('scripts/bd.php');

    function cleanData($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $idComentario = $_POST["idComentario"];
    $comentario = $_POST["nuevoComentario"];

    if($comentario != ""){
        editarComentario($idComentario, $comentario);
    }else{
        borrarComentario($idComentario);
    }
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
?>