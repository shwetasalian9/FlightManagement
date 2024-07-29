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
    $result = pg_query($db_conn, "select * from flights");
    if(!$result) {
            echo pg_last_error($db_conn);
            exit;
        }
    ?><br><br>

    <table>
        <tr>
            <th>Flight ID</th>
            <th>Airline ID</th>
            <th>Departure Airport ID</th>
            <th>Arrival Airport ID</th>
            <th>Departure Time</th>
            <th>Arrival Time</th>
            <th>Price</th>
        </tr>
        <?php 
            while($row = pg_fetch_assoc($result)) {
                echo "
                    <tr>
                        <td>$row[flight_id]</td>
                        <td>$row[airline_id]</td>
                        <td>$row[departure_airport_id]</td>
                        <td>$row[arrival_airport_id]</td>
                        <td>$row[departure_time]</td>
                        <td>$row[arrival_time]</td>
                        <td>$row[price]</td>
                    </tr>
                ";
            }
        ?>
    </table>
</body>
</html>