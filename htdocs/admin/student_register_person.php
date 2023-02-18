<?php
  session_start();
  $title = 'Student';
  include 'include/headerStudent.php';
  include "connection.php";
  include 'session/sessionStudent.php';
$data=mysqli_connect($host,$user,$password,$db);


if($data===false){
	die("connection error");
}
?>

<style type="text/css">
	*{
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	
}

.login-container{
	margin-top: 12px;
}
	
.main{
	max-width: 750px;
	margin: auto;
	height: 100vh;
	font-family: 'Poppins', sans-serif;
	color: #333;
}

.separator-line{
	width: 80%;
	margin: auto;
	height: 4px;
	background-image: linear-gradient(to right, #8b33c5, #15a0e1);
	margin-bottom: 12px ;
}	

.login-form{

	width: 80%;
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;
	margin: auto;
}	
.form-fields{
	width:80%;
	position: relative;
	margin-bottom: 12px;

}

input{
	border: none;
	outline: none;
	border-radius: 30px;
	font-size: 1.1em;
}

input{
	width: 100%;
	background: #e6e6e6;
	color: #333;
	letter-spacing: 0.5px;
	padding: 8px 64px;
}

select{
	border: none;
	outline: none;
	border-radius: 30px;
	font-size: 1.1em;
}

select{
	width: 100%;
	background: #e6e6e6;
	color: #333;
	letter-spacing: 0.5px;
	padding: 8px 64px;
	padding-right: 10px;
}

select ~ i {
	position: absolute;
	left: 32px;
	top: 50%;
	transform: translateY(-50%);
	color: #888;
	transition: color 0.4s;
}

select:focus ~ i{
	color: blue;
}


input ~ i {
	position: absolute;
	left: 32px;
	top: 50%;
	transform: translateY(-50%);
	color: #888;
	transition: color 0.4s;
}

input:focus ~ i{
	color: blue;
}

input.submit{
	color: #fff;
	padding: 14px 64px;
	width: 32px auto;
	text-transform: uppercase;
	letter-spacing: 2px;
	font-weight: bold;
	background-image: linear-gradient(to right, #8b33c5, #15a0e1);
	cursor: pointer;
	transition: opacity 0.4s ease; 
}

input.submit:hover{
	transition: 0.4s ease;
	opacity: 0.7;
}

.center-search-form{
	margin: auto;
}

.d-flex{
	margin: auto;
}

.no-record{
	width: 100%;
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
}

.no-record img{
	width: 50%;
}

@media (max-width: 780px){
	.main{
		padding: 1em;
	
	}
	.validate{
		display:flex;
		flex-direction: column;
	}
}


</style>
<body>

	<section class="main">
		<center class="card mt-5 card-header bg-secondary text-white">
		<h4>ADD VOTER</h4>
		</center>
		<div class="login-container card">

		<div class="card-body">
		<form action="student_register_person.php" method="GET" class="form-fields center-search-form">
			<div class="d-flex flex-row justify-content-center validate">

				<div class="p-1">
					<input type="number" name="Search_LRN" value="<?php if(isset($_GET['Search_LRN'])){echo $_GET['Search_LRN'];}?>" class="form-control"placeholder="LRN">
				</div>
				
				<div class="p-1">
				<button type="submit" class="btn btn-primary">Verify</button>
				</div>
			
			</div>
		</form>
		</div>


		<div class="login-container">
			<hr>
		<?php

		$data=mysqli_connect($host,$user,$password,$db);

			if (isset($_GET['Search_LRN'])) {
				$lrn_info = $_GET['Search_LRN'];

                $query_lrn = "SELECT * FROM userlogin where LRN = '$lrn_info' LIMIT 1";
                $query_check = mysqli_query($data,$query_lrn);


				$queryLrn = "SELECT * FROM student_info where LRN='$lrn_info' LIMIT 1";
				$query_run = mysqli_query($data,$queryLrn);
                
                if(mysqli_num_rows($query_check)){
                   ?>   
                   <?php foreach($query_check as $row){?>
                        <center>
                        <p>Data of <strong><?php echo $row['fullname'];?></strong> is already existing</p>
                        </center>
                    <?php }?>
                   <?php
                }
				elseif(mysqli_num_rows($query_run) > 0){


					echo "<script>
					let timerInterval
					Swal.fire({
						title: 'LRN FOUND!',
						html: 'Directing in <b></b>.',
						timer: 2000,
						timerProgressBar: true,
						didOpen: () => {
							Swal.showLoading()
							const b = Swal.getHtmlContainer().querySelector('b')
							timerInterval = setInterval(() => {
								b.textContent = Swal.getTimerLeft()
							}, 100)
						},
						willClose: () => {
							clearInterval(timerInterval)
						}
					})
				</script>";

					foreach ($query_run as $row) {
						?>

						<form action="crudFunctionsStudent.php" method="post" class="login-form">
						<div class="separator-line"></div>

					<div class="form-fields">
						<input type="number" name="LRN" value="<?= $row['LRN'];?>" required placeholder="LRN">
						<i class="fa-solid fa-id-card"></i>
					</div>

					<div class="form-fields">
						<input type="text" name="name" value="<?= $row['NAME'];?>"required placeholder="Full Name">
						<i class="fa-regular fa-user"></i>
					</div>

					<div class="form-fields">
					<input type="text" name="grade" value="<?= $row['GRADE'];?>" required placeholder="Grade" readonly>
						<i class="fa-solid fa-person-chalkboard"></i>
					</div>

					<div class="form-fields">
						<!-- <input type="text" name="section" required placeholder="Section"> -->
						<input type="text" name="section" value="<?= $row['SECTION'];?>"required placeholder="Section" readonly>
						<i class="fa-solid fa-id-badge"></i>
					</div>

					<div class="form-fields">
						<!-- <input type="text" name="section" required placeholder="Section"> -->
						<input type="text" name="gender" value="<?= $row['SEX'];?>"required placeholder="Gender" readonly>
						<i class="fa-solid fa-venus-mars"></i>
					</div>

					<div hidden class="form-fields">

						<select name="user-type" required>
							<optgroup label="Select User types">
							<option value="user" selected>user</option>
							<option value="admin" disabled>admin</option>
							</optgroup>	
						</select>
						<i class="fa-solid fa-user"></i>
					</div>
					<div class="form-fields">
						<input type="email" name="username" required placeholder="Username">
						<i class="fa-solid fa-envelope"></i>
					</div>

					<div class="form-fields" hidden>
						<input type="password" name="password" value="<?= $row['LRN'];?>" required placeholder="password" id="password" readonly>
						<i class="fa-solid fa-lock" id="lock" onclick="toggle()"></i>
					</div>

					<div class="form-fields">
						<input type="submit" name="register" class="submit" value="Register">
			
					</div>
					</form>
				<?php
					}

				}else{
					?>
					<div class="no-record">
						<img src="assets/no-record.gif" alt="">
						<div><p class="text-muted">No Record Found</p></div>
					</div>
					<?php
				}
			}

		?>
			
		</div>
			</section>

	<?php include "footer.php";?>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>
</html>