<?php

//
// ──────────────────────────────────────────────────────────────────────────────────────────────────────────────
//   :::::: B Ú S Q U E D A   D E   E V E N T O S   P U B L I C A D O S : :  :   :    :     :        :          :
// ──────────────────────────────────────────────────────────────────────────────────────────────────────────────
//

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    echo $twig->render('buscarEventosPublicados.html');

?>