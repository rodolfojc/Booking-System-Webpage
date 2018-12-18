<?php

try {
    require_once '../DBConn/pdo_connect.php';
} catch (Exception $e) {
    $error = $e->getMessage();
}

session_start();

$appointRef = $_POST['appoint_ref'];
$action = $_POST['type'];
$comment = $_POST['comment'];

if (isset($_POST['submit'])) {

    if($action==1) {

        $sql = "DELETE FROM appointments WHERE appoint_ref='$appointRef'";

        try{

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $db->exec($sql);
            //$message = "Appointment Ref:$appointRef has been DELETED";
            // echo $message;
        }
        catch(PDOException $e)
        {
            //$message = "Ups, there is a problem, please try again!";
            //echo $sql . "<br>" . $e->getMessage();
        }

        $sqlUp = "UPDATE availabilities 
        INNER JOIN appointments ON availabilities.avai_ref = appointments.avai_ref 
        SET availabilities.available='Cancelled' WHERE appointments.appoint_ref='$appointRef'";

        try{

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $db->exec($sqlUp);
            $message = "Appointment Ref:$appointRef has been DELETED <br> Availability has been set 'Cancelled'";
            // echo $message;
        }
        catch(PDOException $e)
        {
            $message = "Ups, there is a problem, please try again!";
            //echo $sql . "<br>" . $e->getMessage();
        }




    }
    else{

        $sql = "UPDATE appointments SET comments='Admin: $comment' WHERE appoint_ref='$appointRef'";

        try{

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $db->exec($sql);
            $message = "Appointment Ref:$appointRef<br>Comment has been set: $comment";
            // echo $message;
        }
        catch(PDOException $e)
        {
            $message = "Ups, there is a problem, please try again!";
            //echo $sql . "<br>" . $e->getMessage();
        }

    }

} 

?>

<?php

if(!isset($_SESSION['email']))
{
    header('location: ../index/index.php');
}
include '../layout/admin_nav.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Done</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <div class="text-output">
            <h2><?php echo $message; ?></h2>
        </div>
    </body>
</html>