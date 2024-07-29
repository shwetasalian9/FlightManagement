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
        $airline_names = pg_query($db_conn, "select airline_name from airlines");
        $airport_names = pg_query($db_conn, "select airport_name from airports");
        $airport_names1 = pg_query($db_conn, "select airport_name from airports");
        if(!$airline_names and !$airport_names and !$airport_names1) {
                echo pg_last_error($db_conn);
                exit;
            }
    ?>
    <form action="scheduleFlight.php" method="POST">

    <script>
            function getAirlineName() {
                var dropdown = document.getElementById("airline_name_id");
                var hiddenInput = document.getElementById("airline_id");
                var selectedValue = dropdown.value;
                hiddenInput.value = selectedValue;                
            },

            function getDeptAirportId() {
                var dropdown = document.getElementById("departure_airport_name_id");
                var hiddenInput = document.getElementById("departure_airport_id");
                var selectedValue = dropdown.value;
                hiddenInput.value = selectedValue;  
            },

            function getArrAirportId() {
                var dropdown = document.getElementById("arrival_airport_name_id");
                var hiddenInput = document.getElementById("arrival_airport_id");
                var selectedValue = dropdown.value;
                hiddenInput.value = selectedValue; 
            }
    </script>
    
    
    Airline Name: 
    <?php
    echo "<select id='airline_name_id' name='airline_name' onchange='getAirlineName()'>";
    while ($row = pg_fetch_assoc($airline_names)) {
        echo "<option value='" . $row['airline_name'] . "'>" . $row['airline_name'] . "</option>";
    }
    echo "</select>";
    echo "<input type='hidden' id='airline_id' name='airline_id'>";
    ?><br><br>

    Departure Airport Name:
    <?php
    echo "<select id='departure_airport_name_id' name='dept_airport_name' onchange='getDeptAirportId()'>";
    while ($row = pg_fetch_assoc($airport_names)) {
        echo "<option value='" . $row['airport_name'] . "'>" . $row['airport_name'] . "</option>";
    }
    echo "</select>";
    echo "<input type='hidden' id='departure_airport_id' name='departure_airport_id'>";
    ?><br><br>

    Arrival Airport Name:
    <?php
    echo "<select id='arrival_airport_name_id' name='arrival_airport_name' onchange='getArrAirportId()'>";
    while ($row = pg_fetch_assoc($airport_names1)) {
        echo "<option value='" . $row['airport_name'] . "'>" . $row['airport_name'] . "</option>";
    }
    echo "</select>";
    echo "<input type='hidden' id='arrival_airport_id' name='arrival_airport_id'>";
    ?><br><br>
    
    Departure Time :
    <input type="datetime-local" name="departure_time"><br><br>

    Arrival Time :
    <input type="datetime-local" name="arrival_time"><br><br>
    
    Price :
    <input type="text" name="price"><br><br>
    
    <input type="submit">
    </form>
    <?php
    require('includes/dbh.inc.php');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {        
        
        // get airline id
        $get_airline_id_query = "select airline_id from airlines where airline_name ='".$_POST['airline_name']."'";
        $_POST['airline_id'] = pg_fetch_assoc(pg_query($db_conn, $get_airline_id_query))['airline_id'];

        //get departure airport id
        
        $get_dept_airport_id_query = "select airport_id from airports where airport_name ='".$_POST['dept_airport_name']."'";
        $_POST['departure_airport_id'] = pg_fetch_assoc(pg_query($db_conn, $get_dept_airport_id_query))['airport_id'];

        //get arrival airport id
        $get_arr_airport_id_query = "select airport_id from airports where airport_name ='".$_POST['arrival_airport_name']."'";
        $_POST['arrival_airport_id'] = pg_fetch_assoc(pg_query($db_conn, $get_arr_airport_id_query))['airport_id'];

        //unset unwanted data
        unset($_POST['airline_name']);
        unset($_POST['dept_airport_name']);
        unset($_POST['arrival_airport_name']);

        $ins_result = pg_insert($db_conn, 'flights', $_POST);
        if(!$ins_result) {
                echo pg_last_error($db_conn);
                exit;
            }
        else {
            echo "<div style='text-align: center;'>New Schedule Added !</div>";
        }

    }
    ?>
</body>
</html>