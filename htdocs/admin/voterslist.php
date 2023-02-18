 <?php
session_start();
$title = 'List Of Voters';
include "connection.php";
include "session/session.php";
require 'include/headerAdmin.php';
$conn=mysqli_connect($host,$user,$password,$db);


if(isset($_POST["import"])){
			$fileName = $_FILES["excel"]["name"];
			$fileExtension = explode('.', $fileName);
      $fileExtension = strtolower(end($fileExtension));
			$newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

			$targetDirectory = "uploads/" . $newFileName;
			move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

			error_reporting(0);
			ini_set('display_errors', 0);

			require 'excelReader/excel_reader2.php';
			require 'excelReader/SpreadsheetReader.php';

			$reader = new SpreadsheetReader($targetDirectory);
			foreach($reader as $key => $row){
				$lrn = $row[0];
				$name = $row[1];
				$sex = $row[2];
				$grade = $row[3];
				$section = $row[4];
				$age = $row[5];
				$sy = $row[6];
				$insert_excel = mysqli_query($conn, "INSERT INTO student_info VALUES($lrn, '$name', '$sex', $grade, '$section', $age, '$sy')");

				if($insert_excel){
					echo
					"
					<script>
					alert('Succesfully Imported');
					document.location.href = '';
					</script>
					";
				}else{
					echo
						"
						<script>
						alert('Error, Please try again!');
						document.location.href = '';
						</script>
						";
				}
			}

			
		}


// $limit = 500;  
// if (isset($_GET["page"])) {
// 	$page  = $_GET["page"]; 
// 	} 
// 	else{ 
// 	$page=1;
// 	};  
// $start_from = ($page-1) * $limit;  
$result = mysqli_query($conn,"SELECT * FROM userlogin ORDER BY CtrlNum DESC");

// if (isset($_POST['search'])) {
// 	$searchField = $_POST['searchField'];
// 	$result=mysqli_query($conn,	"SELECT * FROM userlogin WHERE CONCAT(`LRN`, `fullname`, `section`, `grade`, `usertype`) LIKE '%".$searchField."%'");
// }
?>

