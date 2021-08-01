<?php
    require_once 'C:\xampp\phpMyAdmin\vendor\autoload.php';
    require_once 'C:\xampp\htdocs\scripts\bd.php';
    
    function startsWith($string, $query){
        return substr($string, 0, strlen($query)) === $query;
    }

    
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    $twigVar = [];
    session_start();

    $uri = $_SERVER['REQUEST_URI'];
    if(isset($_SESSION['nickUser'])) {
        $twigVar['user'] = getUsuario($_SESSION['nickUser']);
    }

    $number = substr($uri, 8);
    $idEv = intval($number);
    $evento = getEvento($idEv);
    $comentarios = getComentariosEvento($idEv);

    $twigVar['evento'] = $evento;
    $twigVar['comentarios'] = $comentarios;

    echo $twig->render('evento_imprimir.html', $twigVar);
?>