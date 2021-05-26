<?php

//
// ──────────────────────────────────────────────────────────────
//   :::::: M O D E L O : :  :   :    :     :        :          :
// ──────────────────────────────────────────────────────────────
// Contiene funcionalidad relacionada con la base de datos

class Database{

    // Atributo que representa una conexión entre PHP y una base de datos MySQL.
    private $mysqli; 

    //
    // ─── CONSTRUCTOR ────────────────────────────────────────────────────────────────
    // Inicializa el atributo $mysqli y realiza la conexión a la BD.

    public function __construct(){

        $this->mysqli = new mysqli("mysql", "JuanAntonio", "sibw", "SIBW");
        $this->mysqli->set_charset("utf8");

        if( $this->mysqli->connect_errno ){
            echo ("Fallo al conectar: " . $this->mysqli->connect_error);
        }
    }


    //
    // ──────────────────────────────────────────────────────────────────────────────────────
    //   :::::: G E S T I O N   D E   E V E N T O S : :  :   :    :     :        :          :
    // ──────────────────────────────────────────────────────────────────────────────────────
    //

    //
    // ─── CONSULTA DE EVENTOS ────────────────────────────────────────────────────────
    // Devuelve los atributos de un evento a partir de un identificador.
    // Si el evento indicado no existe devuelve unos valores por defecto

    public function getEvento($idEv){

        // Protección contra inyección SQL y consulta
        $stmt = $this->mysqli->prepare("SELECT * FROM eventos WHERE id=?");
        $stmt-> bind_param("i", $idEv);
        $stmt-> execute();
        $res  = $stmt->get_result();
        
        // Evento por defecto
        $evento = array(
            'id'          => -1,
            'nombre'      => 'No se ha seleccionado ningún evento', 
            'organizador' => 'Esta es la pantalla',
            'fechaInicio' => 'por defecto.',
            'fechaFinal'  => 'Elija un evento',
            'lugar'       => ' ',
            'texto'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam malesuada nunc ut justo aliquet, a hendrerit lacus posuere. Pellentesque faucibus quam a nunc ullamcorper rutrum. Nunc accumsan vulputate libero quis fermentum. Aliquam nec ex sed diam rutrum pretium sed in diam. In interdum ullamcorper orci, cursus lobortis nibh. Praesent tristique lorem in augue pellentesque, sit amet finibus est egestas. Proin aliquam pharetra mauris. Vivamus tincidunt arcu dolor, non mollis odio gravida a. Etiam suscipit, nisl ac dignissim euismod, orci enim posuere nisl, eget hendrerit risus mauris sit amet augue. Aliquam porttitor ex arcu, hendrerit rutrum velit condimentum eu. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque quis turpis eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla venenatis enim vel tortor pellentesque, eu dapibus elit pellentesque. Duis eleifend non nisi sed luctus. Proin rhoncus justo sit amet suscipit convallis.

            Ut porta dignissim bibendum. Sed augue purus, suscipit ac massa at, aliquet sagittis purus. Fusce vulputate viverra accumsan. Aenean consequat est lorem, sed fringilla metus rhoncus vel. Integer tristique justo sit amet quam blandit feugiat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed egestas est urna, semper pretium lectus volutpat eget. Cras dignissim, justo at dictum lacinia, mi dolor mollis diam, sed ullamcorper sem sem ac quam. Suspendisse vel pharetra orci. Maecenas consectetur eleifend tempor. Donec porttitor mattis sem, sit amet bibendum mi fringilla quis.
            
            Duis non diam sed felis imperdiet tristique sit amet eget arcu. Cras quis vehicula turpis. Morbi non sem nisi. Sed vitae velit sed diam tincidunt accumsan. Ut lacinia placerat congue. Phasellus imperdiet magna ut diam consequat pulvinar. Phasellus ultrices mauris eget urna placerat, eget laoreet odio mollis. Sed quis eleifend tellus. Nam eget tortor vel dui gravida congue. Sed ut tortor sed dui cursus fringilla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce varius eros nec nibh tincidunt, sed pulvinar nisl tincidunt.',
            
            'logo'        => '../img/default.jpg',
            'imagen'      => '../img/default-image.png',
            'web'         => ' ',
            'twitter'     => ' ',
            'instagram'   => ' ',
            'facebook'    => ' ',
            'etiquetas'   => ' ',
            'linkEdicion' => ' '
        );

        $date       = date_create($row['fecha_hora']);
        $fecha      = date_format($date, 'd/m/y   H:i:s');
        
        // Pasamos los datos al controlador
        if( $res->num_rows > 0 ){
            $row = $res->fetch_assoc();

            $dateInicio = date_create($row['fechaInicio']);
            $fechaInicio = date_format($dateInicio, 'd/m/y');

            $dateFinal = date_create($row['fechaFinal']);
            $fechaFinal = date_format($dateFinal, 'd/m/y');

            $evento = array(
                'id'          => $idEv,
                'nombre'      => $row['nombre'], 
                'organizador' => $row['organizador'],
                'fechaInicio' => $fechaInicio,
                'fechaFinal'  => $fechaFinal,
                'lugar'       => $row['lugar'],
                'texto'       => $row['texto'],
                'logo'        => $row['logo'],
                'imagen'      => $row['imagenPrincipal'],
                'print'       => "./evento.php?imp=1&ev=".$row['id'],
                'web'         => $row['web'],
                'twitter'     => $row['twitter'],
                'instagram'   => $row['instagram'],
                'facebook'    => $row['facebook'],
                'etiquetas'   => $row['etiquetas'],
            );
        }

        $stmt->close();
        return $evento;

    }


