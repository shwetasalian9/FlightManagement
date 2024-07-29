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
    <?php 
    require('includes/dbh.inc.php');
    $result = pg_query($db_conn, "select * from passengers");
    if(!$result) {
            echo pg_last_error($db_conn);
            exit;
        }
    ?><br><br>

    <table>
        <tr>
            <th>Passenger ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
        </tr>
        <?php 
            while($row = pg_fetch_assoc($result)) {
                echo "
                    <tr>
                        <td>$row[passenger_id]</td>
                        <td>$row[first_name]</td>
                        <td>$row[last_name]</td>
                        <td>$row[email]</td>
                    </tr>
                ";
            }
        ?>
    </table>
</body>
</html>