<?php

try {
    require_once '../DBConn/pdo_connect.php';
} catch (Exception $e) {
    $error = $e->getMessage();
}

session_start();

$appointRef = $_POST['appointRef'];
$comment = "";



if (isset($_POST['add'])) {

    $comment = $_POST['comment'];

        $sql= "UPDATE appointments 
        INNER JOIN availabilities 
        ON availabilities.avai_ref = appointments.avai_ref
        SET appointments.comments='Customer: $comment'
        WHERE appointments.appoint_ref='$appointRef'";

    try{

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $db->exec($sql);
        $message = "<br>The comment in Appointment Ref: $appointRef has been set '$comment'";
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
        <div class="text-output">
            <h2><?php echo $message; ?></h2>
        </div>
    </body>
</html>