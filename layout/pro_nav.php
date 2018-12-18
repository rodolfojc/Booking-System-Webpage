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
        <!-- LINKS FOR PROVIDERS OPTIONS-->
        <ul>
            <li class="li1"><a href="../index/Index.php">Home</a></li>
            <li class="li1"><a href="../views/pro_home.php">Profile</a></li>
            <li class="li1"><a href="../views/avai_pro.php">Add availability</a></li>
            <li class="li1"><a href="../views/check_avai_pro.php">My availabilities</a></li>
            <li class="li1"><a href="../views/confirm_appoint_pro.php">Appointments</a></li>

            <!-- STATEMANTS FOR LOGOUT-->
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