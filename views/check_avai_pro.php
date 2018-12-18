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
    </head>
    <body>
        <?php 
        try {
            require_once '../DBConn/pdo_connect.php';
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        //VALUE TO USE BE USE FOR THE QUERY
        $email = $_SESSION['email'];

        //QUERY TO SEARCH ANY AVAILABILITY THAT IS NOT YET BOOKED   
        $sql = "SELECT avai_ref, date, time FROM availabilities av 
        INNER JOIN providers pr ON av.pro_id = pr.pro_id  
        WHERE email='$email' AND available='Yes'";

        $row = []; //ARRAY TO SAVE INFORMATION

        foreach ($db->query($sql) as $r) {
            $row[] = $r;
        }

        ?>
        <div class="header">
        <h2>Actions</h2>
        </div>
        <form method="post" action="../DBConn/pro_delete_avai_server.php">
        
        <div class="input-group" >
            <label>Availability Ref </label>
           <!-- SELECT OPTION FOR AVAILABILITY REFERENCE -->
            <?php 
            echo '<select name="avai_ref">';
            foreach($row as $select => $rowT){
                echo '<option value=' . $rowT['avai_ref'] . '>' . $rowT['avai_ref'] . '</option>';
            }
            echo '</select>';
            ?>
        </div>  
        <div class="input-group">
            <!-- BUTTON FOR POST IN CUST_DELETE_AVAI_SERVER.PHP-->
            <button type="submit" class="btn" name="delete">Delete</button>
        </div>
        </form>
        <br>
        <br>
        <br>
        <table align="right">
            <table width="600" border="1" cellpadding="1">

                <!-- BUILDING TABLE-->
                <tr>
                    <th>Availability Ref</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
                <!-- INSERTING DATA TO TABLE-->
                <?php
                foreach ($row as $rowT) {
                    echo"<tr>";
                    echo"<td>".$rowT['avai_ref']."</td>";
                    echo"<td>".$rowT['date']."</td>";
                    echo"<td>".$rowT['time']."</td>";
                }
                ?>

            </table>
            </body>
        </html>