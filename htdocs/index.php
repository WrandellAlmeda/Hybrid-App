<?php
session_start();
include 'connection.php';
$title = "ADMIN";

$data=mysqli_connect($host,$user,$password,$db);

if($data===false){
	die("connection error");
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
	$username=$_POST['username'];
	$password= md5($_POST['password']);

	$sql="select * from admin where username='".$username."' AND password='".$password."'";

	$result=mysqli_query($data,$sql);
	$row=mysqli_fetch_array($result);

	if($row["usertype"]=="user"){

		$_SESSION['username']=$username;
		header("location:student/index.php");
	}
	else if($row["usertype"]=="admin"){

		$_SESSION['adminUid']=$username;
		$_SESSION['Ctrl_num']=$row['CtrlNum'];
		$_SESSION['name_admin']=$row['fullname'];
		header("location:admin/home.php");

	}
	else{
		header("location:index.php?error=Incorrect User Name Or Password");
		exit();
	}

}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="../Sanfelipe/img/sanfelipe_logo.png">
	<script src="https://kit.fontawesome.com/a9c1005e87.js" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/newlogin.css">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	 <link rel="icon" type="image/x-icon" href="./img/sanfelipe_logo.png">
	<title>Login - <?php echo $title ?> </title>
</head>

<style>
	.choice{
		width: 100%;
	}
</style>
<body>

	<section  class="school-logo">
		<img src="img/sanfelipe_logo.png">
	</section>

	<section class="main">
		<div class="login-container">
		<p class="title">ADMIN</p>
		<div class="separator-line"></div>
		<p class="welcome-paragraph">A Hybrid Online Voting System </p>

		<?php if(isset($_GET['error'])) {?>
			<p class="error"><?php echo $_GET['error'] ?></p>
		<?php } ?>	
		<form action="#" method="Post" class="login-form">
		<div class="form-fields">
			<input type="text" name="username" required placeholder="Username">
			<i class="fa-regular fa-user"></i>
		</div>

		<div class="form-fields">
			<input type="password" name="password" required placeholder="password" id="myInput">
			<i class="fa-solid fa-eye-slash" id="lock" onclick="myFunction()"></i>
		</div>

			<input type="submit" name="Login" class="submit" value="Login">
		</form>

		<div class="separator-line"></div>

		<p style="color:#fff;">OR LOGIN AS</p>

		<div class="choice">
		<select name="formal" onchange="location = this.value;" class="form-select" width="100%">
		<option value="index.php" selected>Admin</option>
		<option value="studentLogin.php">Student</option>
		<option value="judgeLogin.php">Judge</option>
		</select>
			<!-- <a href="studentLogin.php" class="btn btn-outline-primary">Student</a> -->
			
		</div>
		</div>
	</section>

	
	<script type="text/javascript">
		
		function myFunction() {
		var x = document.getElementById("myInput");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
		}

	</script>

</body>
</html>