    //
    // ─── CONSULTA DE GALERÍA ────────────────────────────────────────────────────
    // Busca y devuelve los datos de las imágenes de un evento concreto

    public function getGaleria($idEv){

        // Protección contra inyección SQL y consulta    
        $stmt = $this->mysqli->prepare("SELECT * from imagenes where idEvento=?");
        $stmt-> bind_param("i", $idEv);
        $stmt-> execute();
        $res  = $stmt->get_result();

        // Array inicialmente vacío de imágenes
        $imagenes = array();

        // Añadimos cada imagen al array
        while($row = $res->fetch_assoc()){   
            $imagenes[] = $row['ruta'];
        }
        $stmt->close();
        return $imagenes;
    }

    //
    // ─── CONSULTA DE ENLACES DE INTERES ─────────────────────────────────────────────
    // Busca y devuelve los nombres y links a los enlaces de interés de un evento 
    // concreto

    public function getEnlacesDeInteres($idEv){

        // Protección contra inyección SQL y consulta    
        $stmt = $this->mysqli->prepare("select link, nombre from enlaces INNER JOIN eventos_enlaces ON enlaces.id = eventos_enlaces.idEnlace where idEvento=?");
        $stmt-> bind_param("i", $idEv);
        $stmt-> execute();
        $res  = $stmt->get_result();

        // Array inicialmente vacío de enlaces
        $enlaces = array();

        // Añadimos cada enlace al array
        while($row = $res->fetch_assoc()){
            $enlace = array(
                'nombre' => $row['nombre'],
                'link'   => $row['link']
            ) ;
            $enlaces[] = $enlace;
        }

        $stmt->close();
        return $enlaces;
    }


    //
    // ─── CONSULTA DE EVENTOS EN LA PORTADA ──────────────────────────────────────────
    // Obtiene la información básica para representar los eventos en la portada
   
    public function getEventosPortada(){

        // Protección contra inyección SQL y consulta    
        $stmt = $this->mysqli->prepare("SELECT id, nombre, imagenPrincipal from eventos");
        $stmt-> execute();
        $res  = $stmt->get_result();

        // Array inicialmente vacío de eventos
        $eventos = array();

        // Añadimos cada evento al array
        while($row = $res->fetch_assoc()){
            $evento = array(
                'id'     => $row['id'],
                'nombre' => $row['nombre'],
                'imagen' => $row['imagenPrincipal'],
            );

            $eventos[] = $evento;
        }

        $stmt->close();
        return $eventos;
    }


    //
    // ─── TODOS LOS EVENTOS ──────────────────────────────────────────────────────
    // Se obtiene un listado de todos los eventos existentes en la BD

    public function getAllEventos(){
        $consulta = "SELECT id from eventos";
        $stmt = $this->mysqli->prepare($consulta);
        $stmt-> execute();
        $res = $stmt->get_result();

        if( $stmt->affected_rows == -1 ){
            $eventos = -1;
        }
        else{
            $eventos = array();

            while($row = $res->fetch_assoc()){
                $eventos[] = $this->getEvento($row['id']);
            }
        }
        return $eventos;
    }

    
    //
    // ─── BUSCAR EVENTOS ─────────────────────────────────────────────────────────────
    // Busca los eventos que contienen una cierta cadena en su texto

