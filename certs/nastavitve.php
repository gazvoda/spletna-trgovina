<?php
session_start();
// var_dump($_SESSION);
require_once '../database_spletna.php';

$isPost = filter_input(INPUT_SERVER, 'REQUEST_METHOD') == 'POST';
if ($isPost) {
    $rules = array(
        'first_name' => FILTER_SANITIZE_STRING,
        'last_name' => FILTER_SANITIZE_STRING,
        'email' => FILTER_SANITIZE_STRING,
        'password' => FILTER_SANITIZE_STRING
    );

    $sent = filter_input_array(INPUT_POST, $rules);

    if ($sent["first_name"] != NULL) {
        DBSpletna::updateFirstName($_SESSION['user_id'], $sent["first_name"]);
    }
    else if ($sent["last_name"] != NULL) {
        DBSpletna::updateLastName($_SESSION['user_id'], $sent["last_name"]);
    }
    else if ($sent["email"] != NULL) {
        DBSpletna::updateEmail($_SESSION['user_id'], $sent["email"]);
        // update session email just in case
        $_SESSION['user_email'] = $sent["email"];
    }
    else if ($sent["password"] != NULL) {
        DBSpletna::updatePassword($_SESSION['user_id'], password_hash($sent["password"], PASSWORD_DEFAULT));
    }
}
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
        <?php 
            if ($isPost) {
                var_dump($_SESSION);
            }
        ?>
        <form action="<?= basename(__FILE__) ?>" method="post">
            Ime <input type="text" name="first_name" />
            <input type="submit" value="Spremeni">
        </form>
        <form action="<?= basename(__FILE__) ?>" method="post">
            <br>
            Priimek <input type="text" name="last_name" />
            <input type="submit" value="Spremeni">
        </form>
        <form action="<?= basename(__FILE__) ?>" method="post">
            <br>
            E-mail <input type="text" name="email" />
            <input type="submit" value="Spremeni">
        </form>
        <form action="<?= basename(__FILE__) ?>" method="post">
            <br>
            Geslo <input type="password" name="password" />
            <input type="submit" value="Spremeni">
        </form>
        <button onclick="history.go(-1);">Nazaj</button>
        <form action="../odjava.php" method="get">
            <input type="submit" value="Odjava">
        </form>
    </body>
</html>