<?php
session_start();
var_dump($_SESSION);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Nastavitve</title>
    </head>
    <body>
        <form action="spremeni-ime.php" method="post">
            Ime <input type="text" name="ime" />
            <input type="submit" value="Spremeni">
        </form>
        <form action="spremeni-priimek.php" method="post">
            <br>
            Priimek <input type="text" name="priimek" />
            <input type="submit" value="Spremeni">
        </form>
        <form action="spremeni-email.php" method="post">
            <br>
            e-mail <input type="text" name="email" />
            <input type="submit" value="Spremeni">
        </form>
        <form action="spremeni-geslo.php" method="post">
            <br>
            Geslo <input type="password" name="geslo" />
            <input type="submit" value="Spremeni">
        </form>
        <form action="../odjava.php" method="get">
            <input type="submit" value="Odjava">
        </form>
    </body>
</html>