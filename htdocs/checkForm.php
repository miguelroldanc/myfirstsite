<?php
    header("Content-Type: application/json; charset=UTF-8");
    require_once('scripts/bd.php');

    function despellejarDatos($datos){
        $datos = trim($datos);
        $datos = stripslashes($datos);
        $datos = htmlspecialchars($datos);
        return $datos;
    }

    $array = json_decode($_POST["obj"]);

    $name = $array[0];
    $comm = despellejarDatos($array[1]);
    $evento = $array[2];

    subirComentarioBD($name, $comm, $evento);  
?>