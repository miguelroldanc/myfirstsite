<?php
    require_once 'C:\xampp\phpMyAdmin\vendor\autoload.php';
    require_once('scripts/bd.php');

    $titulo = $_POST["titulo"];
    $subtitutlo = $_POST["subtitutlo"];
    $resumen = $_POST["resumen"];
    if(isset($_FILES["imagen"])){
        $errores = array();
        $file_name = $_FILES["imagen"]["name"];
        $file_size = $_FILES["imagen"]["size"];
        $file_tmp = $_FILES["imagen"]["tmp_name"];
        $file_type = $_FILES["imagen"]["type"];
        $file_ext = strtolower(end(explode('.',$_FILES["imagen"]["name"])));

        $extensions = array("jpeg","jpg","png");

        if(in_array($file_ext,$extensions) === false){
            $errores[] = "Extension no permitida, elige una imagen JPEG o PNG";
        }
        if($file_size > 2097152){
            $errores[] = "Tamaño de fichero demasiado grande";
        }
        if(empty($errores)==true){
            move_uploaded_file($file_tmp, "images/" . $file_name);
            anadirEvento($titulo,$subtitulo,$resumen,$file_name);
        }
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
?>