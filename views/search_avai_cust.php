<?php
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
        <title>Appointments</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <div class="header">
            <h2>Availabilities</h2>
        </div>
        <!-- SEARCH PROVIDER-->
        <form method="post" action="../DBConn/avai_cust_server.php">
            <div class="input-group">
                <label>Search By:</label>
                <select name="type">
                    <option value="1">Name</option>
                    <option value="2">Location</option>
                </select>
            </div>

            <div class="input-group">
                <label>Keyword</label>
                <input type="text" name="search">
            </div>

            <div class="input-group">
                <!-- BUTTON FOR POST AVAI_CUST_SERVER.PHP-->
                <button type="submit" class="btn" name="submit">Submit</button>
            </div>
        </form>

    </body>
</html>