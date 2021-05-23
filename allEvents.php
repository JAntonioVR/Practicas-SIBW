<?php

//
// ──────────────────────────────────────────────────────────────────────────────────────────────────────────
//   :::::: L I S T A D O   D E   T O D O S   L O S   E V E N T O S : :  :   :    :     :        :          :
// ──────────────────────────────────────────────────────────────────────────────────────────────────────────
//

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");


    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    $database = new Database();

    session_start();
    $exito = 0;

    $eventos = $database->getAllEventos();
    if($eventos != -1) $exito = 1;
    else $exito = -1;

    echo $twig->render('allEvents.html',['eventos' => $eventos,
                                         'exito'   => $exito   ]);

?>