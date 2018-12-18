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
        //DATABASE CONNECTION
        try {
            require_once '../DBConn/pdo_connect.php';
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        //GETTING CURRENT CUSTOMER ID
        $custID = $_SESSION['id'];

        //DATABASE QUERY TO GET ANY APPOINTMENT BY CURRENT CUSTOMER AND THE COMMENTS    
        $sql = "SELECT appoint_ref, pro_name, pro_surname, date, time, available, comments 
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
            <h2>Comments</h2>
        </div>
        <form method="post" action="../DBConn/comment_cust_server.php">

            <div class="input-group" id="email">
                <label>Appointment Ref: </label>
                <?php 
                echo '<select name="appointRef">';
                foreach($row as $select => $rowT){
                    echo '<option value=' . $rowT['appoint_ref'] . '>' . $rowT['appoint_ref'] . '</option>';
                }
                echo '</select>';
                ?>
            </div>  
            <div class="input-group">
                <label>Add comment</label>
                <input type="text" name="comment" value="">
            </div>
            <div class="input-group">
                <button type="submit" class="btn" name="add">Add</button>
            </div>
        </form>
        <br>
        <br>
        <!-- BUILDING THE TABLE -->
        <table align="right">
            <table width="600" border="1" cellpadding="1">
                <tr>
                    <th>Appointment Ref</th>
                    <th>Provider Name</th>
                    <th>Provider Surname</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Comments</th>

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
                    echo"<td>".$rowT['comments']."</td>";
                }
                ?>

            </table>
            </body>
        </html>