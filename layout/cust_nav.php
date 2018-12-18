<?php 
try {
    require_once '../DBConn/pdo_connect.php';
} catch (Exception $e) {
    $error = $e->getMessage();
}

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <style>
            body {margin:0;}
            ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
                overflow: hidden;
                background-color: #333;
                top: 0;
                width: 100%;
                left: 0;
                font: verdana;
            }
            .li1 {
                float: left;

        </style>
    </head>
    <body>

        <ul><!-- LINKS FOR CUSTOMER OPTIONS -->
            <li class="li1"><a href="../index/Index.php">Home</a></li>
            <li class="li1"><a href="../views/cust_home.php">Profile</a></li>
            <li class="li1"><a href="../views/search_avai_cust.php">Find availability</a></li>
            <li class="li1"><a href="../views/appoint_status_cust.php">Check appointment</a></li>
            <li class="li1"><a href="../views/comments_cust.php">Make a complain / feedback</a></li>
            
            <!-- STATEMENTS FOR LOGOUT -->
            <?php
            if(isset($_SESSION['email'])){ ?>
            <li style=" float:right;" > <a class="link" href="../logout/logout.php" style="text-align:center">Logout</a></li>
            <?php }
            else{ 
                session_start();
                if(isset($_SESSION['email'])){?>
            <li style=" float:right;" > <a class="link" href="../logout/logout.php" >Logout</a></li>
            <?php } else { ?>

            <li class="li1"><a class="link" href="../login/login.php" style="text-align:center">Login</a></li>
            <?php } } ?>
        </ul>

    </body>
</html>