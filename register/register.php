<?php 
include('../register/cust_reg.php');
include ('../layout/nav_home.php'); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Customer Sign in</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <div class="header">
            <h2>Customers<br>Sign in for FREE</h2>
        </div>

        <form method="post" action="register.php" onsubmit="return checkform(this);">

            <?php include('../errors/errors.php'); ?>
            <p>
                <!-- LINK FOR PROVIDERS REGISTRATION-->
                Are you a provider? <a href="pro_reg.php">Register here</a>
            </p>

            <div class="input-group">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $name; ?>">
            </div>
            <div class="input-group">
                <label>Surname</label>
                <input type="text" name="surname" value="<?php echo $surname; ?>">
            </div>
            <div class="input-group">
                <label>Password</label>
                <!-- PATTERN IS SET TO VALIDATE PASSWORD-->
                <input type="password" name="password" id="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,12}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
            </div>
            <div id="message">
                <!-- MESSAGE THAT APPEARS WHEN THE USER IS TYPING THE PASSWORD-->
                <h3>Password must contain the following:</h3>
                <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                <p id="number" class="invalid">A <b>number</b></p>
                <p id="length" class="invalid">Minimum <b>8 up to 12 characters</b></p>
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $email; ?>">
            </div>
            <div class="input-group">
                <label>Mobile</label>
                <input type="mobile" name="mobile" value="<?php echo $mobile; ?>">
            </div>
            <div class="input-group">
                <label>Address</label>
                <input type="address" name="address" value="<?php echo $address; ?>">
            </div>
            <!-- START CAPTCHA -->
            <br>
            <div class="capbox">
                <div id="CaptchaDiv"></div>
                <div class="capbox-inner">
                    Type the above number:<br>
                    <input type="hidden" id="txtCaptcha">
                    <input type="text" name="CaptchaInput" id="CaptchaInput" size="15"><br>
                </div>
            </div>
            <br><br>
            <!-- END CAPTCHA -->   
            <div class="input-group">
                <button type="submit" class="btn" name="cust_reg">Register</button>
            </div>
            <p>
                Already a member? <a href="../views/login.php">Login</a>
            </p>
        </form>
        <!-- JAVACRIPTS FOR PASSWORD AND CATCHA VALIDATIONS-->
        <script type="text/javascript" src="../js/passwordVal.js"></script>
        <script type="text/javascript" src="../js/catcha.js"></script>

    </body>
</html>