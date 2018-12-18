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

        // QUERY TO GET ALL CUSTOMER ON THE CUSTOMERS DATABASE (EXCLUDING PASSWORD FIELD) 
        $sql = "SELECT cust_id, cust_name, cust_surname, mob_num, email, address FROM customers";

        $row = []; //ARRAY TO SAVE DATA

        foreach ($db->query($sql) as $r) {
            $row[] = $r; //GETTING DATA
        }

        ?>
        <div class="header">
            <h2>Actions</h2>
        </div>
        <form method="post" action="../DBConn/cust_delete_admin_server.php">

            <div class="input-group" >
                <label>Customer ID </label>
                <!-- SELECT BY CUSTOMER ID-->
                <?php 
                echo '<select name="cust_id">';
                foreach($row as $select => $rowT){
                    echo '<option value=' . $rowT['cust_id'] . '>' . $rowT['cust_id'] . '</option>';
                }
                echo '</select>';
                ?>
            </div>  
            <div class="input-group">
                <!-- BUTTON FOR POST IN CUST-DELTE_ADMIN_SERVER.PHP-->
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
                    <th>ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Address</th>
                </tr>
                <!-- INSERTING DATA TO THE TABLE -->
                <?php
                foreach ($row as $rowT) {
                    echo"<tr>";
                    echo"<td>".$rowT['cust_id']."</td>";
                    echo"<td>".$rowT['cust_name']."</td>";
                    echo"<td>".$rowT['cust_surname']."</td>";
                    echo"<td>".$rowT['mob_num']."</td>";
                    echo"<td>".$rowT['email']."</td>";
                    echo"<td>".$rowT['address']."</td>";
                }
                ?>

            </table>
            </body>
        </html>