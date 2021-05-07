<?php

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");


    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    $database = new Database();

    session_start();

    $eventos = $database->getAllEventos();

    echo $twig->render('allEvents.html',['eventos' => $eventos]);

?>