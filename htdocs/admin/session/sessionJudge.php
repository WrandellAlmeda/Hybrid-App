<?php
include "./connection.php";
$connection=mysqli_connect($host,$user,$password,$db);
if(isset( $_SESSION['id'])){
		$sql = "SELECT * FROM judge WHERE id = '". $_SESSION['id']."'";
		$query_judge = mysqli_query($connection, $sql);
		$judge = $query_judge->fetch_assoc();

}else{
    header("location: ../judgeLogin.php");
}

if(!isset($_SESSION['firstname'])){
	header("location: ../judgeLogin.php");
}

if(!isset($_SESSION['lastname'])){
	header("location: ../judgeLogin.php");
}
?>