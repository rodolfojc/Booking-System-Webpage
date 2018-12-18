<?php
//CHECKING SESSION
session_start();
if(!isset($_SESSION['email']))
{
    header('location: ../index/index.php');
}
include '../layout/cust_nav.php';
?>
<!DOCTYPE html>
<html>

    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <style>

        </style>
    </head>
    <body>
        <?php 
        try {
            require_once '../DBConn/pdo_connect.php';
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        //GETTING CUSTOMER ID FOR CURRENT SESSION
        $custID = $_SESSION['id'];

        //DATABASE QUERY TO CHECK APPOINTMENT FOR CURRENT USER
        $sql = "SELECT appoint_ref, pro_name, pro_surname, date, time, available 
        FROM availabilities INNER JOIN providers 
        ON availabilities.pro_id = providers.pro_id 
        INNER JOIN appointments ON availabilities.avai_ref = appointments.avai_ref 
        INNER JOIN customers ON appointments.cust_id = customers.cust_id
        WHERE appointments.cust_id='$custID'";

        $row = []; //ARRAY TO SAVE DATA

        foreach ($db->query($sql) as $r) {
            $row[] = $r; //GETTING DATA
        }

        ?>
        <div class="header">
            <h2>Cancel</h2>
        </div>
        <form method="post" action="../DBConn/cancel_appoint_cust.php">

            <div class="input-group" >
                <label>Appointment Ref: </label>
                <!-- SETTING SELECT OPTION BY APPOINTMENT REF-->
                <?php 
                echo '<select name="appointRef">';
                foreach($row as $select => $rowT){
                    echo '<option value=' . $rowT['appoint_ref'] . '>' . $rowT['appoint_ref'] . '</option>';
                }
                echo '</select>';
                ?>
            </div>  
            <div class="input-group">
                <button type="submit" class="btn" name="cancel">Cancel</button>
            </div>
        </form>
        <br>
        <br>
        <table align="right">
            <table width="600" border="1" cellpadding="1">
                <!-- BUILDING TABLE-->
                <tr>
                    <th>Appointment Ref</th>
                    <th>Provider Name</th>
                    <th>Provider Surname</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>

                </tr>
                <!-- INSERTING DATA TO THE TABLE-->
                <?php
                foreach ($row as $rowT) {
                    echo"<tr>";
                    echo"<td>".$rowT['appoint_ref']."</td>";
                    echo"<td>".$rowT['pro_name']."</td>";
                    echo"<td>".$rowT['pro_surname']."</td>";
                    echo"<td>".$rowT['date']."</td>";
                    echo"<td>".$rowT['time']."</td>";
                    echo"<td>".$rowT['available']."</td>";
                }
                ?>

            </table>
            </body>
        </html>