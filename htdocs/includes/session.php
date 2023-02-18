<?php
	
	session_start();
    include 'connection.php';
    $conn=mysqli_connect($host,$user,$password,$db);

	if(isset($_SESSION['voter'])){
		$sql = "SELECT * FROM userlogin WHERE username = '".$_SESSION['voter']."'";
		$query = $conn->query($sql);
		$voter = $query->fetch_assoc();
	}
	else{
		header('location: ./studenLogin.php');
		exit();
	}

?>