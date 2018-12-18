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
        //DATEBASE CONNECTION
        try {
            require_once '../DBConn/pdo_connect.php';
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        //STATEMENT TO GET ALL PROVIDERS (EXCLUDING PASSWORD FIELD)    
        $sql = "SELECT pro_id, pro_name, pro_surname, mob_num, email, address,
        location,status FROM providers";

        $row = []; //ARRAY TO SAVE DATA

        foreach ($db->query($sql) as $r) {
            $row[] = $r; //GETTING DATA
        }

        ?>

        <div class="header">
            <h2>Actions</h2>
        </div>
        <form method="post" action="../DBConn/pro_delval_admin_server.php">

            <div class="input-group" >
                <label>Provider ID </label>
                <!-- SELECT PROVIDER BY ID-->
                <?php 
                echo '<select name="pro_id">';
                foreach($row as $select => $rowT){
                    echo '<option value=' . $rowT['pro_id'] . '>' . $rowT['pro_id'] . '</option>';
                }
                echo '</select>';
                ?>
            </div>
            <div class="input-group">
                <label>Action</label>
                <select name="type">
                    <option value="1">Delete</option>
                    <option value="2">Validate</option>
                </select>
            </div>
            <div class="input-group">
                <!-- BUTTON FOR POST IN PRO_DELAVAL_ADMIN_SERVER.PHP-->
                <button type="submit" class="btn" name="submit">Submit</button>
            </div>
        </form>
        <br>
        <br>
        <br>
        <br>
        <!-- BUILDING THE TABLE -->
        <table align="right">
            <table width="600" border="1" cellpadding="1">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Location</th>
                    <th>Status</th>
                </tr>

                <!-- iNSERTING DATA TO THE TABLE-->
                <?php
                foreach ($row as $rowT) {
                    echo"<tr>";
                    echo"<td>".$rowT['pro_id']."</td>";
                    echo"<td>".$rowT['pro_name']."</td>";
                    echo"<td>".$rowT['pro_surname']."</td>";
                    echo"<td>".$rowT['mob_num']."</td>";
                    echo"<td>".$rowT['email']."</td>";
                    echo"<td>".$rowT['address']."</td>";
                    echo"<td>".$rowT['location']."</td>";
                    echo"<td>".$rowT['status']."</td>";
                }
                ?>

            </table>
            </body>
        </html>