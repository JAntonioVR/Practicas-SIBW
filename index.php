<?php

//
// ────────────────────────────────────────────────────────────────────────────────────────────────────
//   :::::: C O N T R O L A D O R   D E   L A   P O R T A D A : :  :   :    :     :        :          :
// ────────────────────────────────────────────────────────────────────────────────────────────────────
//

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");


    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    $database = new Database();

    $eventosPortada = $database->getEventosPortada();

    session_start();
    
    if (isset($_SESSION['nicknameUsuario'])) {
        $usuario = $database->getUsuario($_SESSION['nicknameUsuario']);
    }

    echo $twig->render('portada.html',['eventosPortada' => $eventosPortada,
                                       'usuario'        => $usuario ]);
?>
