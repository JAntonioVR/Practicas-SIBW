<?php

//
// ──────────────────────────────────────────────────────────────────────────────────────────────────────
//   :::::: M O D I F I C A R   D A T O S   D E   U S U A R I O : :  :   :    :     :        :          :
// ──────────────────────────────────────────────────────────────────────────────────────────────────────
//

    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("modelo.php");

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);

    require_once 'modelo.php';

    $database = new Database();

    session_start();
    $exito = 0;
    $varsParaTwig = [];
    $varsParaTwig['exito'] = 0;
    $errores = array();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nombreNuevo = $_POST['nombreNuevo'];
        $emailNuevo  = $_POST['emailNuevo'];
        $claveNueva = $_POST['claveNueva'];
      
        $res = $database->actualizaInformacion($_SESSION['nicknameUsuario'], $nombreNuevo, $emailNuevo, $claveNueva);

        if($res) $varsParaTwig['exito'] = 1;
        else{
            $varsParaTwig['exito'] = -1;
            $errores[] = "Ha ocurrido algún error al actualizar la información de usuario";
        } 
            
    }

    if (isset($_SESSION['nicknameUsuario'])) {
        $usuario = $database->getUsuario($_SESSION['nicknameUsuario']);
        if($usuario == -1){
            $varsParaTwig['exito'] = -1;
            $errores[] = "No se ha encontrado el usuario";
        }
        else{
            $varsParaTwig['usuario'] = $usuario;
        }
    }
    else{
        $varsParaTwig['exito'] = -1;
        $errores[] = "No hay ningún usuario registrado";
    }

    $varsParaTwig['errores'] = $errores;

    echo $twig->render('modifyUser.html',$varsParaTwig);


?>