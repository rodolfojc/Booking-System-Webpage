<?php
		
        session_start();
		//CLOSE DE SESSION
        session_destroy();
		header("location: ../index/index.php");
?>