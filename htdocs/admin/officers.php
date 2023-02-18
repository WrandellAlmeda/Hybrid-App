<?php
session_start();
$title = 'List Of Voters';
include "connection.php";
include "session/session.php";
require 'include/headerAdmin.php';
$conn=mysqli_connect($host,$user,$password,$db);



// $limit = 500;  
// if (isset($_GET["page"])) {
// 	$page  = $_GET["page"]; 
// 	} 
// 	else{ 
// 	$page=1;
// 	};  
// $start_from = ($page-1) * $limit;  
$result = mysqli_query($conn,"SELECT * FROM userlogin WHERE status = 'officer' ORDER BY CtrlNum DESC");

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


<div class="modal fade" id="deletemodal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
			<h4 class="modal-title" style="color:#dc3545;">WARNING!!!!</h4>
          
        </div>

		<form action="crudFunctions.php" method="post">
		<div class="modal-body input-group mb-3">
			<p>Are you sure, want to delete this data?</p>
			

			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="lrn1">LRN</span>
			</div>
			<input type="text" class="form-control input-group-text disabled" name="lrn" id="lrn" aria-describedby="lrn1" readonly>
			</div>


			<!-- <div class="input-group mb-3">
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
		</div>-->
        </div>
       
		<div class="modal-footer">
		<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-danger" name="delete_office">Yes, Delete it!</button>
        
		</div>
	  </form>

</div>
      
    </div>
  </div>
</div>


<div class="modal fade" id="editmodal" role="dialog">
    <div class="modal-dialog">
    
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


		<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">PASSWORD</span>
			</div>
			<input type="password" class="form-control"  name="password" aria-describedby="basic-addon1" required>
		</div>
			
		
			
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

	<div class="table-container">
	<?php
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
	
	?>
		<!-- <h1 class="page-title">Voters List</h1> -->
		<div class="flex-search">

			<div class="float-left">
				<a class="btn btn-primary" href="addStudent.php" hidden><i class="fa-solid fa-plus"></i> Voter</a>
				
			</div>
		
			<div class="float-center">
			
			<?php include "filter.php";?>
			<div class="float-right">
				<div>
			
				</div>

				<div>
				<input class="form-control" id="myInput" type="text" placeholder="Search..">
				</div>
				</div>
			
				
				
			</div>
			
		</div>
		<h3 class="candidates_pos">Student Staff</h3>
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
						<a class="btn btn-sm btn-outline-secondary" href="user_log.php?lrn=<?php echo $row['LRN'];?>"  data-toggle="tooltip" data-placement="bottom" title="Logs"><i class="fa-solid fa-globe"></i></a>
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