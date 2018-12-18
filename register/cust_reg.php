<?php
session_start();

//VARIABLE DECLARATION
$name = "";
$surname = "";
$email = "";
$mobile = "";
$address = "";

$errors = array(); 
$_SESSION['success'] = "";

//DATABASE CONNECTION
try {
    require_once '../DBConn/pdo_connect.php';
} catch (Exception $e) {
    $error = $e->getMessage();
}

// CUSTOMER REGISTRATION
if (isset($_POST['cust_reg'])) {
	
    //RECIEVE INPUTS VALUE FROM THE FORM METHOD POST
    
	$name = $_POST['name'];
	$surname = $_POST['surname'];
    $password = $_POST['password'];
	$email = $_POST['email'];
	$mobile= $_POST['mobile'];
    $address = $_POST['address'];
	
    //FORM VALIDATION - CORRECTLY FILLED
	
	if (empty($name)) { array_push($errors, "Name is required"); }
	if (empty($surname)) { array_push($errors, "Surname is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }
	if (empty($email)) { array_push($errors, "Email is required"); }
	if (empty($mobile)) { array_push($errors, "Mobile number is required"); }
	if (empty($address)) { array_push($errors, "Address is required"); }

	// IF THERE ARE NO ERROR, THEN THE CUSTOMER WILL BE REGISTERED
	if (count($errors) == 0) {
        
    try{
     
       $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
       //INSERTING DATA TO CUSTOMER TABLE IN BOOKING DATABASE
       $sql= "INSERT INTO customers (cust_name, cust_surname, mob_num, email, address, pass) 
       VALUES ('$name', '$surname', '$mobile', '$email', '$address', SHA2('$password',512))";
    
    $db->exec($sql);
    $message = " Your account has been created!";
    echo $message;
    }
    catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
    
    //QUERY TO GET THE CUSTOMER ID AFTER REGISTRATION
    //CUST_ID IS PRIMARY KEY AND AUTO INCREMENT IN CUSTOMERS TABLE 
    
    try{
     
       $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
       $sql= "SELECT cust_id FROM customers WHERE email='$email'";
    
    foreach ($db->query($sql) as $row) {
        
        //GETTING THE CUST_ID 
        $_SESSION['id'] = $row['cust_id'];
    }
    
    }
    catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }    
        
    }
        //SETTING UP DETAILS FOR SESSION
    	$_SESSION['name'] = $name;
        $_SESSION['surname'] = $surname;
		$_SESSION['email'] = $email;
		$_SESSION['mobile'] = $mobile;
        $_SESSION['role'] = "customer";
		
        //OPEN CUSTOMER HOME PAGE 
		header('location: ../views/cust_home.php');
	}



// LOGIN USER
if (isset($_POST['login_user'])) {
	
    //RECIEVE INPUT VALUES FOR LOGIN
    $email = $_POST['email'];
	$password = $_POST['password'];
    
    //FORM VALIDATION - CORRECTLY FILLED
	if (empty($email)) {
		array_push($errors, "Email is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	//RECEIVE TYPE OF USER
    $type = $_POST['type'];
	
    // FOR CUSTOMER 
    if ($type == 1) {

        if (count($errors) == 0) {
					
		$sql = "SELECT * FROM customers WHERE email ='$email' AND pass= SHA2('$password',512)";
                
		foreach ($db->query($sql) as $row) {
       
        //COUNT THE ARRAY TO CHECK IF THERE ARE DATA IN IT 
        $numrows = count($row);
        
        //IF THERE IS ONE OR MORE DATA IN ARRAY, THEN IT IS A MATCH
		if ($numrows >= 1) {
			$_SESSION['email'] = $email;
			$_SESSION['id'] = $row['cust_id'];
			$_SESSION['name'] = $row['cust_name'];
            $_SESSION['surname'] = $row['cust_surname'];
			$_SESSION['mobile'] = $row['mob_num'];
            $_SESSION['address'] = $row['address'];
			$_SESSION['role'] = "customer";
			header('location: ../views/cust_home.php');
		}else{
            // NO MATCH
			array_push($errors, "Wrong username/password combination");
		}
	}
    }
	}
    // FOR PROVIDERS, IT APPLIES THE SAME CODE
	elseif ($type == 2) {

		if (count($errors) == 0) {
					
		$sql = "SELECT * FROM providers WHERE email ='$email' AND pass= SHA2('$password',512)";
                
		foreach ($db->query($sql) as $row) {
      
        $numrows = count($row);
           
        if ($numrows >= 1 && $row['status']=="Confirmed") {
			$_SESSION['email'] = $email;
			$_SESSION['id'] = $row['pro_id'];
			$_SESSION['name'] = $row['pro_name'];
            $_SESSION['surname'] = $row['pro_surname'];
			$_SESSION['mobile'] = $row['mob_num'];
            $_SESSION['address'] = $row['address'];
			$_SESSION['location'] = $row['location'];
            $_SESSION['status'] = $row['status'];
            $_SESSION['reg_day'] = $row['reg_day'];
            $_SESSION['role'] = "provider";
            
            header('location: ../views/pro_home.php');
            
		}elseif ($numrows >= 1 && $row['status']=="Pending"){#
            
            header('location: ../views/pro_status_pending.php');
            
        }else {
			array_push($errors, "Wrong username/password combination");
		}
	}
	}
    }
    
    // FOR ADMINISTRATOR, IT APPLIES THE SAME CODE 
    elseif ($type == 3) {

		if (count($errors) == 0) {
					
		$sql = "SELECT * FROM administrators WHERE admin_user='$email' AND admin_pass= SHA2('$password',512)";
                
		foreach ($db->query($sql) as $row) {
      
        $numrows = count($row);
        echo $numrows; 
                
        if ($numrows >= 1) {
			$_SESSION['email'] = $email;
			$_SESSION['id'] = $row['admin_id'];
            $_SESSION['privilege'] = $row['privilege'];
			$_SESSION['role'] = "administrator";
                
			header('location: ../views/admin_home.php');
                      
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}
	}
    }
}

?>