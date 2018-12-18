<?php

try {
    require_once '../DBConn/pdo_connect.php';
} catch (Exception $e) {
    $error = $e->getMessage();
}

session_start();

$appointRef = $_POST['appointRef'];
$message="Cancelled";

if (isset($_POST['cancel'])) {

        $sql= "UPDATE availabilities 
        INNER JOIN appointments 
        ON availabilities.avai_ref = appointments.avai_ref
        SET availabilities.available='$message'
        WHERE appointments.appoint_ref='$appointRef'";


    try{

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $db->exec($sql);
        $message = "<br>The appointment ref:$appointRef has been set '$message'";
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