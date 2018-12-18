<?php
include'../register/cust_reg.php';
if(!isset($_SESSION['email']))
{
    header('location: ../index/index.php');
}
include '../layout/admin_nav.php';
?> 
<html>
    <head>
    </head>

    <body>
        <!-- PROFILE PICTURE FOR ADMINISTRATORS -->
        <img src="../img/admin_pic.png" style="width:250px;height:250px;"><br>
    </body>

</html>
<!-- ADMINISTRATOR INFORMATION-->
<?php
echo "USERNAME : ",$_SESSION['email'],"<br><br>";
echo "PRIVILEGE : ",$_SESSION['privilege'],"<br><br>";

?>