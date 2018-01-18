<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//$uporabnisko_ime = $_POST["uporabnisko_ime"];
//$geslo = $_POST["geslo"];
session_start();
echo "Prijava uspesna za admina";
var_dump($_SESSION);

?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Domaca stran - administrator</title>
    </head>
    <body>
        
        <a href="odjava.php">Odjava</a>
    </body>
</html>


