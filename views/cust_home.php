<?php
//CHECKING SESSION
include'../register/cust_reg.php';
if(!isset($_SESSION['email']))
{
    header('location: ../index/index.php');
}
include '../layout/cust_nav.php';
?> 

<html>
    <head>
    </head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <body>
        <!-- PROFILE PICTURE FOR CUSTOMERS  -->
        <img src="../img/cust_pic.png" style="width:250px;height:250px;"><br>
    </body>

</html>
<!-- CUSTOMER INFORMATION   -->
<?php
echo "Customer ID: ",$_SESSION['id'],"<br><br>";
echo "Name : ",$_SESSION['name'],"<br><br>";
echo "Email : ",$_SESSION['email'],"<br><br>";
echo "Mobile : ",$_SESSION['mobile'],"<br><br>";
?>