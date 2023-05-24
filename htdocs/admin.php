<html>
    <head>
        <title>Vogler Logistics - Admin</title>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css2?family=Slabo+27px&display=swap" rel="stylesheet">
    </head>
    <body>

        <div class="container">
    
            <a href="index.php"><img src="src/logo.png" alt="Vogler Logistics Logo"></a>

            <br><h2>Admin Interface</h2><br>

            <form method="post">
                <input type="text" id="username" name="username" placeholder="Username"><br>
                <input type="password" id="password" name="password" placeholder="Password"><br><br>
                <input type="text" id="query" name="query" placeholder="SQL-Query"><br><br>
                <button type="submit" id="go" name="go">Go</button>
            </form>

        </div>

        <?php
            function script() {
                if (!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['query'])) {
                    return;
                }
                
                $username = $_POST['username'];
                $password = $_POST['password'];
                $query = $_POST['query'];
                
                if ($username == '' && $password == '' && $query == '') {
                    return;
                }
                if ($username == '' || $password == '' || $query == '') {
                    echo '<div class="container"><h2>Output</h2><br><p>Some inputs are missing</p></div>';
                    return;
                }
                
                require 'inc/db.php';

                $db = connect($_ENV["ADMIN_USERNAME"], $_ENV["ADMIN_PASSWORD"])

                $username = $db->real_escape_string($username);
                $password = $db->real_escape_string($password);
                
                $sha = hash('sha256', $password);
                
                $authquery = 'SELECT * FROM admin WHERE username = "' . $username . '" AND password = "' . $sha . '";';
                $auth = $db->query($authquery);
                $db->close();
                
                if ($auth->num_rows) {
                    require 'inc/db.php';
                    
                    $res = $db->query($query);
                    
                    echo '<div class=container><h2>Output</h2><br><p>' . $query . '<br><br>';
                    
                    if ($error = $db->errno) {
                        echo $error . ': ' . $db->error;
                    } else if ($res->num_rows > 0) {
                        echo '<pre style="text-align: left;">';
                        
                        while ($set = $res->fetch_ASSOC()) {
                            print_r($set);
                        }
                        
                        echo '</pre>';
                    } else {
                        echo 'command executed';
                    }
                    
                    echo '</p></div>';
                    
                } else {
                    echo '<div class="container"><h2>Output</h2><br><p>No admin account exists under the given username and password</p></div>';
                }
                
                $db->close();
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