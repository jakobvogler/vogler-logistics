<html>
    <head>
        <title>Vogler Logistics - Hash</title>
    </head>
    <body>
        <?php
            $input = $_GET['input'];
            echo hash('sha256', $input);
        ?>
    </body>
</html>