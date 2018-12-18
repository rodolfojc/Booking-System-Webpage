<?php
//CHECKING SESSION
session_start();
if(!isset($_SESSION['email']))
{
    header('location: ../index/index.php');
}
include '../layout/pro_nav.php';

// ARRAY TO BE USE IN SELECT INPUT FOR WORKING HRS
$hrs = array("8:00", "8:30", "9:00", "9:30", "10:00", "10:30",
             "11:00", "11:30", "12:00", "12:30", "13:00", "13:30",
             "14:00", "14:30", "15:00", "15:30", "16:00", "16:30",
             "17:00", "17:30", "18:00", "18:30", "19:00", "19:30");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Availability</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <div class="header">
            <h2>Availability</h2>
        </div>

        <form method="post" action="../DBConn/avai_pro_server.php">
            <div class="input-group" id="date">
                <label>Date</label>
                <!-- DATE SET AS MINIMUN CURRENT DAY-->  
                <input type="Date" name="date" id="datafield" min="<?php echo date('Y-m-d');?>";>
            </div>
            <div class="input-group" id="m_app">
                <label>Time</label>
                <!-- SELECT FOR HRS IN ARRAY HRS-->
                <?php 
                echo '<select name="hrs">';
                foreach($hrs as $select => $row){
                    echo '<option value=' . $row . '>' . $row . '</option>';
                }
                echo '</select>';
                ?>
            </div>

            <div class="input-group">
                <!-- BUTTON FOR POST IN AVAI_PRO_SERVER-->
                <button type="submit" class="btn" name="submit">Submit</button>
            </div>
        </form>

    </body>
</html>