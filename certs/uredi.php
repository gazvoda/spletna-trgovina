<?php

session_start();
//var_dump($_SESSION);
require_once '../database_spletna.php';

?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <?php if ($_SESSION['user_role'] == "administrator") : ?>
            <title>Prodajalci</title>
        <?php elseif ($_SESSION['user_role'] == "prodajalec") : ?>
            <title>Stranke</title>
        <?php endif; ?>
    </head>
    <body>
        <?php
        // VNOS -- ZASLONSKA MASKA
        if (isset($_GET["do"]) && $_GET["do"] == "add"):
            ?>
            <h1>Dodajanje</h1>
            <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
                <input type="hidden" name="do" value="add" />
                Vloga: <input type="text" name="role" />
                <br>
                Ime: <input type="text" name="first_name" />
                <br>
                Priimek: <input type="text" name="last_name" />
                <br>
                E-mail: <input type="text" name="email" />
                <br>
                Geslo: <input type="password" name="password" />
                <br>
                Telefon: <input type="text" name="phone" />
                <br>
                Naslov: <input type="text" name="address" />
                <br>
                <input type="submit" value="Shrani" />
            </form>
            <?php
        // UREJANJE -- ZASLONSKA MASKA
        elseif (isset($_GET["do"]) && $_GET["do"] == "edit"):
            ?>
            <h1>Urejanje</h1>
            <?php
            try {
                $user = DBSpletna::get($_GET["id"]); // POIZVEDBA V PB
            } catch (Exception $e) {
                echo "Napaka pri poizvedbi: " . $e->getMessage();
            }

            $user_id = $user["user_id"];
            $first_name = $user["first_name"];
            $last_name = $user["last_name"];
            $email = $user["email"];
            $status = $user["status"];
            
            ?>
            <h2>Urejanje zapisa id = <?= $user_id ?></h2>
            <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
                <input type="hidden" name="id" value="<?= $user_id ?>" />
                <input type="hidden" name="do" value="edit" />
                Ime: <input type="text" name="first_name" value="<?= $first_name ?>" /><br />
                Priimek: <input type="text" name="last_name" value="<?= $last_name ?>" /><br />
                E-mail: <input type="text" name="email" value="<?= $email ?>" /><br />
                Geslo: <input type="password" name="password" value="" /><br />
                Status: <input type="text" name="status" value="<?= $status ?>" /><br />
                
                <input type="submit" value="Shrani" />
            </form>

            <h2>Izbris zapisa</h2>
            <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
                <input type="hidden" name="user_id" value="<?= $user_id ?>" />
                <input type="hidden" name="do" value="delete" />
                <input type="submit" value="Briši" />
            </form>		
            <?php
        // POSODABLJANJE ZAPISA V PB
        elseif (isset($_POST["do"]) && $_POST["do"] == "edit"):
            ?>
            <h1>Posodobitev zapisa</h1>
            <?php
            try {
                DBSpletna::update($_POST["user_id"], $_POST["joke_date"], $_POST["joke_text"]);
                echo "Šala uspešno posodobljena. <a href='$_SERVER[PHP_SELF]'>Na prvo stran.</a></p>";
            } catch (Exception $e) {
                echo "<p>Napaka pri zapisu: {$e->getMessage()}.</p>";
            }

        // VNOS ZAPISA V PB
        elseif (isset($_POST["do"]) && $_POST["do"] == "add"):
            ?>
            <h1>Vnašanje zapisa</h1>
            <?php
            try {
                $status = "";
                if ($_POST["role"] == "prodajalec") {
                    $_POST["phone"] = NULL;
                    $_POST["address"] = NULL;
                    $status = "active";
                }
                DBSpletna::insert($_POST["role"], $_POST["first_name"], $_POST["last_name"], $_POST["email"], password_hash($_POST["password"], PASSWORD_DEFAULT), $_POST["phone"], $_POST["address"], $status);
                echo "Uporabnik uspešno dodan. <a href='$_SERVER[PHP_SELF]'>Na prvo stran.</a></p>";
            } catch (Exception $e) {
                echo "<p>Napaka pri zapisu: {$e->getMessage()}.</p>";
            }

        // BRISANJE ZAPISA IZ PB
        elseif (isset($_POST["do"]) && $_POST["do"] == "delete"):
            ?>
            <h1>Brisanje zapisa</h1>
            <?php
            try {
                DBSpletna::delete($_POST["user_id"]);
                echo "Uporabnik uspešno odstranjen. <a href='$_SERVER[PHP_SELF]'>Na prvo stran.</a></p>";
            } catch (Exception $e) {
                echo "<p>Napaka pri brisanju: {$e->getMessage()}.</p>";
            }
        

        // PRIKAZ VSEH ZAPISOV
        else: ?>
            
        <h1>Vsi prodajalci</h1>
            <h2><a href="<?= htmlspecialchars($_SERVER["PHP_SELF"]) . "?do=add" ?>">Dodajanje</a></h2>
            <?php
            try {
                $all_users = DBSpletna::getAll();
            } catch (Exception $e) {
                echo "Prišlo je do napake: {$e->getMessage()}";
            }

            foreach ($all_users as $num => $row) {
                $url = htmlspecialchars($_SERVER["PHP_SELF"]) . "?do=edit&id=" . $row["user_id"];
                $user_id = $row["user_id"];
                $first_name = $row["first_name"];
                $last_name = $row["last_name"];
                $email = $row["email"];

                echo "<p><b>$user_id; Ime: $first_name</b><br>Priimek: $last_name<br>email: $email<br>[<a href='$url'>Uredi</a>]</p>\n";
            }
        endif;
        ?>
        <button onclick="history.go(-1);">Nazaj</button>
        <form action="../odjava.php" method="get">
            <input type="submit" value="Odjava">
        </form>
    </body>
</html>