<?php
include "./connection.php";
$connection=mysqli_connect($host,$user,$password,$db);
if(isset( $_SESSION['lrn'])){
		$sql = "SELECT * FROM userlogin WHERE LRN = '". $_SESSION['lrn']."'";
		$query_voter = mysqli_query($connection, $sql);
		$voter = $query_voter->fetch_assoc();

}else{
		header("location: ../studentLogin.php");
}
?>