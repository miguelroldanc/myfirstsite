<?php
    require_once 'C:\xampp\phpMyAdmin\vendor\autoload.php';
    require_once 'C:\xampp\htdocs\scripts\bd.php';
    
    function startsWith($string, $query){
        return substr($string, 0, strlen($query)) === $query;
    }


    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    $twigVar = [];
    $twigVar['previews'] = obtenerPreviews();
    session_start();
    
    $uri = $_SERVER['REQUEST_URI'];
    if(isset($_SESSION['nickUser'])) {
        $twigVar['user'] = getUsuario($_SESSION['nickUser']);
    }

    if (startsWith($uri, "/evento") ) {
        require_once("scripts/base.php");
    } else {
        echo $twig->render('index.html', $twigVar);
    }
    
?>