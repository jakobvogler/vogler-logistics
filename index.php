<html>
    <head>
        <title>Vogler Logistics</title>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css2?family=Slabo+27px&display=swap" rel="stylesheet">
    </head>
    <body>

        <div class="kasten">
    
            <a href="index.php"><img src="src/logo.png" alt="Vogler Logistics Logo"></a>

            <br><h2>Package Tracking</h2><br>

            <form method="get">
                <input type="text" id="tracking" name="tracking" placeholder="tracking number"><br>
                <input type="text" id="zip" name="zip" placeholder="recipient zipcode"><br><br>
                <button type="submit" id="go">Go</button>
            </form>

        </div>

        <?php
            require 'inc/db.php';


            $tracking = $db->real_escape_string(trim($_GET['tracking']));
            $plz = $db->real_escape_string(trim($_GET['zip']));

            $query = 'SELECT * FROM sendung INNER JOIN adresse ON sendung.empfaenger = adresse.id WHERE sendung.id = "' . $tracking . '" AND adresse.plz="' . $plz . '";';

            $erg = $db->query($query);

            $number = $erg->num_rows;
            $erg = $erg->fetch_ASSOC();

            if ($number) {
                echo '<div class="kasten"><h2>Sendungsdetails</h2><br><p>Status: ' . $erg['status'] . '<br>Kategorie: ' . $erg['kategorie'] . '<br><br><br>Empfänger<br><br>' . $erg['vorname'] . ' ' . $erg['nachname'] . '<br>' . $erg['strasse'] . ' ' . $erg['hausnummer'] . '<br>' . $erg['apartment'] . '<br>' . $erg['plz'] . ' ' . $erg['ort'] . '<br>' . $erg['land'] . '</p></div>';
            } else if ($tracking == '' && $plz == '') {

            } else if ($tracking == '' || $plz == '') {
                echo '<div class="kasten"><h2>Sendungsdetails</h2><br><p>Um eine Abfrage durchzuführen, müssen alle Felder ausgefüllt sein.</p></div>';
            } else {
                echo '<div class="kasten"><h2>Sendungsdetails</h2><br><p>Es konnte keinen Eintrag unter den angegebenen Daten gefunden werden. Wenn dies ein Fehler ist, rufen Sie uns bitte an.</p></div>';
            }
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