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
    $result = pg_query($db_conn, "select * from airports");
    if(!$result) {
            echo pg_last_error($db_conn);
            exit;
        }
    ?><br><br>

    <table>
        <tr>
            <th>Airport ID</th>
            <th>Airport Code</th>
            <th>Airport Name</th>
            <th>City</th>
            <th>Country</th>
        </tr>
        <?php 
            while($row = pg_fetch_assoc($result)) {
                echo "
                    <tr>
                        <td>$row[airport_id]</td>
                        <td>$row[airport_code]</td>
                        <td>$row[airport_name]</td>
                        <td>$row[city]</td>
                        <td>$row[country]</td>
                    </tr>
                ";
            }
        ?>
    </table>
</body>
</html>