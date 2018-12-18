<?php
//CHECKING SESSION
try {
    require_once '../DBConn/pdo_connect.php';
} catch (Exception $e) {
    $error = $e->getMessage();
}

session_start();

//GETTING VALUE FROM POST
$appointRef = $_POST['appointRef'];
$set = $_POST['type'];
$message="";


if (isset($_POST['set'])) {

    //SET APPOINTMENT TO CONFIRMED
    if ($set == 1) {

        $sql= "UPDATE availabilities 
        INNER JOIN appointments 
        ON availabilities.avai_ref = appointments.avai_ref
        SET availabilities.available='Confirmed'
        WHERE  appointments.appoint_ref='$appointRef'";

        $message = "<br>The Appointment Ref: $appointRef has been set 'Confirmed'";

        //SET APPOINTMENT TO CANCELLED
    } elseif ($set == 2) {
        $sql= "UPDATE availabilities 
        INNER JOIN appointments 
        ON availabilities.avai_ref = appointments.avai_ref
        SET availabilities.available='Cancelled'
        WHERE  appointments.appoint_ref='$appointRef'";

        $message = "<br>The Appointment Ref: $appointRef has been set 'Cancelled'";

        //SET APPOINTMENT TO COMPLETED
    } else {
        $sql= "UPDATE availabilities 
        INNER JOIN appointments 
        ON availabilities.avai_ref = appointments.avai_ref
        SET availabilities.available='COMPLETED'
        WHERE  appointments.appoint_ref='$appointRef'";

        $message = "<br>The Appointment Ref: $appointRef has been set 'COMPLETED'";
    }

    try{

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $db->exec($sql);
        // echo $message;
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }

} 

?>

<?php

//CHECKING SESSION
if(!isset($_SESSION['email']))
{
    header('location: ../index/index.php');
}
include '../layout/pro_nav.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Done</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <!-- IT SHOW THE MESSAGE OF CONFIRMATION-->
        <div class="text-output">
            <h2><?php echo $message; ?></h2>
        </div>
    </body>
</html>




