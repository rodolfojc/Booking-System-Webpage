<?php
session_start();

// VARIABLE DECLARATION
$username = "";
$password = "";
$privilege = '2';

$errors = array(); 

//DATABASE CONNECTION
try {
    require_once '../DBConn/pdo_connect.php';
} catch (Exception $e) {
    $error = $e->getMessage();
}

// REGISTER PROVIDER
if (isset($_POST['admin_reg'])) {

    //RECEIVE INPUTS FROM FORM BY POST METHOD
    $username = $_POST['username'];
    $password = $_POST['pass'];

    // FORM VALIDATION - CORRECTLY FILLED
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }

    //IF THERE ARE NO ERROR, THEN ADMINISTRATOR WILL BE REGISTERED
    if (count($errors) == 0) {


        try{

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //INSERTING DATA TO ADMINISTRATORS TABLE IN BOOKING DATABASE
            //PASSWORD ENCRYPTED
            $sql= "INSERT INTO administrators (admin_user, admin_pass, privilege) 
            VALUES ('$username', SHA2('$password',512), '$privilege')";

            $db->exec($sql);

            $message = "Administrator has been CREATED!";

        }
        catch(PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }

        header('location: ../views/admin_created.php');
    }
}
?>

