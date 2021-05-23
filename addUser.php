<?php

//
// ──────────────────────────────────────────────────────────────────────────────────────────────────────
//   :::::: R E G I S T R A R   U N   N U E V O   U S U A R I O : :  :   :    :     :        :          :
// ──────────────────────────────────────────────────────────────────────────────────────────────────────
//

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    $database = new Database();

    session_start();

    $varsParaTwig = [];
    $varsParaTwig['exito'] = 0;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nickname = $_POST['nickname'];
        $nombre   = $_POST['nombre'];
        $email    = $_POST['email'];
        $clave    = $_POST['clave'];

        $res = $database->insertarUsuario($nickname, $nombre, $email, $clave, "registrado");
        if($res == TRUE) $varsParaTwig['exito'] = 1;
        else $varsParaTwig['exito'] = -1;
    }

    echo $twig->render('addUser.html',$varsParaTwig);
    

?>