<?php
//DATABASE CONNECTION
try {
    require_once '../DBConn/pdo_connect.php';
} catch (Exception $e) {
    $error = $e->getMessage();
}

session_start();

//RECEIVE AVAILABILITY REFERENCE
$avaiRef = $_POST['avai_ref'];


if (isset($_POST['delete'])) {

    //DELETE AVAILABILITY BY AVAILABILITY REFERENCE
    $sql = "DELETE FROM availabilities WHERE avai_ref='$avaiRef'";

    try{

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $db->exec($sql);
        $message = "Availability Ref:$avaiRef has been DELETED";

    }
    catch(PDOException $e)
    {
        $message = "Ups, there is a problem, please be sure the availability
        does not have any appointment registered and try again!";

    }

} 

?>

<?php
//CHECKING SESSION
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
        <!-- IT SHOWS THE MESSAGE OF THE RESULT-->
        <div class="text-output">
            <h2><?php echo $message; ?></h2>
        </div>
    </body>
</html>