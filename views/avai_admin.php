<?php
//CHECKING SESSION
session_start();
if(!isset($_SESSION['email']))
{
    header('location: ../index/index.php');
}
include '../layout/admin_nav.php';
?>
<!DOCTYPE html>
<html>

    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <?php 
        //DATABASE CONNECTION
        try {
            require_once '../DBConn/pdo_connect.php';
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        //GETTING ALL AVAILABILITIES 
        $sql = "SELECT * FROM availabilities";

        $row = []; //ARRAY TO SAVE DATA

        foreach ($db->query($sql) as $r) {
            $row[] = $r; //GETTING DATA
        }
        ?>

        <div class="header">
            <h2>Actions</h2>
        </div>
        <form method="post" action="../DBConn/avai_delete_admin_server.php">

            <div class="input-group" >
                <label>Availability Ref. </label>
                <!-- SELECT FOR AVAILABIITIES BY AVAILABILITY REFERENCE-->
                <?php 
                echo '<select name="avai_ref">';
                foreach($row as $select => $rowT){
                    echo '<option value=' . $rowT['avai_ref'] . '>' . $rowT['avai_ref'] . '</option>';
                }
                echo '</select>';
                ?>
            </div>  
            <div class="input-group">
                <!-- BUTTON FOR POST IN AVAI_DELETE_ADMIN_SERVER.PHP-->
                <button type="submit" class="btn" name="delete">Delete</button>
            </div>
        </form>
        <br>
        <br>
        <br>
        <!-- BUILDING THE TABLE-->
        <table align="right">
            <table width="600" border="1" cellpadding="1">
                <tr>
                    <th>Availability Ref.</th>
                    <th>Provider ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Available/Status</th>
                </tr>

                <!-- INSERTING DATA TO THE TABLE-->
                <?php
                foreach ($row as $rowT) {
                    echo"<tr>";
                    echo"<td>".$rowT['avai_ref']."</td>";
                    echo"<td>".$rowT['pro_id']."</td>";
                    echo"<td>".$rowT['date']."</td>";
                    echo"<td>".$rowT['time']."</td>";
                    echo"<td>".$rowT['available']."</td>";

                }
                ?>

            </table>
            </body>
        </html>