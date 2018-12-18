<?php
include('../DBConn/admin_reg_server.php');
//CHECKING SESSION
if(!isset($_SESSION['email']))
{
    header('location: ../index/index.php');
}
include '../layout/admin_nav.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Done</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <div class="text-output">
            <!-- IT SHOWS IF THE ADMINISTRATOR HAS BEEN CREATED -->
            <h2>Administrator has been CREATED!</h2>
        </div>
    </body>
</html>