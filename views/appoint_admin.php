<?php

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
        try {
            require_once '../DBConn/pdo_connect.php';
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        //QUERY TO GET ALL APPOINTMENT IN APPOINTMENTS TABLE
        $sql = "SELECT * FROM appointments";

        $row = []; //ARRAY TO SAVE DATA

        foreach ($db->query($sql) as $r) {
            $row[] = $r; //GETTING DATA
        }
        ?>

        <div class="header">
            <h2>Actions</h2>
        </div>
        <form method="post" action="../DBConn/appoint_delcomm_admin_server.php">

            <div class="input-group" >
                <label>Appointment Ref. </label>
                <!-- SELECT APPOINTMENT BY REFERENCE-->
                <?php 
                echo '<select name="appoint_ref">';
                foreach($row as $select => $rowT){
                    echo '<option value=' . $rowT['appoint_ref'] . '>' . $rowT['appoint_ref'] . '</option>';
                }
                echo '</select>';
                ?>
            </div>
            <div class="input-group">
                <label>Action</label>
                <select name="type">
                    <option value="1">Delete</option>
                    <option value="2">Set a comment</option>
                </select>
            </div>
            <div class="input-group">
                <label>Comment:</label>
                <input type="text" name="comment">
            </div>
            <div class="input-group">
                 <!-- BUTTON FOR POST IN APPOINT_DELCOMM_ADMIN_SERVER.PHP-->
                <button type="submit" class="btn" name="submit">Submit</button>
            </div>
        </form>
        <br>
        <br>
         <!-- BUILDING TABLE-->
        <table align="right">
            <table width="600" border="1" cellpadding="1">
                <tr>
                    <th>Appointment Ref.</th>
                    <th>Availability Ref.</th>
                    <th>Customer ID</th>
                    <th>Comments</th>
                </tr>
                 <!-- INSERTING DATA TO THE TABLE-->
                <?php
                foreach ($row as $rowT) {
                    echo"<tr>";
                    echo"<td>".$rowT['appoint_ref']."</td>";
                    echo"<td>".$rowT['avai_ref']."</td>";
                    echo"<td>".$rowT['cust_id']."</td>";
                    echo"<td>".$rowT['comments']."</td>";

                }
                ?>

            </table>
            </body>
        </html>