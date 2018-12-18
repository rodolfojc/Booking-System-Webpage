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
        </style>
    </head>
    <body>

        <ul><!-- LINK FOR ADMINISTRATOR OPTIONS -->
            <li class="li1"><a href="../index/Index.php">Home</a></li>
            <li class="li1"><a href="../views/admin_home.php">Profile</a></li>
            <li class="li1"><a href="../views/cust_admin.php">Customers</a></li>
            <li class="li1"><a href="../views/pro_admin.php">Providers</a></li>
            <li class="li1"><a href="../views/avai_admin.php">Availabilities</a></li>
            <li class="li1"><a href="../views/appoint_admin.php">Appointments</a></li>
            <li class="li1"><a href="../views/admin_admin.php">Administrators</a></li>

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