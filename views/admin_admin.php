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

        //STATAMENT TO GET ALL ADMINISTRATOR
        //ADMIN@ADMIN IS THE MAIN ADMINISTRATOR, CANNOT BE ERASED
        $sql = "SELECT * FROM administrators WHERE privilege='2'";

        $row = [];//ARRAY TO SAVE THE DATA

        foreach ($db->query($sql) as $r) {
            $row[] = $r;//GETTING DATA
        }

        ?>
        <div class="header">
            <h2>Action</h2>
        </div>
        <form method="post" action="../DBConn/admin_del_create_admin_server.php">

            <div class="input-group" >
                <label>Administrator ID </label>
                <!-- SELECT BY CUSTOMER ID-->
                <?php 
                echo '<select name="admin_id">';
                foreach($row as $select => $rowT){
                    echo '<option value=' . $rowT['admin_id'] . '>' . $rowT['admin_id'] . '</option>';
                }
                echo '</select>';
                ?>
            </div>  
            <div class="input-group">
                <!-- BUTTON FOR POST IN ADMIN_DEL_CREATE_ADMIN_SERVER.PHP DELETE-->
                <button type="submit" class="btn" name="delete">Delete</button>
            </div>
            <div class="input-group">
                <!-- BUTTON FOR CREATE A NEW ADMIN USING HYPERLINK-->
                <a href="../register/admin_reg.php" class="button">Create new Administrator</a>
            </div>
        </form>    

        <br><br><br>
        <table align="right">
            <table width="600" border="1" cellpadding="1">
                <tr>
                    <th>Admin ID</th>
                    <th>Username</th>
                    <th>Privilege</th>
                </tr>

                <?php
                foreach ($row as $rowT) {
                    echo"<tr>";
                    echo"<td>".$rowT['admin_id']."</td>";
                    echo"<td>".$rowT['admin_user']."</td>";
                    echo"<td>".$rowT['privilege']."</td>";

                }
                ?>

            </table>
        </body>
</html>