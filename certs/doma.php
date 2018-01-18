<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//$uporabnisko_ime = $_POST["uporabnisko_ime"];
//$geslo = $_POST["geslo"];
session_start();
//echo "Prijava uspesna za admina";
//var_dump($_SESSION);

?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Domaca stran</title>
    </head>
    <body>
        <form action="nastavitve.php" method="get">
            <input type="submit" value="Nastavitve">
        </form>
        <?php
        //var_dump($_SESSION);
            if ($_SESSION['user_role'] == "administrator") :
                ?><form action="dodaj-prodajalca.php" method="get">
                    <input type="submit" value="Dodaj prodajalca">
                </form>
            <?php elseif ($_SESSION['user_role'] == "prodajalec") :
                ?><form action="dodaj-stranko.php" method="get">
                    <input type="submit" value="Dodaj stranko">
                </form>
            <?php            endif;
                ?>
        <form action="../odjava.php" method="get">
            <input type="submit" value="Odjava">
        </form>
    </body>
</html>


