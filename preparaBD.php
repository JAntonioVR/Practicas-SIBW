<?php
include("modelo.php");
$database = new Database();

if($database->insertarUsuario("Registrado", "Registrado", "elregistrado@ugr.es", "sibw", "registrado")){
    echo("Se ha creado un usuario registrado, su nickname es 'Registrado' y su clave es 'sibw' \n");
}
else{
    echo("Error al crear el usuario registrado\n");
}
if($database->insertarUsuario("Moderador", "Moderador", "elmoderador@ugr.es", "sibw", "moderador")){
    echo("Se ha creado un usuario moderador, su nickname es 'Moderador' y su clave es 'sibw' \n");
}
else{
    echo("Error al crear el usuario moderador\n");
}
if($database->insertarUsuario("Gestor", "Gestor", "elgestor@ugr.es", "sibw", "gestor")){
    echo("Se ha creado un usuario gestor, su nickname es 'Gestor' y su clave es 'sibw' \n");
}
else{
    echo("Error al crear el usuario gestor\n");
}
if($database->insertarUsuario("Super", "Super", "elsuper@ugr.es", "sibw", "super")){
    echo("Se ha creado un usuario super, su nickname es 'Super' y su clave es 'sibw' \n");
}
else{
    echo("Error al crear el usuario super\n");
}

?>