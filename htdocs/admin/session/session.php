<?php
if(!isset($_SESSION["adminUid"])){
	header("location: ../index.php");
}

if(!isset($_SESSION['Ctrl_num'])){
	header("location: ../index.php");
}
?>