    public function buscaEventos($busqueda){
        $consulta = "SELECT nombre, id FROM eventos WHERE texto LIKE ? ";
        $stmt = $this->mysqli->prepare($consulta);
        $busqueda = "%" . $busqueda . "%";
        $stmt->bind_param('s', $busqueda);
        $stmt->execute();
        $res = $stmt->get_result();
        $eventos = array();
        if( $stmt->affected_rows != -1 ){
            while($row = $res->fetch_assoc()){
                $evento = array(
                    'nombre' => $row['nombre'],
                    'link'   => "./evento.php?ev=" . $row['id'] 
                );
                $eventos[] = $evento;
            }
        }
        else $eventos = -1;

        $stmt->close();
        return $eventos;
    }
    
    
    //
    // ─── AÑADIR EVENTO ──────────────────────────────────────────────────────────────
    // Dados unos datos, se crea un nuevo evento con dichos datos. 
        
    public function addEvento($nombre, $organizador, $fechaInicio, $fechaFinal, $lugar, $texto, $logo, $imagenPrincipal,
                              $web, $twitter, $instagram, $facebook, $etiquetas){
                                
        $regexp = "([^,]*)";
            if(!preg_match($regexp, $etiquetas))
                return FALSE;

        $consulta = "INSERT INTO eventos (nombre, organizador, fechaInicio, fechaFinal, lugar, texto, logo, imagenPrincipal, " . 
        "web, twitter, instagram, facebook, etiquetas) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->mysqli->prepare($consulta);
        $stmt->bind_param("sssssssssssss", $nombre, $organizador, $fechaInicio, 
                          $fechaFinal, $lugar, $texto, $logo, $imagenPrincipal,
                          $web, $twitter, $instagram, $facebook, $etiquetas );
        $stmt->execute();

        if($stmt->affected_rows != -1){
            $res = TRUE;
        }
        else $res = FALSE;

        $stmt->close();
        return $res;
    }
    
    
    //
    // ─── MODIFICAR EVENTO ───────────────────────────────────────────────────────────
    // Modifica el evento de id especificado con los nuevos datos

    public function modificaEvento($idEv, $nombre, $organizador, $fechaInicio, $fechaFinal, $lugar, $texto, $logo, $imagenPrincipal,
    $web, $twitter, $instagram, $facebook, $etiquetas){

        $regexp = "([^,]*)";
            if(!preg_match($regexp, $etiquetas))
                return FALSE;

        $consulta = "UPDATE eventos SET nombre=?, organizador=?, fechaInicio=?, fechaFinal=?, lugar=?, texto=?, logo=?, imagenPrincipal=?, " . 
                    "web=?, twitter=?, instagram=?, facebook=?, etiquetas=? WHERE id=?";
        $stmt = $this->mysqli->prepare($consulta);
        $stmt->bind_param(  "sssssssssssssi", $nombre, $organizador, $fechaInicio, 
                            $fechaFinal, $lugar, $texto, $logo, $imagenPrincipal,
                            $web, $twitter, $instagram, $facebook, $etiquetas, $idEv );
        $stmt->execute();

                
        if($stmt->affected_rows != -1)
            $res = TRUE;
        else
            $res = FALSE;

        $stmt->close();
        return $res;

    }
    
    
    //
    // ─── BORRAR EVENTO ──────────────────────────────────────────────────────────────
    // Elimina un evento y todas las referencias a él.    
    
    public function borraEvento($idEv){

        // Hay que eliminar también las referencias al evento
        $consultaIm = "DELETE FROM imagenes WHERE idEvento=?";
        $consultaCm = "DELETE FROM comentarios WHERE idEvento=?";
        $consultaEE = "DELETE FROM eventos_enlaces WHERE idEvento=?";
        $consultaEv = "DELETE FROM eventos WHERE id=?";

        $stmt = $this->mysqli->prepare($consultaIm);
        $stmt->bind_param("i", $idEv);
        $stmt->execute();
        if($stmt->affected_rows == -1)
            $res = FALSE;
        else{
            $stmt = $this->mysqli->prepare($consultaCm);
            $stmt->bind_param("i", $idEv);
            $stmt->execute();
            if($stmt->affected_rows == -1)
            $res = FALSE;
            else{
                $stmt = $this->mysqli->prepare($consultaEE);
                $stmt->bind_param("i", $idEv);
                $stmt->execute();
                if($stmt->affected_rows == -1)
                    $res = FALSE;
                else{
                    $stmt = $this->mysqli->prepare($consultaEv);
                    $stmt->bind_param("i", $idEv);
                    $stmt->execute();
                    if($stmt->affected_rows == -1)
                        $res = FALSE;
                    else{
                        $res = TRUE; 
                    }
                }
            }
        }
        $stmt->close();
        return $res;
    }

    
    //
    // ─── AÑADIR FOTO ────────────────────────────────────────────────────────────────
    // Añade una foto a la galería de un evento

