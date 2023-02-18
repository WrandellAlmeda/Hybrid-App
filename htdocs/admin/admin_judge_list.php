<?php
session_start();
$title = 'CANDIDATES LIST';
include "connection.php";
include "session/session.php";
require "include/headerAdmin.php";

$conn=mysqli_connect($host,$user,$password,$db);


 
$result = mysqli_query($conn,"SELECT * FROM pageant_candidates WHERE confirm=2 ORDER BY id DESC");
$judges = mysqli_query($conn,"SELECT * FROM judge");

$parse = parse_ini_file('pageant_title.ini', FALSE, INI_SCANNER_RAW);
$parse_open = parse_ini_file('open_pageant.ini', FALSE, INI_SCANNER_RAW);
$title = $parse['election_title'];
$voting_close_open = $parse_open['open_voting'];
?>

<style type="text/css">

    body{
        height: 100vh;
    }

	.table-container{
		max-width: 1100px;
		margin: 40px auto 0;
		height: 100%;
		font-family: 'Poppins', sans-serif;;
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

	.table{
		overflow-x:auto;
	}

	.float-right input{
			padding: 2px 12px 2px 12px;
			border-radius: 5px;
	}
	

	.float-left a{
		padding: 12px;
		text-decoration: none;
		font-weight: bold;
		font-size: 12px;
		border-radius: 12px;
		color: #fff;
	}
	td{
		align-items: center;
		text-align:  center;
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
.disabled{
	cursor: not-allowed;
}

.button-press{
	margin: 3px;
}

.profile-candidate{
	max-width: 100px;
}

input:focus ~ i{
	color: blue;
}

.plus-buttons{
	display: flex;
	flex-direction: row;
}

.plus-buttons div{
  margin-left: 5px;
}

.candidates_pos{
    padding: .5em;
    border-left: 2px solid blue;
    background: #eee;
}

	@media (max-width: 780px){
	.table-container{
		padding: 12px;
		
	}

	th{
		text-align: center;
		font-size: 12px;
	}

	.table1{
		overflow-x:auto;
	}
	.disabled{
	cursor: not-allowed;
	}

	.truncate {
		display: block;
        width: 100px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
	}

	.flex-search{
		display: flex;
		flex-direction: column;
	}
	.plus-buttons{
		display: grid;
		grid-template-columns: 1fr 1fr; 
	}

	.plus-buttons a{
		width: 100%;
	}
}



</style>
<body>	
	

	<!----UPDATE Judge------>
	<div class="modal" id="updatejudgebtn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-primary">UPDATE JUDGE INFORMATION</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>
			<div class="modal-body form-update">
			<form action="crudFunctions.php" method="post">
	<input type="hidden" id="id" name="id">
	<div class="input-group mb-3">
	<div class="input-group-prepend">
	<span class="input-group-text" id="basic-addon1">First Name</span>
	</div>
	<input type="text" class="form-control" name="first_name" id="fname" aria-describedby="basic-addon1" required>
	</div>

	<div class="input-group mb-3">
	<div class="input-group-prepend">
	<span class="input-group-text" id="basic-addon1">Last Name</span>
	</div>
	<input type="text" class="form-control" name="last_name" id="lname" aria-describedby="basic-addon1" required>
	</div>


	<div class="input-group mb-3">
	<div class="input-group-prepend">
	<span class="input-group-text" id="basic-addon1">Email</span>
	</div>
	<input type="email" class="form-control" name="email" id="email" aria-describedby="basic-addon1" required>
	</div>

	<div class="modal-footer">
	<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
	<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
	<!-- <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button> -->
	<button type="submit" class="btn btn-primary" name="updatejudge">Update</button>
	</div>
	</form>
			</div>

	</div>
			
		</div>
	</div>
	</div>

	<!-- add judge -->
	<div class="modal" id="addSectionmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Judge</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>
			<div class="modal-body form-update">
				<form action="crudFunctions.php" method="post">

				<div class="input-group mb-3">
				<div class="input-group-prepend">
				<span class="input-group-text" id="basic-addon1">First Name</span>
				</div>
				<input type="text" class="form-control" name="first_name" id="add-section" aria-describedby="basic-addon1" required>
				</div>

				<div class="input-group mb-3">
				<div class="input-group-prepend">
				<span class="input-group-text" id="basic-addon1">Last Name</span>
				</div>
				<input type="text" class="form-control" name="last_name" id="add-section" aria-describedby="basic-addon1" required>
				</div>

				
				<div class="input-group mb-3">
				<div class="input-group-prepend">
				<span class="input-group-text" id="basic-addon1">Email</span>
				</div>
				<input type="email" class="form-control" name="email" id="add-section" aria-describedby="basic-addon1" required>
				</div>
			
				<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				<!-- <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button> -->
				<button type="submit" class="btn btn-primary" name="add_judge">ADD</button>
				</div>
				</form>
			</div>

	</div>
			
		</div>
	</div>
	</div>

	<!-- delete judge -->
<div class="modal" id="deletejudgebtn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
			<h4 class="modal-title text-danger">WARNING!!!</h4>
        </div>
		<div class="modal-body form-update">
			<form action="crudFunctions.php" method="post">
			
			<p class="text-muted">Are you sure you want to <strong>Permanently Delete</strong> this judge?</p>
			<input type="hidden" name="email" id="emails1" >
		

			<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-success" name="deletejudge">YES</button>
			</div>
			</form>
        </div>

</div>
	     
    </div>
  </div>
</div>
	
	<div class="table-container">

		<?php if(isset($_GET['openorclose'])) {?>
         <div class="alert alert-success"  role="alert">
            <h4 class="alert-heading">Success <i class="fa-solid fa-check"></i></h4>
			<p>Note: <strong><?php echo $_GET['openorclose'] ?></strong></p>
			<a href="admin_judge_list.php" class="btn btn-outline-success">Close</a>
		</button>
         </div> 
		<?php unset( $_GET['openorclose']); }?>


		<?php if(isset($_GET['error'])) {?>
            <div class="alert alert-danger" irole="alert">
            <h4 class="message">Failed <i class="fa-solid fa-triangle-exclamation"></i></h4>
			<p>Note: <strong><?php echo $_GET['error'] ?></strong> is already exists!</p>
			<a href="admin_judge_list.php" class="btn btn-outline-danger">Close</a>
            </div>
		<?php unset( $_GET['error']); }?>

		<?php if(isset($_GET['response'])) {?>
			<p class="alert"><strong><?php echo $_GET['response'] ?></strong></p>
		<?php unset($_GET["response"]);} ?>

		<?php if(isset($_GET['deleted'])) {?>
            <div class="alert alert-success"  role="alert">
            <h4><i class="fa-solid fa-check"></i> Success</h4>
			<p>Note: <strong> <?php echo $_GET['deleted'] ?></strong> has been removed!</p>
			<a href="admin_judge_list.php" class="btn btn-outline-success">Close</a>
        </div>
		<?php unset($_GET["deleted"]);} ?>
		<div class="flex-search">

			<div class="float-left">
				<div class="plus-buttons">
				<div>
				<a href="#position" class="btn btn-sm btn-primary section_add_btn" data-toggle="modal" data-target="#addSectionmodal" style="margin-bottom: 1em;"><i class="fa-solid fa-plus"></i> Judge</a>
				</div>
				</div>
			</div>

			<div class="float-right">
				<!-- <form action="searchcandidate.php" method="post">
					<div class="form-fields">
					<input type="text" name="searchField">
					<i class="fa-solid fa-magnifying-glass"></i>
				</div>
				<input type="submit" name="search" hidden>
				</form> -->
                <input class="form-control" id="myInput" type="text" placeholder="Search..">
			</div>
			
        </div>

<div>
	
		<?php

		if(isset($_GET['success'])){
		echo "
		<script>
			Swal.fire(
			'Success!',
			'Info was successfully updated',
			'success'
			)
		</script>
		
		";
		}

		if(isset($_GET['added'])){
			echo "
			<script>
				Swal.fire(
				'Success!',
				'Judge has been added',
				'success'
				)
			</script>
			
			";
			}

		?>
    <h3 class="candidates_pos">Judges</h3>
	<div class="separator-line"></div>
	<table class="table table-sm table-hover table-responsive">
	<caption>List of Positions</caption>
			<thead>
			<th hidden>id</th>
			<th>QR</th>
			<th>Name</th>
			<th>Email</th>
			<th>Operations</th>
			</thead>
            <tbody  id="myTable">
			<?php while($section_row=mysqli_fetch_array($judges)){?>
			<tr>
				<td hidden><?php echo $section_row['id']?></td>
				<td><img src="<?php echo $section_row['qr_code']?>" width="50px" height="50px"></td>
				<td style="text-transform: uppercase; font-size: 18; font-family: 'Poppins', sans-serif; "><center><?php echo $section_row['first_name']?> <?php  echo $section_row['last_name']?></center></td>
				<td><center><?php echo $section_row['email']?></center></td>
				<td>
					<div class="d-flex justify-content-center space-button">
						<div class="button-press">
						<a class="btn btn-sm btn-outline-secondary update_judge_btn" data-toggle="modal" data-target="#editSectionmodal"><i class="fa-solid fa-pen-to-square"></i></a>
						</div>
						<div class="button-press">
						<a class="btn btn-sm btn-outline-danger delete_judge_btn" data-toggle="modal" data-target="#deleteSectionmodal"><i class="fa-solid fa-trash-can "></i></a>
						</div>
					</div>
				</td>
				<td hidden><?php echo $section_row['first_name']?></td>
				<td hidden><?php echo $section_row['last_name']?></td>
			</tr>
			<?php } ?>
            </tbody>
	</table>
</div>
</div>



<?php include 'footer.php';?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
$(document).ready(function (){

$('.delete_btn').on('click', function(){
	$('#deletemodal').modal('hide');

	$tr = $(this).closest('tr');

	var data = $tr.children("td").map(function(){
		return $(this).text();
	}).get();

	console.log(data);

	$('#platform').val(data[6]);
	$('#position').val(data[5]);
	$('#section').val(data[4]);
	$('#grade').val(data[3]);
	$('#name').val(data[2]);
	$('#lrn').val(data[1]);
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


$(document).ready(function (){

$('.delete_judge_btn').on('click', function(){
	$('#deletejudgebtn').modal('show');

	$tr = $(this).closest('tr');

	var data = $tr.children("td").map(function(){
		return $(this).text();
	}).get();

	console.log(data);

		$('#emails1').val(data[3]);
	
}); 

});

$(document).ready(function (){

$('.update_judge_btn').on('click', function(){
	$('#updatejudgebtn').modal('show');

	$tr = $(this).closest('tr');

	var data = $tr.children("td").map(function(){
		return $(this).text();
	}).get();

	console.log(data);
		$('#id').val(data[0]);
		$('#email').val(data[3]);
		$('#fname').val(data[5]);
		$('#lname').val(data[6]);
}); 

});


$(document).ready(function (){

$('.edit_title').on('click', function(){
	$('#editTitle').modal('hide');

	$tr = $(this).closest('tr');

	var data = $tr.children("td").map(function(){
		return $(this).text();
	}).get();

	console.log(data);
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
	$('#picture1').val(data[7]);
	$('#platform1').val(data[6]);
	$('#position1').val(data[5]);
	$('#section1').val(data[4]);
	$('#grade1').val(data[3]);
	$('#name1').val(data[2]);
	$('#lrn2').val(data[1]);
	$('#view_id1').val(data[0]);

}); 

});

$(document).ready(function (){

$('.view_btn').on('click', function(){
	$('#viewmodal').modal('hide');

	$tr = $(this).closest('tr');

	var data = $tr.children("td").map(function(){
		return $(this).text();
	}).get();


	console.log(data);
	$('#platform3').val(data[6]);
	$('#position3').val(data[5]);
	$('#section3').val(data[4]);
	$('#grade3').val(data[3]);
	$('#name3').val(data[2]);
	$('#lrn3').val(data[1]);
	$('#view_id3').val(data[0]);

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
		$('#edit-position-votes').val(data[2]);
		$('#edit-section').val(data[1]);
		$('#id-section').val(data[0]);
}); 

});


$(document).ready(function (){

$('.section_add_btn').on('click', function(){
	$('#addSectionmodal').modal('hide');

	$tr = $(this).closest('tr');

	var data = $tr.children("td").map(function(){
		return $(this).text();
	}).get();

	console.log(data);

		$('#add-section').val(data[1]);
}); 

});

$(document).ready(function (){

$('.open').on('click', function(){
	$('#open').modal('hide');

	$tr = $(this).closest('tr');

	var data = $tr.children("td").map(function(){
		return $(this).text();
	}).get();

	console.log(data);

		$('#add-section').val(data[1]);
}); 

});




</script>

</body>
</html>