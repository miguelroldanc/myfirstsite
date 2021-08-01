<?php
    require_once('scripts/bd.php');

    $palabrotas = getBadWords();
    $myJSON = json_encode($palabrotas);
    header('Content-Type: application/json');
    echo $myJSON;
?>