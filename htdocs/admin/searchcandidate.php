<?php
session_start();
$title = "Search";
include 'connection.php';
require_once "include/headerAdmin.php";
include "session/session.php";

$conn=mysqli_connect($host,$user,$password,$db);

if (isset($_POST['search'])) {
	$searchField = $_POST['searchField'];
	$query=mysqli_query($conn,	"SELECT * FROM candidates WHERE CONCAT(`id`, `Position`, `Name`, `LRN`, `grade`, `section` ) LIKE '%".$searchField."%'");
}
?>


<style type="text/css">
	.table-container{
		max-width: 870px;
		margin: 40px auto 0;
	}

	input{
		width:100%;
	}

	th{	
		font-size: 12px;
		text-align: center;
	}
	td{
		font-size: 12px;
	}

	h2{
		font-size: 18px;
		color: #949494;
	}

	strong{
		color: #808080;
	}

    .profile-candidate{
	max-width: 100px;
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

	.table1{
		overflow-x:auto;
	}

	.back_btn{
		display: block;
		font-size: 2em;
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

	.back_btn{
		display: block;
		font-size: 2em;
		}

	}

</style>

<body>
<!-----PARA SA EDIT NG CANDIDATES------>
<div class="modal fade" id="editmodal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
			<h4 class="modal-title" style="color:#dc3545;">UPDATE</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
          
        </div>

		<form action="crudFunctions.php" method="post">
		<div class="modal-body input-group mb-3">
			<input type="text" name="view_id" id="view_id1" hidden>

			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">LRN</span>
			</div>
			<input type="number" class="form-control" name="lrn" id="lrn2" aria-describedby="basic-addon1" readonly>
			</div>

 
			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">NAME</span>
			</div>
			<input type="text" class="form-control"  name="name" id="name1" aria-describedby="basic-addon1" readonly>
			</div>

			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">GRADE</span>
			</div>
			<input type="number" class="form-control"  name="grade" id="grade1" aria-describedby="basic-addon1">
			</div>


			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">SECTION</span>
			</div>
			<input type="text" class="form-control"  name="section" id="section1" aria-describedby="basic-addon1">
			</div>


			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Position</span>
			</div>
			<input type="text" class="form-control"  name="position" id="position1" aria-describedby="basic-addon1" readonly>
			</div>


			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Platform</span>
			</div>
			<textarea name="platform"  class="form-control"  id="platform1" cols="30" rows="10" aria-describedby="basic-addon1"></textarea>
			</div>
		</div>

       
		<div class="modal-footer">
		<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
			<button type="submit" class="btn btn-danger" name="updateCandidate">Update</button>
        
		</div>
	  </form>
</div>
	   
      
    </div>
  </div>
</div>

<div class="modal fade" id="viewmodal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
			<h4 class="modal-title" style="color:#dc3545;">VIEW</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
          
        </div>

		<div class="modal-body input-group mb-3">
			<input type="text" name="view_id" id="view_id3" hidden>

			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">LRN</span>
			</div>
			<input type="number" class="form-control" name="lrn" id="lrn3" aria-describedby="basic-addon1" readonly>
			</div>

 
			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">NAME</span>
			</div>
			<input type="text" class="form-control"  name="name" id="name3" aria-describedby="basic-addon1" readonly>
			</div>

			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">GRADE</span>
			</div>
			<input type="number" class="form-control"  name="grade" id="grade3" aria-describedby="basic-addon1" readonly>
			</div>


			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">SECTION</span>
			</div>
			<input type="text" class="form-control"  name="section" id="section3" aria-describedby="basic-addon1" readonly>
			</div>


			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Position</span>
			</div>
			<input type="text" class="form-control"  name="position" id="position3" aria-describedby="basic-addon1" readonly>
			</div>


			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Platform</span>
			</div>
			<textarea name="platform"  class="form-control"  id="platform3" cols="30" rows="10" aria-describedby="basic-addon1"></textarea>
			</div>
		</div>
		<div class="modal-footer">
	  		<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
		</div>

</div>
		
	   
      
    </div>
  </div>
</div>

<div class="modal fade" id="deletemodal" role="dialog">
    <div class="modal-dialog">
    
	<!-----DELETE MODAL DATA PARA SA CANDIDATES------>
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
			<h4 class="modal-title" style="color:#dc3545;">WARNING!!!!</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
          
        </div>

		<form action="crudFunctions.php" method="post">
		<div class="modal-body input-group mb-3">
			<p>Are you sure, want to delete this data?</p>
			<input type="text" name="view_id" id="view_id" hidden>

			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="lrn1">LRN</span>
			</div>
			<input type="text" class="form-control" name="lrn" id="lrn" aria-describedby="lrn1" readonly>
			</div>


			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">NAME</span>
			</div>
			<input type="text" class="form-control"  name="name" id="name" aria-describedby="basic-addon1" readonly>
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
			<span class="input-group-text" id="basic-addon1">Position</span>
			</div>
			<input type="text" class="form-control" name="username" id="position" aria-describedby="basic-addon1" readonly>
		</div>

        </div>
       
		<div class="modal-footer">
		<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">No, Don't Delete it!</button>
		<button type="submit" class="btn btn-danger" name="deleteCandidate">Yes, Delete it!</button>
		</div>
	  </form>

</div>
		<div class="modal-footer">
	  		
		</div>
	   
      
    </div>
  </div>
</div>

<div class="table-container">
	<a href="candidateslist.php" class="back_btn"><i class="fa-solid fa-circle-arrow-left"></i></a>
		<h2><a href="candidateslist.php"></a>Result/s for <strong><?php echo $searchField?>...</strong></h2>

        <div class="separator-line"></div>
		<div class="table1">
		<table class="table table-hover table-responsive">
			<caption>List of users</caption>
		<thead>
			<tr>
				<th hidden>id</th>
				<th>LRN</th>
				<th>Name</th>
				<th hidden>Grade</th>
				<th hidden>Section</th>
				<th>Position</th>
				<th>Platform</th>
				<th>Picture</th>
				<th>Operation</th>
			</tr>
		</thead>
		<tbody>
			<?php	
		//$query=mysqli_query($conn,"select * from userlogin ORDER BY CtrlNum DESC");
		while($row=mysqli_fetch_array($query)){?>
			<tr>
				<td hidden><?php echo $row['id']?></td>
				<td><?php echo $row['LRN']?></td>
				<td><?php echo $row['Name']?></td>
				<td hidden><?php echo $row['grade']?></td>
				<td hidden><?php echo $row['section']?></td>
				<td><?php echo $row['Position']?></td>
				<td><?php echo $row['Platform']?></td>
				<td><img class="profile-candidate" src="<?php echo $row['picture']?>"></td>
				<td>
				<div class="d-flex justify-content-between space-button">
						<div class="button-press">
						<a class="btn btn-sm btn-outline-secondary edit_btn" data-toggle="modal" data-target="#editmodal"><i class="fa-solid fa-pen-to-square"></i></a>
						</div>

						<div class="button-press">
						<a class="btn btn-sm btn-outline-secondary view_btn" data-toggle="modal" data-target="#viewmodal"><i class="fa-solid fa-eye"></i></a>
						</div>

						<div class="button-press">
						<a class="btn btn-sm btn-outline-danger delete_btn" data-toggle="modal" data-target="#deletemodal"><i class="fa-solid fa-trash-can "></i></a>
						</div>
					
					</div>
				</td>

			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>

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
</script>

</body>