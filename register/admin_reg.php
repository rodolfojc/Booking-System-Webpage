<?php 
include('../DBConn/admin_reg_server.php');
include ('../layout/admin_nav.php'); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Customer Sign in</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <div class="header">
            <h2>Administrators registration</h2>
        </div>

        <form method="post" action="admin_reg.php">

            <?php include('../errors/errors.php'); ?>
           
            <div class="input-group">
                <label>Administrator Username (email)</label>
                <input type="text" name="username" value="<?php echo $username; ?>">
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="pass" value="<?php echo $password; ?>">
            </div>
            <div class="input-group">
                <!-- BUTTON FOR POST IN ADMIN_REG_SERVER.PHP-->
                <button type="submit" class="btn" name="admin_reg">Register</button>
            </div>
        </form>
    </body>
</html>