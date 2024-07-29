<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="includes/forms.css">
</head>
<body>
    <a href="index.php">Home</a>
    <br></br>
    <form action="addAirline.php" method="POST">
    
    Airline Name: <input type="text" name="airline_name"><br><br>
    <input type="submit">
    </form>
    <?php
    require('includes/dbh.inc.php');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
        $ins_result = pg_insert($db_conn, 'airlines', $_POST);
        if(!$ins_result) {
                echo pg_last_error($db_conn);
                exit;
            }
        else {
            echo "<div style='text-align: center;'>New Airline Added !</div>";
        }
    }
    ?>
</body>
</html>