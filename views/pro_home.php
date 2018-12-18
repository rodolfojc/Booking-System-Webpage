<?php
include'../register/cust_reg.php';
if(!isset($_SESSION['email']))
{
    header('location: ../index/index.php');
}
include '../layout/pro_nav.php';
?> 
<html>
    <head>
    </head>

    <body>
        <!-- PROFILE PICTURE FOR PROVIDERS  -->
        <img src="../img/pro_pic2.png" style="width:250px;height:250px;"><br>
    </body>

</html>
<!-- PROVIDER INFOMATION  -->
<?php
echo "Provider ID : ",$_SESSION['id'],"<br><br>";
echo "Name : ",$_SESSION['name'],"<br><br>";
echo "Surname : ",$_SESSION['surname'],"<br><br>";
echo "Email : ",$_SESSION['email'],"<br><br>";
echo "Mobile : ",$_SESSION['mobile'],"<br><br>";
echo "Address: ",$_SESSION['address'],"<br><br>";
echo "Location: ",$_SESSION['location'],"<br><br>";
echo "Status: ",$_SESSION['status'],"<br><br>";
echo "Registered: ",$_SESSION['reg_day'],"<br><br>";
?>
