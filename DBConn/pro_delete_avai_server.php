<?php
//DATABASE CONNECTION
try {
    require_once '../DBConn/pdo_connect.php';
} catch (Exception $e) {
    $error = $e->getMessage();
}

session_start();

//RECEIVE SELECT AVAILABILITY
$avaiRef = $_POST['avai_ref'];

if (isset($_POST['delete'])) {

    //STATEMENT TO DELETE THE AVAILABILITY
    $sql = "DELETE FROM availabilities WHERE avai_ref='$avaiRef'";

    try{

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $db->exec($sql);
        $message = "Your Availability Ref: $avaiRef has been DELETED";
        // echo $message;
    }
    catch(PDOException $e)
    {
        $message = "Ups, there is a problem, please try again later";
        //echo $sql . "<br>" . $e->getMessage();
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
        <!-- IT SHOWS A MESSAGE WITH THE RESULT-->
        <div class="text-output">
            <h2><?php echo $message; ?></h2>
        </div>
    </body>
</html>