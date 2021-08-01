<?php    
    require_once 'C:\xampp\phpMyAdmin\vendor\autoload.php';
    require_once('scripts/bd.php');

    $loader = new \Twig\Loader\FilesystemLoader('/');
    $twig = new \Twig\Environment($loader);
    $twigVar = [];
    
    $twigVar['previews'] = obtenerPreviews();
    $twigVar['eventos'] = obtenerEventos();

    echo $twig->render('eventos.html', $twigVar);
?>