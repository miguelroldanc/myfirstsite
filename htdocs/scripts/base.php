<?php

    require_once('bd.php');
    
    $twigarray = [];
    $number = substr($uri, 8);
    $idEv = intval($number);
    $evento = getEvento($idEv);
    $comentarios = getComentariosEvento($idEv);

    if(isset($_SESSION['nickUser'])) {
        $twigarray['user'] = getUsuario($_SESSION['nickUser']);
    }
    $twigarray['evento'] = $evento;
    $twigarray['comentarios'] = $comentarios;
    
    echo $twig->render('evento.html', $twigarray);
?>