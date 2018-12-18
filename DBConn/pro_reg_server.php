<?php
session_start();

// VARIABLE DECLARATION
$name = "";
$surname = "";
$email = "";
$mobile = "";
$address = "";
$location = "";
$status = "";

$errors = array(); 
$_SESSION['success'] = "";

//DATABASE CONNECTION
try {
    require_once '../DBConn/pdo_connect.php';
} catch (Exception $e) {
    $error = $e->getMessage();
}

// REGISTER PROVIDER
if (isset($_POST['pro_reg'])) {
	
    //RECEIVE INPUTS FROM FORM BY POST METHOD
	$name = $_POST['name'];
	$surname = $_POST['surname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $location = $_POST['location'];
    $password = $_POST['password'];
    $status = 'Pending'; 
    $reg_day = '';
   
    
	// FORM VALIDATION - CORRECTLY FILLED
	if (empty($name)) { array_push($errors, "Name is required"); }
    if (empty($surname)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($mobile)) { array_push($errors, "Mobile is required"); }
	if (empty($address)) { array_push($errors, "Address is required"); }
    if (empty($location)) { array_push($errors, "location is required"); }
	if (empty($password)) { array_push($errors, "Password is required"); }
	
	//IF THERE ARE NO ERROR, THEN PROVIDER WILL BE REGISTER
	if (count($errors) == 0) {
		
        	
    try{
     
       $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
       //INSERTING DATA TO PROVIDERS TABLE IN BOOKING DATABASE
       $sql= "INSERT INTO providers (pro_name, pro_surname, mob_num, email, address, location, pass, status, reg_day) 
       VALUES ('$name', '$surname', '$mobile', '$email', '$address', '$location', SHA2('$password',512), '$status', CURDATE())";
            
        $db->exec($sql);
        
        $message = "$name $surname, your account has been created as a Provider!";
        echo $message;
            
		}
        catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
        }
        
    //QUERY TO GET THE PROVIDER ID AFTER REGISTRATION
    //PRO_ID IS PRIMARY KEY AND AUTO INCREMENT IN PROVIDERS TABLE
    try{
     
       $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
       $sql= "SELECT pro_id, reg_day FROM providers WHERE email='$email'";
    
        foreach ($db->query($sql) as $row) {
        
        //GETTING PROVIDER ID AND DAY OF REGISTRATION
        $_SESSION['id'] = $row['pro_id'];
        $_SESSION['reg_day'] = $row['reg_day'];
    }
    
    }
    catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }    
        //SETTING A PROVIDER SESSION
        $_SESSION['name'] = $name;
        $_SESSION['surname'] = $surname;
        $_SESSION['mobile'] = $mobile;
		$_SESSION['email'] = $email;
		$_SESSION['address'] = $address;
		$_SESSION['location'] = $location;
        $_SESSION['status'] = $status;
        $_SESSION['role'] = "provider";
        
        //OPEN PROVIDER HOME PAGE
        header('location: ../views/pro_home.php');
    }
}