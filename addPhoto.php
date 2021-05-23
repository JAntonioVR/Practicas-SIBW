<?php

//
// ──────────────────────────────────────────────────────────────────────────────────────────────────────
//   :::::: A N A D I R   I M A G E N   A   L A   G A L E R I A : :  :   :    :     :        :          :
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
    $errors= array();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['idEvento'])){
            $varsParaTwig['idEvento'] = $_POST['idEvento'];
        }
        if(isset($_FILES['nuevaFoto'])){
            $file_name = $_FILES['nuevaFoto']['name'];
            $file_size = $_FILES['nuevaFoto']['size'];
            $file_tmp = $_FILES['nuevaFoto']['tmp_name'];
            $file_type = $_FILES['nuevaFoto']['type'];
            $file_ext = strtolower(end(explode('.',$_FILES['nuevaFoto']['name'])));
            
            $extensions= array("jpeg","jpg","png");
            
            if (in_array($file_ext, $extensions) === false){
                $errors[] = "Extensión no permitida, elige una imagen JPEG o PNG.";
            }
            
            if ($file_size > 2097152){
                $errors[] = 'Tamaño del fichero demasiado grande';
            }
            
            if (empty($errors)==true) {
                move_uploaded_file($file_tmp, "./img/" . $file_name);
                $nuevaFoto = "./img/" . $file_name;
            }
            if (sizeof($errors) > 0) {
                $varsParaTwig['errores'] = $errors;
                $varsParaTwig['exito'] = -1;
            }
            else{
                $idEvento = $_POST['idEvento'];
                $res = $database->addPhoto($nuevaFoto, $idEvento);
    
                if($res === TRUE){
                    $varsParaTwig['exito'] = 1;
                }
            }
        }
    }

    echo $twig->render('addPhoto.html',$varsParaTwig);

?>