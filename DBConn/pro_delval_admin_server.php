<?php
//DATABASE CONNECTION
try {
    require_once '../DBConn/pdo_connect.php';
} catch (Exception $e) {
    $error = $e->getMessage();
}

session_start();

//RECEIVE PROVIDER ID AND TYPE OF ACTION BY POST
$proID = $_POST['pro_id'];
$action = $_POST['type'];

if (isset($_POST['submit'])) {

    //TO DELETE PROVIDER
    if($action==1) {

        $sql = "DELETE FROM providers WHERE pro_id='$proID'";

        try{

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $db->exec($sql);
            $message = "Provider ID:$proID has been DELETED";
            // echo $message;
        }
        catch(PDOException $e)
        {
            
            $message = "Ups, there is a problem, please be sure the provider does not have 
            any availability or appointment registered and try again!";
            //echo $sql . "<br>" . $e->getMessage();
        }
    }
    // TO VALIDATE PROVIDER
    else{

        $sql = "UPDATE providers SET status='Confirmed' WHERE pro_id='$proID'";

        try{

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $db->exec($sql);
            $message = "Provider ID: $proID has been CONFIRMED!";

        }
        catch(PDOException $e)
        {
            $message = "Ups, there is a problem, please try again or contact an administrator!";
            
        }

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
        <!-- IT SHOW MESSAGE OF RESULT -->
        <div class="text-output">
            <h2><?php echo $message; ?></h2>
        </div>
    </body>
</html>