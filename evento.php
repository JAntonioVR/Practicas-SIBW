<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('html');
    $twig   = new \Twig\Environment($loader);


    $nombreEvento = "Nombre por defecto";
    $organizador  = "Organizador por defecto";
    $fechaEvento  = "Fecha por defecto";
    $texto        = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam malesuada nunc ut justo aliquet, a hendrerit lacus posuere. Pellentesque faucibus quam a nunc ullamcorper rutrum. Nunc accumsan vulputate libero quis fermentum. Aliquam nec ex sed diam rutrum pretium sed in diam. In interdum ullamcorper orci, cursus lobortis nibh. Praesent tristique lorem in augue pellentesque, sit amet finibus est egestas. Proin aliquam pharetra mauris. Vivamus tincidunt arcu dolor, non mollis odio gravida a. Etiam suscipit, nisl ac dignissim euismod, orci enim posuere nisl, eget hendrerit risus mauris sit amet augue. Aliquam porttitor ex arcu, hendrerit rutrum velit condimentum eu. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque quis turpis eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla venenatis enim vel tortor pellentesque, eu dapibus elit pellentesque. Duis eleifend non nisi sed luctus. Proin rhoncus justo sit amet suscipit convallis.

    Ut porta dignissim bibendum. Sed augue purus, suscipit ac massa at, aliquet sagittis purus. Fusce vulputate viverra accumsan. Aenean consequat est lorem, sed fringilla metus rhoncus vel. Integer tristique justo sit amet quam blandit feugiat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed egestas est urna, semper pretium lectus volutpat eget. Cras dignissim, justo at dictum lacinia, mi dolor mollis diam, sed ullamcorper sem sem ac quam. Suspendisse vel pharetra orci. Maecenas consectetur eleifend tempor. Donec porttitor mattis sem, sit amet bibendum mi fringilla quis.
    
    Duis non diam sed felis imperdiet tristique sit amet eget arcu. Cras quis vehicula turpis. Morbi non sem nisi. Sed vitae velit sed diam tincidunt accumsan. Ut lacinia placerat congue. Phasellus imperdiet magna ut diam consequat pulvinar. Phasellus ultrices mauris eget urna placerat, eget laoreet odio mollis. Sed quis eleifend tellus. Nam eget tortor vel dui gravida congue. Sed ut tortor sed dui cursus fringilla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce varius eros nec nibh tincidunt, sed pulvinar nisl tincidunt.
    
    Pellentesque et lacus magna. Nunc est orci, consequat et auctor a, ultrices semper nunc. Integer congue odio et eleifend suscipit. Donec varius volutpat pulvinar. Pellentesque hendrerit ullamcorper turpis, quis tincidunt arcu. Aliquam nibh quam, gravida nec pellentesque ac, placerat et ante. Nam eu orci justo. In non nisl quis ex convallis malesuada at sed lorem. Morbi sollicitudin tristique hendrerit. Curabitur convallis urna eget nunc tincidunt porta ac a nisl. Maecenas quis gravida leo. Duis massa odio, egestas vel enim nec, suscipit gravida felis. Curabitur finibus convallis mi, aliquet vulputate mauris sagittis at. Phasellus sodales sem eu lacus condimentum, nec sodales ipsum egestas.";
    $logoEvento   = "../img/medusa-festival-logo.jpg";
    $imagenEvento = "../img/medusa.jpg";
    $linkWeb      = "https://www.medusasunbeach.com/";
    $linkTwitter  = "https://twitter.com/MedusaFestival/";
    $linkInsta    = "https://www.instagram.com/medusa_festival/";
    $linkFaceBook = "https://es-es.facebook.com/medusasunbeach";



    // TODO Aquí solicitar variables a la BD
    if ($_GET['ev'] == 1){
        $nombreEvento = "Medusa Sunbeach Festival";
        $fechaEvento  = "Del 9 al 15 de Agosto";
    }
    else if ($_GET['ev'] == 2){
        $nombreEvento = "Dreambeach";
        $fechaEvento  = "Del 10 al 16 de Agosto";
    }

    if($_GET['imp'] == 1)
        $file = 'evento_imprimir.html';
    else 
        $file = 'evento.html';


    echo $twig->render($file,[  'nombre'      => $nombreEvento, 
                                        'organizador' => $organizador,
                                        'fecha'       => $fechaEvento,
                                        'texto'       => $texto,
                                        'logo'        => $logoEvento,
                                        'imagen'      => $imagenEvento,
                                        'web'         => $linkWeb,
                                        'twitter'     => $linkTwitter,
                                        'instagram'   => $linkInsta,
                                        'facebook'    => $linkFaceBook
                                    ]);
?>