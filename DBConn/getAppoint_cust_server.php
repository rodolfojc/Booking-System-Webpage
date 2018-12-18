<?php
//DATABASE CONNECTION
try {
    require_once '../DBConn/pdo_connect.php';
} catch (Exception $e) {
    $error = $e->getMessage();
}

session_start();

//RECEIVE CUSTOMER ID - CURRENT SESSION AND AVAILABILITY REFERENCE
$custID = $_SESSION['id'];
$AvaiRef = $_POST['avaiRef'];
$comments = "No";



if (isset($_POST['get'])) {

    try{

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //INSERTING APPOINTMENT IN APPOINTMENTS TABLE
        $sql= "INSERT INTO appointments (avai_ref, cust_id, comments)  
        VALUES ('$AvaiRef', '$custID', '$comments')";

        $db->exec($sql);
        $message = " Your Appointment has been booked, Thanks!";
        // echo $message;
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }

    try{

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //AS THE AVAILABILITY IS NOT AVAILABLE ANYMORE, THE AVAILABILITY HAS TO BE CHANGED
        //UNCONFORMED FOR PRIVIDERS BE ABLE TO SEE THEIR APPOINTMENTS TO BE CONFIRMED
        $sql= "UPDATE availabilities SET available='Unconfirmed' WHERE avai_ref='$AvaiRef'";

        $db->exec($sql);
        $messageTwo = "<br>Your appointment status is: unconfirmed";
        // echo $message;
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }

}

?>

<?php

if(!isset($_SESSION['email']))
{
    header('location: ../index/index.php');
}
include '../layout/cust_nav.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Done</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <!-- IT SHOW A MESSAGE WITH THE CONFIRMATION/RESULT-->
        <div class="text-output">
            <h2><?php echo $message.$messageTwo; ?></h2>
        </div>
    </body>
</html>