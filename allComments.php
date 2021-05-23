<?php

//
// ──────────────────────────────────────────────────────────────────────────────────────────────────────────────────
//   :::::: L I S T A D O   D E   T O D O S   L O S   C O M E N T A R I O S : :  :   :    :     :        :          :
// ──────────────────────────────────────────────────────────────────────────────────────────────────────────────────
//

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");


    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    $database = new Database();

    session_start();

    $exito = 0;

    $comentarios = $database->getAllComments();

    if($comentarios == -1) $exito = -1;
    else $exito = 1;

    echo $twig->render('allComments.html',['comentarios' => $comentarios,
                                           'exito'       => $exito       ]);

?>