<style type="text/css">

	.table-container{
		max-width: 1200px;
		min-height: 100vh;
		margin: 40px auto 0;
		font-family: 'Poppins', sans-serif;
		height: 100%;
		margin-bottom: 3em;
	}
    .alert1{
	background: green;
	color: #fff;
    padding-left: 1.5em;
	width: 100%;
	text-align: left;
    border-radius: 15px;
	}

    .message{
        padding-top: .5em;
        font-size: 20px;
        font-weight: bold;
        text-decoration: italic;
    }

    .message-success{
        padding-top: .5em;
        font-size: 20px;
        font-weight: bold;
        text-decoration: italic;
    }

	/* .alert strong{
		text-decoration: underline;
        text-transform: uppercase;
	} */

    .actual-message{
        font-size: 14px;
        padding-left: 1.5em;
    }

    .message-added{
        font-size: 14px;
        padding-left: 1.5em;
        padding-bottom: 1em;
    }

	#success-msg {
 	 opacity: 1;
  	transition: 3s ease opacity;
	}

	th{
		text-align: center;
		font-size: 14px;
	}

	td{
		font-size: 12px;
	}

	.flex-search{
		display: flex;
		flex-direction: row;
		justify-content: space-between;

	}

	.table1{
		height: 60vh;
		overflow-x:auto;
	}

	.float-right{
			display: flex;
			flex-direction: row;
			width: 100%;
	}

	.float-right form{
		margin-right: 1em;
	}

	.float-left a{
		padding: 12px;
		text-decoration: none;
		font-weight: bold;
		font-size: 12px;
		border-radius: 12px;
		color: #fff;
	}

	.form-update{
		font-family: 'Poppins', sans-serif;
		
	}

	.separator-line{
	width: 100%;
	height: 4px;
	background-image: linear-gradient(to right, #8b33c5, #15a0e1);
	margin-top: 20px;
	}

	tr:nth-child(even) {background-color: #f2f2f2;}

	thead{
		background-color: #333;
		color: #fff;
	}

	input{
	width: 100%;
	background: #fff;
	color: #333;
	padding-left: 10px;
	letter-spacing: 0.5px;
	padding-left: 1em;
	}

	.form-fields{
	width: 100%;
	position: relative;
	}

	input ~ i {
	position: absolute;
	right: 10px;
	top: 50%;
	transform: translateY(-50%);
	color: #888;
	transition: color 0.4s;
	}

.button-press{
	margin: 3px;
}


.flex-column{
	display: flex;
	flex-direction: row;

}

.float-center{
	display: flex;
	flex-direction: row;
}

.disabled{
	cursor: not-allowed;
}

input:focus ~ i{
	color: blue;
}

.sections{
	max-width: 30%;
}

.page-item{
	padding: 3px;
}
	.page-title{
		text-align: center;
		padding-bottom: 2em;
	}

	.candidates_pos{
		margin-top: 1em;
    padding: .5em;
    border-left: 2px solid blue;
    background: #eee;
}

.percentage{
	font-size: 14px;
	background: #fff;
	color: green;
	border-radius: 20px;
	padding: 8px;
	margin: auto;
}

.percentage-unverified{
	font-size: 14px;
	background: #fff;
	color: red;
	border-radius: 20px;
	padding: 8px;
	margin: auto;
}
	@media (max-width: 780px){
	.table-container{
		width:100%;
		height: 100%;
		padding: 12px;
		
	}

	th{
		text-align: center;
		font-size: 12px;
	}

	.table1{
		overflow-x:auto;
	}

	.flex-search{
		display: flex;
		flex-direction: column;
	}

	.float-left{
		margin-top: 10px;
		margin-bottom: 10px;
	}

	.float-right{
		margin-top: 10px;
	}

	a{
		margin-top: 10px;

	}
	.disabled{
	cursor: not-allowed;
	}
	.sections{
	max-width: 100%;
}
}
</style>
<body>

<div class="modal" id="import" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Import Excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form class="" action="" method="post" enctype="multipart/form-data">
			<input type="file" name="excel" required value="">
		
      </div>
      <div class="modal-footer">
        <button type="submit" name="import" class="btn btn-primary">Save changes</button>
        <button  class="btn btn-secondary" data-dismiss="modal">Close</button>
		</form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deletemodal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
			<h4 class="modal-title" style="color:#dc3545;">WARNING!!!!</h4>
          
        </div>

		<form action="crudFunctions.php" method="post">
		<div class="modal-body input-group mb-3">
			<p>Are you sure, want to delete this data?</p>
			<input type="text" name="view_id" id="view_id" hidden>

			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="lrn1">LRN</span>
			</div>
			<input type="text" class="form-control input-group-text disabled" name="lrn" id="lrn" aria-describedby="lrn1" readonly>
			</div>


			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">NAME</span>
			</div>
			<input type="text" class="form-control input-group-text disabled"  name="name" id="name" aria-describedby="basic-addon1" readonly>
			</div>

			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">GRADE</span>
			</div>
			<input type="text" class="form-control"  name="grade" id="grade" aria-describedby="basic-addon1" readonly>
			</div>


			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">SECTION</span>
			</div>
			<input type="text" class="form-control"  name="section" id="section" aria-describedby="basic-addon1" readonly>
			</div>


			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">EMAIL</span>
			</div>
			<input type="text" class="form-control" name="username" id="username" aria-describedby="basic-addon1" readonly>
		</div>
        </div>
       
		<div class="modal-footer">
		<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-danger" name="delete">Yes, Delete it!</button>
        
		</div>
	  </form>

</div>
      
    </div>
  </div>
</div>


<div class="modal fade" id="editmodal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
    
      <div class="modal-content">
        <div class="modal-header">
			<h4 class="modal-title">Update Student Information</h4>
          
        </div>
		<div class="modal-body form-update">
			<form action="crudFunctions.php" method="post">
			<input type="text" name="view_id" id="view_id1" hidden>

			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">LRN</span>
			</div>
			<input type="text" class="form-control input-group-text disabled" name="lrn" id="lrn2" aria-describedby="basic-addon1" readonly required>
			</div>


			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">NAME</span>
			</div>
			<input type="text" class="form-control input-group-text disabled"  name="name" id="name1" aria-describedby="basic-addon1" readonly  required>
			</div>

			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">GRADE</span>
			</div>
			<input type="text" class="form-control"  name="grade" id="grade1" aria-describedby="basic-addon1"  required>
			</div>


			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">SECTION</span>
			</div>
			<input type="text" class="form-control"  name="section" id="section1" aria-describedby="basic-addon1"  required>
			</div>


			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">EMAIL</span>
			</div>
			<input type="text" class="form-control" name="username" id="username1" aria-describedby="basic-addon1"   required>
		</div>

<!-- 
		<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">PASSWORD</span>
			</div>
			<input type="password" class="form-control"  name="password" aria-describedby="basic-addon1" required>
		</div>
			 -->
		
			
			<div class="modal-footer">
			<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-danger" name="update">Update</button>
			</div>
			</form>
        </div>

</div>
	     
    </div>
  </div>
</div>


<div class="modal fade" id="officermodal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
    
      <div class="modal-content">
        <div class="modal-header">
			<h5 class="modal-title">ADD AS STAFF</h5>
          
        </div>
		<div class="modal-body form-update">
			<form action="crudFunctions.php" method="post">

			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">LRN</span>
			</div>
			<input type="text" class="form-control input-group-text disabled" name="lrn" id="lrn_officer" aria-describedby="basic-addon1" readonly required>
			</div>

			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">NAME</span>
			</div>
			<input type="text" class="form-control input-group-text disabled" name="name" id="name_officer" value="Add as officer" aria-describedby="basic-addon1" readonly required>
			</div>

	
			<div class="modal-footer">
			<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary" name="add_as_officer">Add</button>
			</div>
			</form>
        </div>

</div>
	     
    </div>
  </div>
</div>

<div class="modal fade" id="reset_pass" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
			<h4 class="modal-title">Reset Password</h4>
    </div>
		<form action="crudFunctions.php" method="post">
		<div class="modal-body input-group mb-3">


		<input type="hidden" class="form-control" name="lrn" id="reset_lrn">
		<input type="hidden" class="form-control" name="email" id="reset_email">
		<input type="hidden" class="form-control" name="name" id="reset_name">

		<h5>Are you sure?</h5>
	
		<p style="text-align: center; padding: 5px;">The password of this voter will set to its default password!</p>

      </div>

		<div class="modal-footer">
		<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary" name="reset_default">Confirm</button>
        
		</div>
	  </form>

</div>
      
    </div>
  </div>
</div>


	<div class="table-container">
		<?php
			//Add Student
			if(isset($_GET['added'])){
			
				$added = $_GET['added'];
			echo "
			<script>
				Swal.fire(
				'Success!',
				'<b>".$added."</b><br> has been successfully added',
				'success'
				)
			</script>
			
			";
			unset( $_GET['added']);
		}
		//Update Student
		if(isset($_GET['success'])){
			
			$added = $_GET['success'];
		echo "
		<script>
			Swal.fire(
			'Update Complete!',
			'<b>".$added."</b> <br>has been successfully updated',
			'success'
			)
		</script>
		
		";
		unset( $_GET['success']);
		}

		if(isset($_GET['success_officer'])){
			
			$added = $_GET['success_officer'];
		echo "
		<script>
			Swal.fire(
			'Success!',
			'".$added."',
			'success'
			)
		</script>
		
		";
		unset( $_GET['success_officer']);
		}

		//Error handling
		if(isset($_GET['error'])){
			
			$added = $_GET['error'];
		echo "
		<script>
			Swal.fire(
			'Update Complete!',
			'<b>".$added."</b> <br>is already exists!',
			'error'
			)
		</script>
		
		";
		unset( $_GET['error']);
		}

		if(isset($_GET['error_officer'])){
			
			$added = $_GET['error_officer'];
		echo "
		<script>
			Swal.fire(
			'Error!',
			'".$added."',
			'error'
			)
		</script>
		
		";
		unset( $_GET['error_officer']);
		}

		//Error Delete
		if(isset($_GET['deleted'])){
			
			$added = $_GET['deleted'];
		echo "
		<script>
			Swal.fire(
			'Success!',
			'<b>".$added."</b> <br>has been Removed!',
			'success'
			)
		</script>
		";
		unset( $_GET['deleted']);
		}


		?>
		<!-- <h1 class="page-title">Voters List</h1> -->

			<div id="Page1">
			<div class="flex-search">

<div class="float-left">
	<a class="btn btn-primary" href="addStudent.php"><i class="fa-solid fa-plus"></i> Voter</a>
	<a href="#" class="btn btn-primary" onclick="return show('Page2','Page1');"><i class="fa-solid fa-users"></i> Show Enrolled Student</a>
	
</div>

<div class="float-center">

<?php include "filter.php";?>
<div class="float-right">
	<div>
	<form action="" method="post">
			<!--onchange="javascript:handleSelect(this)"-->
		<select style="text-transform: uppercase;" name="selection" class="form-select" aria-label="Default select example" onchange='if(this.value != 0) { this.form.submit(); }'>
				<option <?php if(isset($_POST['selection'])){$choice = $_POST['selection']; if($choice == 'all'){ echo "selected";}else{echo "";}}?> value="all">All Voters</option>
				<optgroup label="Senior High">
					<option <?php if(isset($_POST['selection'])){$choice = $_POST['selection']; if($choice == 'TVL'){ echo "selected";}else{echo "";}}?> value="TVL">TVL</option>
					<option	<?php if(isset($_POST['selection'])){$choice = $_POST['selection']; if($choice == 'GAS'){ echo "selected";}else{echo "";}}?> value="GAS">GAS</option>
				</optgroup>
				<optgroup label="Grade 10">
					<option <?php if(isset($_POST['selection'])){$choice = $_POST['selection']; if($choice == 'SAPPHIRE'){ echo "selected";}else{echo "";}}?> value="SAPPHIRE">SAPPHIRE</option>
					<option <?php if(isset($_POST['selection'])){$choice = $_POST['selection']; if($choice == 'DIAMOND'){ echo "selected";}else{echo "";}}?> value="DIAMOND">DIAMOND</option>
				</optgroup>
				<optgroup label="Grade 9">
					<option <?php if(isset($_POST['selection'])){$choice = $_POST['selection']; if($choice == 'RIZAL'){ echo "selected";}else{echo "";}}?> value="RIZAL">RIZAL</option>
					<option <?php if(isset($_POST['selection'])){$choice = $_POST['selection']; if($choice == 'BONIFACIO'){ echo "selected";}else{echo "";}}?> value="BONIFACIO">BONIFACIO</option>
				</optgroup>
				<optgroup label="Grade 8">
					<option <?php if(isset($_POST['selection'])){$choice = $_POST['selection']; if($choice == 'LEMON'){ echo "selected";}else{echo "";}}?> value="LEMON">LEMON</option>
					<option <?php if(isset($_POST['selection'])){$choice = $_POST['selection']; if($choice == 'MANGO'){ echo "selected";}else{echo "";}}?> value="MANGO">MANGO</option>
				</optgroup>
				<optgroup label="Grade 7">
					<option <?php if(isset($_POST['selection'])){$choice = $_POST['selection']; if($choice == 'SAMPAGUITA'){ echo "selected";}else{echo "";}}?> value="SAMPAGUITA">SAMPAGUITA</option>
					<option <?php if(isset($_POST['selection'])){$choice = $_POST['selection']; if($choice == 'GUMAMELA'){ echo "selected";}else{echo "";}}?> value="GUMAMELA">GUMAMELA</option>
				</optgroup>
		</select>
	</div>
	</form>

	<div>
	<input class="form-control" id="myInput" type="text" placeholder="Search..">
	</div>
	</div>

	
	
</div>

</div>
			<?php
			$count_student = mysqli_query($conn, "SELECT COUNT(*) FROM userlogin WHERE usertype='user'");
			$count_unregistered = mysqli_query($conn, "SELECT COUNT(*) FROM student_info");

			while($row_count = mysqli_fetch_array($count_student)){
				$all_count = $row_count['COUNT(*)'];
			}
			while($row_un = mysqli_fetch_array($count_unregistered)){
				$all_un = $row_un['COUNT(*)'];
			}
			$percentage = $all_count / $all_un;
			$g_total = $percentage * 100;
			$last_na = number_format($g_total, 2);

			$percentage2 = $all_un / $all_count;
			$gg_total = $percentage2 * 100;

			$last_na_part2 = number_format($gg_total, 2);
			
			$count_unverified = $all_un - $all_count;
			?>
			<h3 class="candidates_pos">Registered Student Voters <span class="percentage"><?php echo "Verified: ".$all_count;?></span> <span class="percentage-unverified"><?php echo "Unverified: ".$count_unverified;?></span> <span class="percentage"><?php echo $last_na."% Already Registered";?></span> </h3>
		<div class="separator-line"></div>
		<div class="table1">
		<table class="table table-hover">
			<caption>List of users</caption>
		<thead>
			<tr>
				<th>Ctrl #</th>
				<th>QR Code</th>
				<th>LRN</th>
				<th>Name</th>
				<th>Email Address</th>
				<th>Grade</th>
				<th>Section</th>
				<th>Role</th>
				<th>Actions</th>
				<th hidden>Password</th>
			</tr>
		</thead>
		<tbody  id="myTable">
			<?php
			if(empty($result)){
				echo "<tr>";
				echo "<td><center> NO RECORDS</center></td>";
				echo "</tr>";
			}else{
		while($row=mysqli_fetch_array($result)){?>
			<tr>
				<td><?php echo $row['CtrlNum']?></td>
				<td><img src="<?php echo $row['qr_code']?>" width="50px" height="50px"></td>
				<td><?php echo $row['LRN']?></td>
				<td><?php echo $row['fullname']?></td>
				<td><?php echo $row['username']?></td>
				<td style="text-transform: uppercase;"><?php echo $row['grade']?></td>
				<td style="text-transform: uppercase;"><?php echo $row['section']?></td>
				<td><?php echo $row['usertype']?></td>
				<td hidden><?php echo $row['password']?></td>
				
				<td>
					<div class="d-flex justify-content-between space-button">

						<div class="button-press">
						<a class="btn btn-sm btn-outline-secondary reset_pass" data-toggle="modal" data-target="#reset_pass" data-placement="bottom" title="Reset Password"><i class="fa-solid fa-lock-open"></i></a>
						</div>

						<div class="button-press">
						<a class="btn btn-sm btn-outline-secondary edit_btn" data-toggle="modal" data-target="#editmodal" data-placement="bottom" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
						</div>

						<div class="button-press">
						<a class="btn btn-sm btn-outline-secondary" href="user_log.php?lrn=<?php echo $row['LRN'];?>"  data-toggle="tooltip" data-placement="bottom" title="Logs"><i class="fa-solid fa-globe"></i></a>
						</div>

						<div class="button-press">
						<a class="btn btn-sm btn-outline-secondary officer_btn" data-toggle="modal" data-target="#officermodal" data-placement="bottom" title="Add as Staff"><i class="fa-solid fa-user-group"></i></a>
						</div>

						<div class="button-press">
						<a class="btn btn-sm btn-outline-secondary" data-toggle="tooltip" data-placement="bottom" title="View" href="view.php?ii=<?php echo $row['CtrlNum']; ?>&qr=<?php echo $row['qr_code'];?>&numlrn=<?php echo $row['LRN'];?>&fname=<?php echo $row['fullname'];?>&grade=<?php echo $row['grade'];?>&section=<?php echo $row['section'];?>&uname=<?php echo $row['username']?>&pword=<?php echo $row['password']?>"><i class="fa-solid fa-eye"></i></a>
						</div>

						<div class="button-press">
						<a class="btn btn-sm btn-outline-danger delete_btn" data-toggle="modal" data-target="#deletemodal" data-placement="bottom" title="Delete"><i class="fa-solid fa-trash-can "></i></a>
						</div>
					
					</div>
				</td>
			</tr>
		<?php }
		} ?>
		</tbody>
	</table>
	</div>
	<div class="separator-line"></div>
			
		</div>

		
			<div id="Page2" style="display:none">
			<div class="flex-search">

<div class="float-left">
	<a class="btn btn-primary" href="addStudent.php"><i class="fa-solid fa-plus"></i> Voter</a>
	<a href="#" class="btn btn-primary" onclick="return show('Page1','Page2');"><i class="fa-solid fa-check"></i> Show Verified student</a>
	<a class="btn btn-primary" data-toggle="modal" data-target="#import" data-placement="bottom" title="Import Excel"><i class="fa-solid fa-table"></i> Import Excel</a>
	
</div>

<div class="float-center">

<?php include "filter.php";?>
<div class="float-right">
	<div>
	</div>

	<div>
	<input class="form-control" id="unverified_user" type="text" placeholder="Search..">
	</div>
	</div>

	
	
</div>

</div>

			<?php
			$result_user = mysqli_query($conn,"SELECT * FROM student_info");
			?>
			<h3 class="candidates_pos">Enrolled student <span class="percentage"><?php echo "Number Of Students: ".$all_un;?></span></h3>
		<div class="separator-line"></div>
		<div class="table1">
		<table class="table table-hover">
			<caption>List of users</caption>
		<thead>
			<tr>
				<th>LRN</th>
				<th>Name</th>
				<th>Sex</th>
				<th>Grade</th>
				<th>Section</th>
				<th>Age</th>
				
			</tr>
		</thead>
		<tbody  id="unverified_table">
			<?php
			if(empty($result)){
				echo "<tr>";
				echo "<td><center> NO RECORDS</center></td>";
				echo "</tr>";
			}else{
		while($row_user=mysqli_fetch_array($result_user)){?>
			<tr>
				<td><?php echo $row_user['LRN']?></td>
				<td><?php echo $row_user['NAME']?></td>
				<td><?php echo $row_user['SEX']?></td>
				<td><?php echo $row_user['GRADE']?></td>
				<td><?php echo $row_user['SECTION']?></td>
				<td><?php echo $row_user['AGE']?></td>
			</tr>
		<?php }
		} ?>
		</tbody>
	</table>
	</div>
	<div class="separator-line"></div>
		</div>

		<script>
		function show(shown, hidden) {
		document.getElementById(shown).style.display='block';
		document.getElementById(hidden).style.display='none';
		return false;
		}
		</script>
		
	<?php  

// 		$result_db = mysqli_query($conn,"SELECT COUNT(CtrlNum) FROM userlogin"); 
// 		$row_db = mysqli_fetch_row($result_db);  
// 		$total_records = $row_db[0];  
// 		$total_pages = ceil($total_records / $limit); 
// 		/* echo  $total_pages; */
// 		$pagLink = "<ul class='pagination overflow-auto'>";  
// 		for ($i=1; $i<=$total_pages; $i++) {
//               $pagLink .= "<li class='page-item'><a class='btn btn-sm btn-primary' href='voterslist.php?page=".$i."'>".$i."</a></li>";	
// }
// echo $pagLink . "</ul>";  
?>

</div>
<div class="separator-line bottom-separator"></div>
<?php include "footer.php";?>

		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>

setTimeout(function(){
        document.getElementById('success-msg').style.display = 'none';
    },3000);

$(document).ready(function (){

	$('.delete_btn').on('click', function(){
		$('#deletemodal').modal('hide');

		$tr = $(this).closest('tr');

		var data = $tr.children("td").map(function(){
			return $(this).text();
		}).get();

		console.log(data);

		$('#password').val(data[8]);
		$('#section').val(data[6]);
		$('#grade').val(data[5]);
		$('#username').val(data[4]);
		$('#name').val(data[3]);
		$('#lrn').val(data[2]);
		$('#view_id').val(data[0]);

	}); 

});

$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

$(document).ready(function(){
  $("#unverified_user").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#unverified_table tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

$(document).ready(function (){

$('.edit_btn').on('click', function(){
	$('#editmodal').modal('hide');

	$tr = $(this).closest('tr');

	var data = $tr.children("td").map(function(){
		return $(this).text();
	}).get();

	console.log(data);

		$('#password1').val(data[8]);
		$('#section1').val(data[6]);
		$('#grade1').val(data[5]);
		$('#username1').val(data[4]);
		$('#name1').val(data[3]);
		$('#lrn2').val(data[2]);
		$('#view_id1').val(data[0]);
}); 

});

$(document).ready(function (){

$('.reset_pass').on('click', function(){
	$('#reset_pass').modal('hide');

	$tr = $(this).closest('tr');

	var data = $tr.children("td").map(function(){
		return $(this).text();
	}).get();

	console.log(data);

	$('#reset_email').val(data[4]);
	$('#reset_name').val(data[3]);
	$('#reset_lrn').val(data[2]);

}); 

});

$(document).ready(function (){

$('.officer_btn').on('click', function(){
	$('#officermodal').modal('hide');

	$tr = $(this).closest('tr');

	var data = $tr.children("td").map(function(){
		return $(this).text();
	}).get();

	console.log(data);
		$('#name_officer').val(data[3]);
		$('#lrn_officer').val(data[2]);
}); 

});

$(document).ready(function (){

$('.section_add_btn').on('click', function(){
	$('#addSectionmodal').modal('show');

	$tr = $(this).closest('tr');

	var data = $tr.children("td").map(function(){
		return $(this).text();
	}).get();

	console.log(data);

		$('#add-section').val(data[1]);
}); 

});

$(document).ready(function (){

$('.section_delete_btn').on('click', function(){
	$('#deletSectionemodal').modal('show');

	$tr = $(this).closest('tr');

	var data = $tr.children("td").map(function(){
		return $(this).text();
	}).get();

	console.log(data);

		$('#delete-section').val(data[1]);
}); 

});

$(document).ready(function (){

$('.section_edit_btn').on('click', function(){
	$('#editSectionemodal').modal('show');

	$tr = $(this).closest('tr');

	var data = $tr.children("td").map(function(){
		return $(this).text();
	}).get();

	console.log(data);

		$('#edit-section').val(data[1]);
		$('#id-section').val(data[0]);
}); 

});

$("#toggle").on("click", function() {
    $("#hiddenRow").toggleClass("show");
});



</script>


</body>
</html>