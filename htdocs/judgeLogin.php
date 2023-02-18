<?php
session_start();
include 'connection.php';
$title = "JUDGE";

$data=mysqli_connect($host,$user,$password,$db);

if($data===false){
	die("connection error");
}

if(isset($_POST['Login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];


    if(empty($username) || empty($password)){
        header("location: judgeLogin.php?error=emptyfields");
        exit();
    }else{
        $sql = "SELECT * FROM judge WHERE id=? OR email=?;";
        $statement = mysqli_stmt_init($data);
        if(!mysqli_stmt_prepare($statement, $sql)){
            header("location: judgeLogin.php?error=sqlError");
            exit();
        }else{
            mysqli_stmt_bind_param($statement, "ss", $username, $username);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);

            if($row = mysqli_fetch_assoc($result)){
                $passwordCheck = password_verify($password, $row['password']);
                if($passwordCheck == false){
                    header("location: judgeLogin.php?error=wrong password");
                    exit();
                }else if($passwordCheck == true){
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['firstname'] = $row['first_name'];
                        $_SESSION['lastname'] = $row['last_name'];
                        $_SESSION['judge_uid'] = $row['email'];
						header("location: admin/judge_home.php?login=success");
                        exit();   
                }else{
                    header("location: judgeLogin.php?error=Wrong Password");
                    exit();
                }

            }else{
                header("location: judgeLogin.php?error=No User Found");
                exit();
            }
        }
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
		<p class="title">JUDGE</p>
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
		<option value="index.php">Admin</option>
		<option value="studentLogin.php">Student</option>
		<option value="judgeLogin.php" selected>Judge</option>
		</select>
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