    public function addPhoto($ruta, $idEv){
        $consulta = "INSERT INTO imagenes (ruta, idEvento) VALUES (?,?)";
        $stmt = $this->mysqli->prepare($consulta);
        $stmt->bind_param("si", $ruta, $idEv);
        $stmt->execute();
        if($stmt->affected_rows != -1)
            $res = TRUE;
        else
            $res = FALSE;

        $stmt->close();
        return $res;
    }


    //
    // ─── ANADIR ETIQUETAS ───────────────────────────────────────────────────────────
    // Añade al evento referenciado por $id nuevas etiquetas

    public function addEtiquetas($id, $etiquetas){
        $regexp = "([^,]+)";
        if(!preg_match($regexp, $etiquetas))
            return FALSE;
        
        $consulta1 = "SELECT etiquetas FROM eventos WHERE id=?";
        $stmt = $this->mysqli->prepare($consulta1);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $res = $stmt->get_result();
        if( $res->num_rows != 1 )
            return FALSE;

        $row = $res->fetch_assoc();

        $stmt->close();

        $etiquetasActuales = $row['etiquetas'];
        $etiquetasNuevas = $etiquetasActuales . "," . $etiquetas;

        $consulta2 = "UPDATE eventos set etiquetas=? where id=?";
        $stmt = $this->mysqli->prepare($consulta2);
        $stmt->bind_param("si",$etiquetasNuevas, $id);
        $stmt->execute();

        if($stmt->affected_rows != -1)
            $res = TRUE;
        else
            $res = FALSE;
        $stmt->close();
        return $res;
    }


    //
    // ──────────────────────────────────────────────────────────────────────────────────────────────
    //   :::::: G E S T I O N   D E   C O M E N T A R I O S : :  :   :    :     :        :          :
    // ──────────────────────────────────────────────────────────────────────────────────────────────
    //
    
    //
    // ─── CONSULTA DE COMENTARIOS ────────────────────────────────────────────────────
    // Busca y devuelve los datos de los comentarios de un evento concreto

    public function getComentarios($idEv){

         // Protección contra inyección SQL y consulta       
        $stmt = $this->mysqli->prepare("SELECT id, autor, fecha_hora, texto, modificado FROM comentarios WHERE idEvento=?");
        $stmt-> bind_param("i", $idEv);
        $stmt-> execute();
        $res  = $stmt->get_result();
        
        // Array inicialmente vacío de comentarios
        $comentarios = array();

        // Añadimos cada comentario al array
        while($row = $res->fetch_assoc()){

            $date        = date_create($row['fecha_hora']);
            $fecha       = date_format($date, 'd/m/y   H:i:s');
            $comentario = array(
                'id'          => $row['id'],
                'autor'       => $row['autor'],
                'fecha_hora'  => $fecha,
                'texto'       => $row['texto'],
                'linkEdicion' => $linkEdicion,
                'linkBorrado' => $linkBorrado,
                'modificado'  => $row['modificado']
            );

            $comentarios[] = $comentario;
        }

        $stmt->close();
        return $comentarios;
    }

    //
    // ─── TODOS LOS COMENTARIOS ──────────────────────────────────────────────────────
    // Se obtiene un listado de todos los comentarios existentes en la BD

    public function getAllComments(){

        $stmt = $this->mysqli->prepare("SELECT comentarios.id, autor, email_autor, fecha_hora, comentarios.texto, modificado, nombre " . 
        " FROM comentarios INNER JOIN eventos where comentarios.idEvento = eventos.id");
        $stmt-> execute();
        $res  = $stmt->get_result();

        if($stmt->affected_rows == -1){
            $comentarios = -1;
        }
        else{
            // Array inicialmente vacío de comentarios
            $comentarios = array();

            // Añadimos cada comentario al array
            while($row = $res->fetch_assoc()){

                $date        = date_create($row['fecha_hora']);
                $fecha       = date_format($date, 'd/m/y   H:i:s');
                $comentario = array(
                    'id'          => $row['id'],
                    'autor'       => $row['autor'],
                    'email_autor' => $row['email_autor'],
                    'fecha_hora'  => $fecha,
                    'texto'       => $row['texto'],
                    'evento'      => $row['nombre'],
                    'modificado'  => $row['modificado']
                );

                $comentarios[] = $comentario;
            }
        }

        $stmt->close();
        return $comentarios;
    }

    
    //
    // ─── CONSULTA DE COMENTARIOS ────────────────────────────────────────────────────
    // Busca y devuelve un comentario a partir de su id

