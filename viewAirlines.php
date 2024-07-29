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
    $result = pg_query($db_conn, "select * from airlines");
    if(!$result) {
            echo pg_last_error($db_conn);
            exit;
        }
    ?><br><br>

    <table>
        <tr>
            <th>Airline ID</th>
            <th>Airline Name</th>
        </tr>
        <?php 
            while($row = pg_fetch_assoc($result)) {
                echo "
                    <tr>
                        <td>$row[airline_id]</td>
                        <td>$row[airline_name]</td>
                    </tr>
                ";
            }
        ?>
    </table>
</body>
</html>