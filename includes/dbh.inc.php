<?php
     $db_conn = pg_connect("host=localhost dbname=FlightManagement user=postgres password=shweta");
     if(!$db_conn) {
         echo "An error occurred...<br>";
         exit;
     }
?>