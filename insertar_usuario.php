<?php

//
// ──────────────────────────────────────────────────────────────────────────────────────────────
//   :::::: I N S E R T A R   N U E V O   U S U A R I O : :  :   :    :     :        :          :
// ──────────────────────────────────────────────────────────────────────────────────────────────
//



include("modelo.php");

$database = new Database();

$database->insertarUsuario("Gestor", "JAGestor", "juan@gmail.com", "sibw", "gestor");


?>