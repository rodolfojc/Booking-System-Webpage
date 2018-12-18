<?php include('../DBConn/pro_reg_server.php');
include ('../layout/nav_home.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Provider Sign in</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <div class="header">
            <h2>Providers<br>Sign in for FREE!</h2>
        </div>

        <form method="post" action="pro_reg.php" onsubmit="return checkform(this);">

            <?php include('../errors/errors.php'); ?>
            <!-- PROVIDERS REGISTRATION FORM-->
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
            <!-- MESSAGE THAT APPEARS WHEN THE USER IS TYPING THE PASSWORD-->
            <div id="message">
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
            <div class="input-group">
                <label>Location</label>
                <input type="location" name="location" value="<?php echo $location; ?>">
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
            <!-- BUTTON FOR POST IN PRO_REG_SERVER -->
            <button type="submit" class="btn" name="pro_reg">Register</button>
            </div>
        <p>
            Already a member? <a href="../register/register.php">Sign in</a>
        </p>
        </form>

     <!-- JAVACRIPTS FOR PASSWORD AND CATCHA VALIDATIONS-->
    <script type="text/javascript" src="../js/passwordVal.js"></script>
    <script type="text/javascript" src="../js/catcha.js"></script>


    </body>
</html>