<!DOCTYPE html>
<html>
    <style>

        body
        {
            background-image:url("../img/barbers4.png");
            background-repeat: no-repeat;
            background-size: cover;
        }

    </style>
    <body>

        <?php

        session_start();
        
        //CHECKING IF THERE IS ANY SESSION ON
        if(!isset($_SESSION['id']))
        {
            //IF THERE IS NOT ANY SESSION VALUE FOR ID
            //LAYOUT HOME PAGE WILL BE OPEN
            include '../layout/nav_home.php';
        }
        else
        {
            if($_SESSION['role']=="customer")
            {
                //CUSTOMER HOME PAGE
                include '../layout/cust_nav.php';
            }
            elseif($_SESSION['role']=="provider")
            {
                //PROVIDER HOME PAGE
                include '../layout/pro_nav.php';
            }
            elseif($_SESSION['role']=="administrator")
            {
                //ADMINISTRATORS HOME PAGE
                include '../layout/admin_nav.php';
            }
        }



        ?>
    </body>
    <html>