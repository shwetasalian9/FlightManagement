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
        $airport_names = pg_query($db_conn, "select airport_name from airports");
        $airport_names1 = pg_query($db_conn, "select airport_name from airports");
        if(!$airport_names and airport_names1 ) {
                echo pg_last_error($db_conn);
                exit;
            }
    ?>

    <form action="searchFlights.php" method="POST">
    Departure Airport: 
    <?php
    echo "<select name='dept_airport_name'>";
    while ($row = pg_fetch_assoc($airport_names)) {
        echo "<option value='" . $row['airport_name'] . "'>" . $row['airport_name'] . "</option>";
    }
    echo "</select>";
    ?><br><br>

    Arrival Airport:
    <?php
    echo "<select name='arr_airport_name'>";
    while ($row = pg_fetch_assoc($airport_names1)) {
        echo "<option value='" . $row['airport_name'] . "'>" . $row['airport_name'] . "</option>";
    }
    echo "</select>";
    ?><br><br>

    Departure Date :
    <input type="date" name="departure_time"><br><br>

    <input type="submit"><br><br>
    
    </form>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
         
        require('includes/dbh.inc.php');

        // Get airport ids
        $dept_airport_id_query = "select airport_id from airports where airport_name ='".$_POST['dept_airport_name']."'";
        
        $arr_airport_id_query = "select airport_id from airports where airport_name ='".$_POST['arr_airport_name']."'";

        $dept_airport_id = pg_fetch_assoc(pg_query($db_conn, $dept_airport_id_query))['airport_id'];

        $arr_airport_id = pg_fetch_assoc(pg_query($db_conn, $arr_airport_id_query))['airport_id'];

        if(!$dept_airport_id and !$arr_airport_id) {
            echo pg_last_error($db_conn);
            exit;
        }        
        
        $select_query = "select * from flights where departure_airport_id='".$dept_airport_id."' and arrival_airport_id='".$arr_airport_id."' and DATE(departure_time) ='".$_POST['departure_time']."'";
        $result = pg_query($db_conn, $select_query);
        if(!$result) {
            echo pg_last_error($db_conn);
            exit;
        }    

        echo "<table>";
            echo "
            <tr>
                <th>Flight ID</th>
                <th>Airline ID</th>
                <th>Departure Airport ID</th>
                <th>Arrival Airport ID</th>
                <th>Departure Time</th>
                <th>Arrival Time</th>
                <th>Price</th>
            </tr>
            ";
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
        echo "</table>";

    }
    ?>
        
</body>
</html>