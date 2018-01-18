<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
require_once 'database_spletna.php';
?>

<?php
// Primer varenega shranjevanja gesel s funkcijo password_hash()
// http://php.net/manual/en/function.password-hash.php
// Spodaj je podan primer, kako geslo preverimo.

$allowAccess = FALSE;
$isPost = filter_input(INPUT_SERVER, 'REQUEST_METHOD') == 'POST';

if ($isPost) {
    $rules = array(
        'uname' => FILTER_SANITIZE_STRING,
        'password' => FILTER_SANITIZE_STRING
    );

    $sent = filter_input_array(INPUT_POST, $rules);

    if ($sent["uname"] != NULL && $sent["password"] != NULL) {
        try {
            $dbh = new PDO("mysql:host=localhost;dbname=spletna_trgovina", "root", "ep");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
            $stmt = $dbh->prepare("SELECT * FROM user WHERE email = ?");
            $stmt->bindValue(1, $sent["uname"]);
            $stmt->execute();

            // zapis iz baze
            $user = $stmt->fetch();

            // pravilnost gesla preverimo s klicem funkcije 
            // password_verify(geslo, geslo_v_bazi)
            if (password_verify($sent["password"], $user["password"])) {
                $allowAccess = TRUE;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
?><html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Primer strani za prijavo</title>
    </head>
    <body>
        <?php
        if ($isPost) {
            if ($allowAccess) {
                //echo "Dobrodošli na skrivni strani!";
                //var_dump($user);
                session_start();
                // Store Session Data
                //echo "$user[role]";
                $_SESSION['user_role']= $user['role'];  // Initializing Session with value of PHP Variable
                //var_dump($_SESSION);
                switch ($_SESSION['user_role']) {
                    case "administrator":
                        header("Location: prijava-admin.php");
                        exit();
                        break;
                    case "prodajalec":
                        header("Location: prijava-prodajalec.php");
                        exit();
                        break;
                    case "stranka":
                        header("Location: prijava-stranka.php");
                        exit();
                        break;
                    default:
                        break;
                }
            } else {
                echo "Prijava neuspešna.";
            }
        } else {
            ?><form action="<?= basename(__FILE__) ?>" method="post">
                Username <input type="text" name="uname" />
                Password <input type="password" name="password" />
                <input type="submit" value="Pošlji podatke">
            </form>
            <?php
        }
        ?>
    </body>
</html>