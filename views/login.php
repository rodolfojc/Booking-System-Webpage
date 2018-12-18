<?php 

//PHP CODE FOR REGISTRATION IN DATABASE
include('../register/cust_reg.php');
include ('../layout/nav_home.php'); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Log In</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <div class="header">
            <h2>Login</h2>
        </div>
        <!-- LOGIN FORM-->
        <form method="post" action="login.php">

            <!-- ERRORS VALIDATION FOR INPUTS -->
            <?php include('../errors/errors.php'); ?>

            <div class="input-group" id="email">
                <label>Email</label>
                <input type="text" name="email" >
            </div>
            <div class="input-group">
                <label> Login As:</label>
                <select name="type">
                    <option value="1">Customer</option>
                    <option value="2">Provider</option>
                    <option value="3">Admin</option>
                </select>
            </div>

            <div class="input-group" id="password">
                <label>Password</label>
                <input type="password" name="password">
            </div>
            <div class="input-group">
                <!-- BUTTON FOR POST CUST_REG.PHP -->
                <button type="submit" class="btn" name="login_user">Go</button>
            </div>
            <p>
                <!-- LINK TO REGISTRATION PAGE CUSTOMER -->
                Not yet a member? <a href="../register/register.php">Register</a>
            </p>
        </form>

    </body>
</html>