<?php
//DATABASE CONNECTION
try {
    require_once '../DBConn/pdo_connect.php';
} catch (Exception $e) {
    $error = $e->getMessage();
}

session_start();

//RECIEVE CUSTOMER SELECTED
$custID = $_POST['cust_id'];

if (isset($_POST['delete'])) {

    //STATEMENT TO DELETE CUSTOMER BY ID  
    $sql = "DELETE FROM customers WHERE cust_id='$custID'";

    try{

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->exec($sql);
        $message = "Customer ID:$custID has been DELETED";

    }
    catch(PDOException $e)
    {
        $message = "Ups, there is a problem, please be sure the customer does 
        not have any availability or appointment registered and try again!";

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
        <!-- IT SHOWS THE RESULT OF THE STATEMENT-->
        <div class="text-output">
            <h2><?php echo $message; ?></h2>
        </div>
    </body>
</html>