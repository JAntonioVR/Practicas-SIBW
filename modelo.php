<?php

class Database{

    private $mysqli;

    public function __construct(){

        $this->mysqli = new mysqli("mysql", "JuanAntonio", "sibw", "SIBW");

        if( $this->mysqli->connect_errno ){
            echo ("Fallo al conectar: " . $this->mysqli->connect_error);

        }
    }

    public function getEvento($idEv){

        $stmt = $this->mysqli->prepare("SELECT nombre, organizador, fecha, lugar, texto, logo, imagenPrincipal, web, twitter, instagram, facebook FROM eventos WHERE id=?");
        $stmt->bind_param("i", $idEv);
        $stmt->execute();
        $res = $stmt->get_result();
        
        $evento = array(
            'nombre'      => 'Nombre por defecto', 
            'organizador' => 'Organizador por defecto',
            'fecha'       => '32 de febrero',
            'lugar'       => 'Lugar por defecto',
            'texto'       => '"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam malesuada nunc ut justo aliquet, a hendrerit lacus posuere. Pellentesque faucibus quam a nunc ullamcorper rutrum. Nunc accumsan vulputate libero quis fermentum. Aliquam nec ex sed diam rutrum pretium sed in diam. In interdum ullamcorper orci, cursus lobortis nibh. Praesent tristique lorem in augue pellentesque, sit amet finibus est egestas. Proin aliquam pharetra mauris. Vivamus tincidunt arcu dolor, non mollis odio gravida a. Etiam suscipit, nisl ac dignissim euismod, orci enim posuere nisl, eget hendrerit risus mauris sit amet augue. Aliquam porttitor ex arcu, hendrerit rutrum velit condimentum eu. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque quis turpis eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla venenatis enim vel tortor pellentesque, eu dapibus elit pellentesque. Duis eleifend non nisi sed luctus. Proin rhoncus justo sit amet suscipit convallis.

            Ut porta dignissim bibendum. Sed augue purus, suscipit ac massa at, aliquet sagittis purus. Fusce vulputate viverra accumsan. Aenean consequat est lorem, sed fringilla metus rhoncus vel. Integer tristique justo sit amet quam blandit feugiat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed egestas est urna, semper pretium lectus volutpat eget. Cras dignissim, justo at dictum lacinia, mi dolor mollis diam, sed ullamcorper sem sem ac quam. Suspendisse vel pharetra orci. Maecenas consectetur eleifend tempor. Donec porttitor mattis sem, sit amet bibendum mi fringilla quis.
            
            Duis non diam sed felis imperdiet tristique sit amet eget arcu. Cras quis vehicula turpis. Morbi non sem nisi. Sed vitae velit sed diam tincidunt accumsan. Ut lacinia placerat congue. Phasellus imperdiet magna ut diam consequat pulvinar. Phasellus ultrices mauris eget urna placerat, eget laoreet odio mollis. Sed quis eleifend tellus. Nam eget tortor vel dui gravida congue. Sed ut tortor sed dui cursus fringilla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce varius eros nec nibh tincidunt, sed pulvinar nisl tincidunt.
            
            Pellentesque et lacus magna. Nunc est orci, consequat et auctor a, ultrices semper nunc. Integer congue odio et eleifend suscipit. Donec varius volutpat pulvinar. Pellentesque hendrerit ullamcorper turpis, quis tincidunt arcu. Aliquam nibh quam, gravida nec pellentesque ac, placerat et ante. Nam eu orci justo. In non nisl quis ex convallis malesuada at sed lorem. Morbi sollicitudin tristique hendrerit. Curabitur convallis urna eget nunc tincidunt porta ac a nisl. Maecenas quis gravida leo. Duis massa odio, egestas vel enim nec, suscipit gravida felis. Curabitur finibus convallis mi, aliquet vulputate mauris sagittis at. Phasellus sodales sem eu lacus condimentum, nec sodales ipsum egestas.',
            'logo'        => '../img/medusa-festival-logo.jpg',
            'imagen'      => '../img/medusa.jpg',
            'web'         => 'https://www.medusasunbeach.com/',
            'twitter'     => 'https://twitter.com/MedusaFestival/',
            'instagram'   => 'https://www.instagram.com/medusa_festival/',
            'facebook'    => 'https://es-es.facebook.com/medusasunbeach'
        );
        
        
        if( $res->num_rows > 0 ){
            $row = $res->fetch_assoc();

            $evento = array(
                'nombre'      => $row['nombre'], 
                'organizador' => $row['organizador'],
                'fecha'       => $row['fecha'],
                'lugar'       => $row['lugar'],
                'texto'       => $row['texto'],
                'logo'        => $row['logo'],
                'imagen'      => $row['imagenPrincipal'],
                'web'         => $row['web'],
                'twitter'     => $row['twitter'],
                'instagram'   => $row['instagram'],
                'facebook'    => $row['facebook']
            );
        }

        $stmt->close();
        return $evento;

    }

    public function getComentarios($idEv){

        $stmt = $this->mysqli->prepare("SELECT autor, fecha_hora, texto FROM comentarios WHERE idEvento=?");
        $stmt->bind_param("i", $idEv);
        $stmt->execute();
        $res = $stmt->get_result();

        $comentario = array(
            'autor'      => 'nadie',
            'fecha_hora' => 'nunca',
            'texto'      => 'nada'
        );
        $num_rows = $res->num_rows;
        
        $comentarios = array();

        for($i = 0; $i < $num_rows; $i++){
            $row = $res->fetch_assoc();
            $date = date_create($row['fecha_hora']);
            $fecha = date_format($date, 'd/m/y   H:i:s');

            $comentario = array(
                'autor' => $row['autor'],
                'fecha_hora' => $fecha,
                'texto' => $row['texto']
            );

            $comentarios[] = $comentario;
        }

        $stmt->close();
        return $comentarios;
    }

    public function getEventosPortada(){

        $stmt = $this->mysqli->prepare("SELECT id, nombre, imagenPrincipal from eventos");
        $stmt->execute();
        $res = $stmt->get_result();

        $num_rows = $res->num_rows;
        $eventos = array();

        for($i = 0; $i < $num_rows; $i++){
            $row = $res->fetch_assoc();
            $id = $row['id'];
            $link = "../evento.php?ev=" . $id;
            $evento = array(
                'nombre' => $row['nombre'],
                'imagen' => $row['imagenPrincipal'],
                'link'   => $link
            );

            $eventos[] = $evento;
        }

        $stmt->close();
        return $eventos;
    }

    public function getGaleria($idEv){

        $stmt = $this->mysqli->prepare("SELECT * from imagenes where idEvento=?");
        $stmt->bind_param("i", $idEv);
        $stmt->execute();
        $res = $stmt->get_result();


        $imagenes = array();
        $num_rows = $res->num_rows;

        for($i = 0; $i < $num_rows; $i++){
            $row = $res->fetch_assoc();   
            $imagenes[] = $row['ruta'];
        }
        $stmt->close();
        return $imagenes;
    }

}


// TODO Funcion conectar base de datos, y hacer que solo se haga una conexion

?>