    public function getComentario($id){

        $consulta = "SELECT id, autor, texto, idEvento FROM comentarios WHERE id=?";
        $stmt = $this->mysqli->prepare($consulta);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();

        $comentario = -1;
        
        if( $res->num_rows === 1 )
            $comentario = $res->fetch_assoc();

        $stmt->close();
        return $comentario;
    }

    
    //
    // ─── AÑADIR COMENTARIO ──────────────────────────────────────────────────────────
    // Añade un nuevo comentario a la base de datos

    public function addComentario($autor, $email_autor, $texto, $idEv){

        $consulta = "INSERT INTO comentarios (autor, email_autor, fecha_hora, texto, idEvento, modificado) VALUES " . 
                    "(?, ?, now(), ?, ?, false)";

        $stmt = $this->mysqli->prepare($consulta);
        $stmt ->bind_param("sssi", $autor, $email_autor, $texto, $idEv);
        $stmt->execute();
        
        if($stmt->affected_rows != -1){
            $res = TRUE;
        }
        else $res = FALSE;

        $stmt->close();
        return $res;

    }


    //
    // ─── MODIFICAR COMENTARIO ───────────────────────────────────────────────────────
    // Modifica el texto de un comentario y el atributo 'modificado
        
    public function modificaComentario($id, $texto){
        $consulta = "UPDATE comentarios SET texto=?, modificado=true WHERE id=?";
        $stmt = $this->mysqli->prepare($consulta);
        $stmt->bind_param("si", $texto, $id);
        $stmt->execute();

        if($stmt->affected_rows != -1)
            $res = TRUE;
        else
            $res = FALSE;

        $stmt->close();
        return $res;
    }

  
    //
    // ─── ELIMINAR COMENTARIO ────────────────────────────────────────────────────────
    // Elimina un comentario referenciado por su id

    public function borraComentario($id){
        $consulta = "DELETE FROM comentarios WHERE id=?";
        $stmt = $this->mysqli->prepare($consulta);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        if($stmt->affected_rows != -1)
            $res = TRUE;
        else
            $res = FALSE;

        $stmt->close();
        return $res;
    }


    //
    // ─── BUSCAR COMENTARIOS ─────────────────────────────────────────────────────────
    // Busca los comentarios que contienen una cierta cadena en su texto

    public function buscaComentarios($busqueda){
        $consulta = "SELECT autor, fecha_hora, comentarios.texto, nombre FROM eventos INNER JOIN comentarios WHERE comentarios.texto LIKE ? AND eventos.id=comentarios.idEvento";
        $stmt = $this->mysqli->prepare($consulta);
        $busqueda = "%" . $busqueda . "%";
        $stmt->bind_param('s', $busqueda);
        $stmt->execute();
        $res = $stmt->get_result();
        $comentarios = array();
        if( $stmt->affected_rows != -1 ){
            while($row = $res->fetch_assoc()){
                $date        = date_create($row['fecha_hora']);
                $fecha       = date_format($date, 'd/m/y   H:i:s');
                $comentario = array(
                    'autor'      => $row['autor'],
                    'fecha_hora' => $fecha,
                    'texto'      => $row['texto'],
                    'evento'     => $row['nombre'] 
                );
                $comentarios[] = $comentario;
            }
        }
        else $comentarios = -1;

        $stmt->close();
        return $comentarios;  
    }

    //
    // ─── OBTENCION DE PALABRAS PROHIBIDAS ───────────────────────────────────────────
    // Consulta de las palabras prohibidas
        
    public function getPalabrasProhibidas(){

        // Protección contra inyección SQL y consulta    
        $stmt = $this->mysqli->prepare("SELECT * from palabras_prohibidas");
        $stmt-> execute();
        $res  = $stmt->get_result();

        // Array inicialmente vacío de palabras
        $palabras = array();

        // Añadimos cada imagen al array
        while($row = $res->fetch_assoc()){   
            $palabras[] = $row['palabra'];
        }

        $stmt->close();
        return $palabras;

    }


