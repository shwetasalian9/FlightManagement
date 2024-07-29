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
        $flight_ids = pg_query($db_conn, "select flight_id from flights");
        $passenger_ids = pg_query($db_conn, "select passenger_id from passengers");        
        if(!$flight_ids and !$passenger_ids) {
                echo pg_last_error($db_conn);
                exit;
            }
    ?>

    <form action="makeBooking.php" method="POST">

    Flight ID:
    <?php
    echo "<select name='flight_id'>";
    while ($row = pg_fetch_assoc($flight_ids)) {
        echo "<option value='" . $row['flight_id'] . "'>" . $row['flight_id'] . "</option>";
    }
    echo "</select>";
    ?><br><br>

    Passenger ID:
    <?php
    echo "<select name='passenger_id'>";
    while ($row = pg_fetch_assoc($passenger_ids)) {
        echo "<option value='" . $row['passenger_id'] . "'>" . $row['passenger_id'] . "</option>";
    }
    echo "</select>";
    ?><br><br>

    Booking Date :
    <input type="datetime-local" name="booking_date"><br><br>

    <input type="submit">
    </form>
    <?php
    require('includes/dbh.inc.php');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
        $ins_result = pg_insert($db_conn, 'bookings', $_POST);
        if(!$ins_result) {
                echo pg_last_error($db_conn);
                exit;
            }
        else {
            echo "<div style='text-align: center;'>New Booking Added !</div>";
        }
    }
    ?>
</body>
</html>