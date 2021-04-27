<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");


    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    $eventosPortada = getEventosPortada();

    echo $twig->render('portada.html',['eventosPortada' => $eventosPortada]);
?>
