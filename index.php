<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
require_once 'database_spletna.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="prijava.php" method="post">
		Uporabnisko ime <input type="text" name="uporabnisko_ime"> 
		Geslo <input type="password" name="geslo" />
		<input type="submit" value="Prijava">
	</form>
        <?php
        // put your code here
        ?>
    </body>
</html>