    //
    // ────────────────────────────────────────────────────────────────────────────────────────
    //   :::::: G E S T I O N   D E   U S U A R I O S : :  :   :    :     :        :          :
    // ────────────────────────────────────────────────────────────────────────────────────────
    //

    //
    // ─── INSERTAR USUARIO ───────────────────────────────────────────────────────────
    // Crea un nuevo usuario en la BD con los datos especificados
        
    public function insertarUsuario($nickname, $nombre, $email, $clave, $tipo){

        $consulta = "INSERT INTO usuario VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->mysqli->prepare($consulta);
        $stmt->bind_param("sssss",$nickname, $nombre, $email, password_hash($clave, PASSWORD_DEFAULT), $tipo);
        $stmt->execute();
        
        if( $stmt->affected_rows != -1 )
            $res = TRUE;
        else
            $res = FALSE;

        $stmt->close();
        return $res;

    }


    //
    // ─── CONSULTA DE USUARIO ────────────────────────────────────────────────────────
    // Busca y devuelve los datos de un usuario a partir de su nickname
    
    public function getUsuario($nickname){
        $consulta = "SELECT * FROM usuario WHERE nickname=?";
        $stmt = $this->mysqli->prepare($consulta);
        $stmt->bind_param("s",$nickname);
        $stmt->execute();
        $res = $stmt->get_result();

        $user = -1;

        if( $res->num_rows === 1 ){
            $row = $res->fetch_assoc();
            $user = [
                'nickname' => $row['nickname'],
                'nombre'   => $row['nombre'],
                'email'    => $row['email'],
                'clave'    => $row['clave'],
                'tipo'     => $row['tipo']
            ];
        }
        $stmt->close();
        return $user;
        
    }

    
    //
    // ─── CHECK LOGIN ────────────────────────────────────────────────────────────────
    // Dado un nickname y una contraseña, comprueba que coincide el usuario con su
    // contraseña

    public function checkLogin($nickname, $clave){
        $found = false;
        $user = $this->getUsuario($nickname);
        if($user!=-1){
            if(password_verify($clave, $user['clave'])){
                $found = TRUE;
            }
        }

        return $found;
    }
    
    
    //
    // ─── ACTUALIZAR INFORMACION DE USUARIO ──────────────────────────────────────────
    // Actualiza los datos del usuario referenciado por su nickname

    public function actualizaInformacion($nickname, $nombre, $email, $clave){

        $consulta = "UPDATE usuario SET nombre=?, email=?, clave=? WHERE nickname=?";
        $stmt = $this->mysqli->prepare($consulta);
        $stmt->bind_param("ssss", $nombre, $email, password_hash($clave, PASSWORD_DEFAULT), $nickname);
        $stmt->execute();
        
        if($stmt->affected_rows != -1)
            $res = TRUE;
        else
            $res = FALSE;

        $stmt->close();

        return $res;
    }
    
    
    //
    // ─── HAY VARIOS SUPER ───────────────────────────────────────────────────────────
    // Comprueba si hay o no más de un usuario de tipo super

    public function hayVariosSuper(){
        $consulta = "SELECT * FROM usuario WHERE tipo='super'";
        $stmt = $this->mysqli->prepare($consulta);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();

        if( $res->num_rows == 1 )
            return FALSE;
        else
            return TRUE;
    }

    //
    // ─── MODIFICAR TIPO USUARIO ─────────────────────────────────────────────────────
    // Función que ejecuta el super para cambiar permisos de usuarios

    public function modificaTipoUsuario($nickname, $nuevoTipo){

        $consulta = "SELECT tipo FROM usuario WHERE nickname=?";
        $stmt = $this->mysqli->prepare($consulta);
        $stmt->bind_param("s", $nickname);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows == 1){
            $row = $res->fetch_assoc();
            $tipoActual = $row['tipo'];
            if($tipoActual == 'super' and !$this->hayVariosSuper() )
                return FALSE;
        }
        else return FALSE;
        

        $consulta = "UPDATE usuario SET tipo=? WHERE nickname=?";
        $stmt = $this->mysqli->prepare($consulta);
        $stmt->bind_param("ss", $nuevoTipo, $nickname);
        $stmt->execute();

        if($stmt->affected_rows != -1)
            $res = TRUE;
        else
            $res = FALSE;

        $stmt->close();

        return $res;
    }

    //
    // ──────────────────────────────────────────────────────────────────────────────
    //

}

?>