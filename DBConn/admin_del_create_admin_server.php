<?php
//DATABASE CONNECTION
try {
    require_once '../DBConn/pdo_connect.php';
} catch (Exception $e) {
    $error = $e->getMessage();
}

session_start();

//RECEIVE ADMIN ID BY POST
$adminID = $_POST['admin_id'];

if (isset($_POST['delete'])) {

    try{

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //STATEMENT TO DELETE THE ADMIN BY ID
        $sql= "DELETE FROM administrators WHERE admin_id ='$adminID'";

        $db->exec($sql);
        $message = " The Administrator ID: $adminID has been DELETED";
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
            <!-- IT SHOWS THE $MESSAGE IF THE ADMIN HAS BEEN DELETED -->
            <h2><?php echo $message; ?></h2>
        </div>
    </body>
</html>