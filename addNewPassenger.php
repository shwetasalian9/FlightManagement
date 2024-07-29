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
    <form action="addNewPassenger.php" method="POST">
    
    First Name: <input type="text" name="first_name"><br><br>
    Last Name: <input type="text" name="last_name"><br><br>
    Email: <input type="text" name="email"><br><br>
    <input type="submit">
    </form>
    <?php
    require('includes/dbh.inc.php');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
        $ins_result = pg_insert($db_conn, 'passengers', $_POST);
        if(!$ins_result) {
                echo pg_last_error($db_conn);
                exit;
            }
        else {
            echo "<div style='text-align: center;'>New Passenger Added !</div>";
        }
    }
    ?>
</body>
</html>