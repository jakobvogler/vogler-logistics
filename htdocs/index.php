<html>
    <head>
        <title>Vogler Logistics</title>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css2?family=Slabo+27px&display=swap" rel="stylesheet">
    </head>
    <body>

        <div class="container">
    
            <a href="index.php"><img src="src/logo.png" alt="Vogler Logistics Logo"></a>

            <br><h2>Package Tracking</h2><br>

            <form method="get">
                <input type="text" id="tracking" name="tracking" placeholder="Tracking Number"><br>
                <input type="text" id="zip" name="zip" placeholder="Recipient Zipcode"><br><br>
                <button type="submit" id="go">Go</button>
            </form>

        </div>

        <?php
            function script() {
                if (!isset($_GET['tracking']) || !isset($_GET['zip'])) {
                    return;
                }
                
                $tracking = trim($_GET['tracking']);
                $zip = trim($_GET['zip']);
                
                if ($tracking == '' && $zip == '') {
                    return;
                }
                if ($tracking == '' || $zip == '') {
                    echo '<div class="container"><h2>Shipment Details</h2><br><p>To perform a query, all fields must be filled in</p></div>';
                    return;
                }
                
                require 'inc/db.php';

                $db = connect($_ENV["CUSTOMER_USERNAME"], $_ENV["CUSTOMER_PASSWORD"])
                
                $tracking = $db->real_escape_string($tracking);
                $zip = $db->real_escape_string($zip);
                
                $query = 'SELECT * FROM shipment INNER JOIN address ON shipment.recipient = address.id WHERE shipment.id = "' . $tracking . '" AND address.zip="' . $zip . '";';
                
                $res = $db->query($query);
                
                $number = $res->num_rows;
                $res = $res->fetch_ASSOC();
                
                if ($number) {
                    echo '<div class="container"><h2>Shipment Details</h2><br><p>Status: ' . $res['status'] . '<br>Category: ' . $res['category'] . '<br><br><br>Recipient<br><br>' . $res['first_name'] . ' ' . $res['last_name'] . '<br>' . $res['street'] . ' ' . $res['house_number'] . '<br>' . $res['apartment'] . '<br>' . $res['zip'] . ' ' . $res['city'] . '<br>' . $res['country'] . '</p></div>';
                } else {
                    echo '<div class="container"><h2>Shipment Details</h2><br><p>No entry could be found under the specified details</p></div>';
                }
            }

            script();
        ?>

        

        <div class="container">

            <p><a href="contact.php" style="color: #aaa; text-decoration: none;">contact</a>
            <span style="color: #ffffff;">....................................</span>
            <a href="location.php" style="color: #aaa; text-decoration: none;">location</a>
            <span style="color: #ffffff;">....................................</span>
            <a href="admin.php" style="color: #aaa; text-decoration: none;">admin</a></p>

        </div>

    </body>
</html>