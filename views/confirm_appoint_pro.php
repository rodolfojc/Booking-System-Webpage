<?php
//CHECKING SESSION
session_start();
if(!isset($_SESSION['email']))
{
    header('location: ../index/index.php');
}
include '../layout/pro_nav.php';
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
        //DATABASE CONNECTION
        try {
            require_once '../DBConn/pdo_connect.php';
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        //GETTING PROVIDER ID IN CURRENT SESSION
        $proID = $_SESSION['id'];

        //SEARCHING ALL APPOINTMENTS FOR PROVIDER   
        $sql = "SELECT appoint_ref, cust_name, cust_surname, date, time, available, comments
        FROM appointments INNER JOIN customers ON appointments.cust_id = customers.cust_id 
        INNER JOIN availabilities ON availabilities.avai_ref = appointments.avai_ref 
        INNER JOIN providers ON availabilities.pro_id = providers.pro_id
        WHERE availabilities.pro_id='$proID'";

        $row = []; //ARRAY TO SAVE DATA

        foreach ($db->query($sql) as $r) {
            $row[] = $r; //SAVING DATA
        }

        ?>
        <div class="header">
            <h2>Set</h2>
        </div>
        <form method="post" action="../DBConn/set_appointCorC_pro.php">

            <div class="input-group" id="email">
                <label>Availability Reference: </label>
                <!-- SELECT OPTION WITH AVAILABILITY REFERENCES -->
                <?php 
                echo '<select name="appointRef">';
                foreach($row as $select => $rowT){
                    echo '<option value=' . $rowT['appoint_ref'] . '>' . $rowT['appoint_ref'] . '</option>';
                }
                echo '</select>';
                ?>
            </div>  
            <div class="input-group">
                <label>
                    Set:
                </label>
                <!-- OPTION AVAILABLES TO SET -->
                <select name="type">
                    <option value="1">Confirm</option>
                    <option value="2">Cancel</option>
                    <option value="3">COMPLETED</option>
                </select>
            </div>
            <div class="input-group">
                <button type="submit" class="btn" name="set">Set</button>
            </div>
        </form>
        <br>
        <br>
        <table align="right">
            <table width="600" border="1" cellpadding="1">

                <!-- BUIDING THE TABLE -->
                <tr>
                    <th>Appointment Ref</th>
                    <th>Customer Name</th>
                    <th>Customer Surname</th>
                    <th>Date</th>
                    <th>Time</th>#
                    <th>Status</th>
                    <th>Comments</th>

                </tr>

                <!-- INSERTING DATA TO THE TABLE -->
                <?php
                foreach ($row as $rowT) {
                    // $_SESSION['date'] = $rowT['date'];
                    echo"<tr>";
                    echo"<td>".$rowT['appoint_ref']."</td>";
                    echo"<td>".$rowT['cust_name']."</td>";
                    echo"<td>".$rowT['cust_surname']."</td>";
                    echo"<td>".$rowT['date']."</td>";
                    echo"<td>".$rowT['time']."</td>";
                    echo"<td>".$rowT['available']."</td>";
                    echo"<td>".$rowT['comments']."</td>";

                }
                ?>

            </table>
            </body>
        </html>