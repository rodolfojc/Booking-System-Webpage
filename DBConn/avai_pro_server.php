<?php
//DATABASE CONNECTION
try {
    require_once '../DBConn/pdo_connect.php';
} catch (Exception $e) {
    $error = $e->getMessage();
}

session_start();

//SETTING VALUE TO INSERT IN AVAILABILITIES TABLE 
$proID = $_SESSION['id'];
$date = $_POST['date'];
$time = $_POST['hrs'];
$avai = "Yes";



if (isset($_POST['submit'])) {

    try{

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //INSERTING DATA TO AVAILABILITIES TABLE 
        $sql= "INSERT INTO availabilities (pro_id, date, time, available) 
        VALUES ('$proID', '$date', '$time', '$avai')";

        $db->exec($sql);
        $message = " Your avalilability has been ADDED";
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
        <div class="text-output">
            <!-- IT SHOWS THE $MESSAGE IF THE AVAILABILITY HAS BEEN ADDED -->
            <h2><?php echo $message; ?></h2>
        </div>
    </body>
</html>