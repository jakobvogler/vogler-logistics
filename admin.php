<html>
    <head>
        <title>Vogler Logistics - Admin</title>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css2?family=Slabo+27px&display=swap" rel="stylesheet">
    </head>
    <body>

        <div class="kasten">
    
            <a href="index.php"><img src="src/logo.png" alt="Vogler Logistics Logo"></a>

            <br><h2>Admin Interface</h2><br>

            <form method="post">
                <input type="text" id="username" name="username" placeholder="Benutzername"><br>
                <input type="password" id="password" name="password" placeholder="Passwort"><br><br>
                <input type="text" id="query" name="query" placeholder="SQL-Abfrage"><br><br>
                <button type="submit" id="go" name="go">Los</button>
            </form>

        </div>

        <?php
            require 'inc/db.php';


            $username = $_POST['username'];
            $password = $_POST['password'];
            $query = $_POST['query'];

            $sha = hash('sha256', $password);

            $authquery = 'SELECT * FROM admin WHERE benutzername = "' . $username . '" AND passwort = "' . $sha . '";';
            $auth = $db->query($authquery);
            $db->close();

            if ($auth->num_rows) {
                require 'inc/db.php';

                $erg = $db->query($query);
                               
                echo '<div class=kasten><h2>Output</h2><br><p>' . $query . '<br><br>';

                if ($error = $db->errno) {
                    echo $error . ': ' . $db->error;
                } else if ($erg->num_rows > 0) {
                    echo '<pre style="text-align: left;">';

                    while ($set = $erg->fetch_ASSOC()) {
                        print_r($set);
                    }

                    echo '</pre>';
                } else {
                    echo 'command executed';
                }

                echo '</p></div>';
                
            } else if ($username == '' && $password == '' && $query == '') {
                //nichts passiert
            } else if ($username == '' || $password == '' || $query == '') {
                echo '<div class="kasten"><h2>Output</h2><br><p>Um die Rechte für eine Abfrage zu bestätigen, müssen alle Felder ausgefüllt sein.</p></div>';
            } else {
                echo '<div class="kasten"><h2>Output</h2><br><p>Die angegebenen Nutzerdaten stimmen mit keinem im System geführten Admin-Konto überein.</p></div>';
            }

            $db->close();
        ?>

        <div class="kasten">

            <p><a href="kontakt.php" style="color: #aaa; text-decoration: none;">kontakt</a>
            <span style="color: #ffffff;">....................................</span>
            <a href="location.php" style="color: #aaa; text-decoration: none;">loaction</a>
            <span style="color: #ffffff;">....................................</span>
            <a href="admin.php" style="color: #aaa; text-decoration: none;">admin</a></p>

        </div>

    </body>
</html>