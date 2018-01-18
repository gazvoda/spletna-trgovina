<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Avtorizacija na podlagi polj certifikata X.509</title>
    </head>
    <body>
        <?php
        session_start();
        $authorized_users = ["Ana"];

        $client_cert = filter_input(INPUT_SERVER, "SSL_CLIENT_CERT");

        if ($client_cert == null) {
            die('err: Spremenljivka SSL_CLIENT_CERT ni nastavljena.');
        }


        $cert_data = openssl_x509_parse($client_cert);
        $commonname = (is_array($cert_data['subject']['CN']) ?
                        $cert_data['subject']['CN'][0] : $cert_data['subject']['CN']);
        if (in_array($commonname, $authorized_users)) {
//            echo "$commonname je avtoriziran uporabnik, zato vidi trenutni čas: " . date("H:i");
            
                //var_dump($_SESSION);
                switch ($_SESSION['user_role']) {
                    case "administrator":
                        header("Location: doma.php");
                        exit();
                        break;
                    case "prodajalec":
                        header("Location: doma.php");
                        exit();
                        break;
                    default:
                        break;
                }
        } else {
            echo "$commonname ni avtoriziran uporabnik in nima dostopa do ure";
        }

        echo "<p>Vsebina certifikata: ";
        var_dump($cert_data);
        ?>
    </body>
</html>
