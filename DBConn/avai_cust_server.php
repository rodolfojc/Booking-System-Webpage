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
    </head>
    <body>

        <?php 
        //DATABASE CONNECTION
        try {
            require_once '../DBConn/pdo_connect.php';
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        if (isset($_POST['submit'])) {

            //RECIEVE INPUTS FROM SEARCH FORM
            $type = $_POST['type'];  //SEARCH OPTION
            $key = $_POST['search']; //SEARCH VALUE
            $sql = "";

            //BY NAME
            if ($type == 1) {

                $sql = "SELECT avai_ref, pro_name, pro_surname, date, time FROM availabilities INNER JOIN providers ON availabilities.pro_id = providers.pro_id WHERE providers.pro_name='$key' AND availabilities.available='Yes'";
            }

            //BY LOCATION
            else {
                $sql= "SELECT avai_ref, pro_name, pro_surname, date, time FROM availabilities INNER JOIN providers ON availabilities.pro_id = providers.pro_id WHERE providers.location='$key' AND availabilities.available='Yes';";
            }

            $row = []; //ARRAY TO SAVE DATA TO BE USE AFTER

            foreach ($db->query($sql) as $r) {
                $row[] = $r; //GETTING DATA
            }
        }
        ?>
        <!-- INTERFACE FOR CUSTOMER TO GET AN APPOINTMENT 
                    AND ALL AVAILABILITIES -->
        <div class="header">
            <h2>Get Appointment</h2>
        </div>
        <form method="post" action="../DBConn/getAppoint_cust_server.php">

            <div class="input-group" >
                <label>Availability Reference: </label>
                <?php 
                echo '<select name="avaiRef">';
                foreach($row as $select => $rowT){
                    echo '<option value=' . $rowT['avai_ref'] . '>' . $rowT['avai_ref'] . '</option>';
                }
                echo '</select>';
                ?>
            </div>   
            <div class="input-group">
                <button type="submit" class="btn" name="get">Get!</button>
            </div>
        </form>
        <br>
        <br>
        <table align="right">
            <table width="600" border="1" cellpadding="1">

                <!-- BUILDING THE TABLE-->
                <tr>
                    <th>Availability Ref</th>
                    <th>Provider Name</th>
                    <th>Provider Surname</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>

                <!-- INSERTING DATA TO THE TABLE-->
                <?php
                foreach ($row as $rowT) {
                    // $_SESSION['date'] = $rowT['date'];
                    echo"<tr>";
                    echo"<td>".$rowT['avai_ref']."</td>";
                    echo"<td>".$rowT['pro_name']."</td>";
                    echo"<td>".$rowT['pro_surname']."</td>";
                    echo"<td>".$rowT['date']."</td>";
                    echo"<td>".$rowT['time']."</td>";
                }

                ?>

            </table>


            </body>
        </html>