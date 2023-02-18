<?php
session_start();
$title = 'List Of Officers';
include "connection.php";
include "session/session.php";
require_once('include/headerAdmin.php');
$conn=mysqli_connect($host,$user,$password,$db);



$limit = 30;  
if (isset($_GET["page"])) {
	$page  = $_GET["page"]; 
	} 
	else{ 
	$page=1;
	};  
$start_from = ($page-1) * $limit;  
$result = mysqli_query($conn,"SELECT * FROM userlogin WHERE status = 'officer' ORDER BY CtrlNum DESC LIMIT $start_from, $limit");
?>

<style type="text/css">

	.table-container{
		max-width: 870px;
		margin: 40px auto 0;
		font-family: 'Poppins', sans-serif;
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
		max-width: px;
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
	display: grid;
		grid-template-columns: 1fr 1fr;
		grid-gap: 10px;
}

input:focus ~ i{
	color: blue;
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
			<input type="text" name="view_id" id="view_id" hidden>

			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="lrn1">LRN</span>
			</div>
			<input type="text" class="form-control input-group-text" name="lrn" id="lrn" aria-describedby="lrn1" readonly>
			</div>


			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">NAME</span>
			</div>
			<input type="text" class="form-control input-group-text"  name="name" id="name" aria-describedby="basic-addon1" readonly>
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
			<button type="submit" class="btn btn-danger" name="deleteOfficer">Yes, Delete it!</button>
        
		</div>
	  </form>

</div>
		<div class="modal-footer">
	  		<button type="button" class="btn btn-info" data-dismiss="modal">No, Don't Delete it!</button>
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
			<input type="text" class="form-control" name="lrn" id="lrn2" aria-describedby="basic-addon1" readonly>
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
			<input type="text" class="form-control"  name="grade" id="grade1" aria-describedby="basic-addon1">
			</div>


			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">SECTION</span>
			</div>
			<input type="text" class="form-control"  name="section" id="section1" aria-describedby="basic-addon1" readonly>
			</div>


			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">EMAIL</span>
			</div>
			<input type="text" class="form-control" name="username" id="username1" aria-describedby="basic-addon1">
		</div>


		<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">PASSWORD</span>
			</div>
			<input type="password" class="form-control"  name="password" id="password1" aria-describedby="basic-addon1">
		</div>
			
		
			
			<div class="modal-footer">
			<button type="submit" class="btn btn-danger" name="updateOfficer">Update</button>
			</div>
			</form>
        </div>

</div>
	     
    </div>
  </div>
</div>



		<?php
		
		if(isset($_POST['filter_select'])){

			$selection = $_POST['selection'];

			if($selection == 'tvl'){ 
			$result = mysqli_query($conn,"SELECT * FROM userlogin WHERE section LIKE '%".$selection."%'");
			}elseif($selection == 'gas'){
				$result = mysqli_query($conn,"SELECT * FROM userlogin WHERE section LIKE '%".$selection."%'");
			}elseif($selection == 'abm'){
				$result = mysqli_query($conn,"SELECT * FROM userlogin WHERE section LIKE '%".$selection."%'");
			}elseif($selection == 'smaw'){
				$result = mysqli_query($conn,"SELECT * FROM userlogin WHERE section LIKE '%".$selection."%'");
			}elseif($selection == 'humms'){
				$result = mysqli_query($conn,"SELECT * FROM userlogin WHERE section LIKE '%".$selection."%'");
			}else{ 
			$result = mysqli_query($conn,"SELECT * FROM userlogin ORDER BY CtrlNum DESC LIMIT $start_from, $limit");
			}

		}
		
		
		?>
	
	<div class="table-container">
	<?php if(isset($_GET['success'])) {?>
         <div class="alert alert-success"  role="alert">
            <h4 class="alert-heading">Success <i class="fa-solid fa-check"></i></h4>
			<p>Note: <strong><?php echo $_GET['success'] ?></strong> has been updated</p>
			<a href="officerslist.php" class="btn btn-outline-success">Close</a>
		</button>
         </div> 
		<?php unset( $_GET['success']); }?>	

		<?php if(isset($_GET['added'])) {?>
            <div class="alert alert-success"  role="alert">
			<h4 class="alert-heading">Success <i class="fa-solid fa-check"></i></h4>
			<p>Note: <strong><?php echo $_GET['added'] ?></strong> has been added!</p>
			<a href="officerslist.php" class="btn btn-outline-success">Close</a>
            </div>
		<?php unset( $_GET['added']); }?>	

		<?php if(isset($_GET['error'])) {?>
            <div class="alert alert-danger" irole="alert">
            <h4 class="message">Failed <i class="fa-solid fa-triangle-exclamation"></i></h4>
			<p>Note: <strong><?php echo $_GET['error'] ?></strong> is already exists!</p>
			<a href="officerslist.php" class="btn btn-outline-success">Close</a>
            </div>
		<?php unset( $_GET['error']); }?>

		<?php if(isset($_GET['response'])) {?>
			<p class="alert"><strong><?php echo $_GET['response'] ?></strong></p>
		<?php unset($_GET["response"]);} ?>

		<?php if(isset($_GET['deleted'])) {?>
            <div class="alert alert-success"  role="alert">
            <h4><i class="fa-solid fa-check"></i> Success</h4>
			<p>Note: <strong> <?php echo $_GET['deleted'] ?></strong> has been removed!</p>
			<a href="officerslist.php" class="btn btn-outline-success">Close</a>
        </div>
		<?php unset($_GET["deleted"]);} ?>
		<h2>Officers List</h2>
		<div class="flex-search">

			<div class="float-left">
				<a class="btn btn-primary" href="addOfficer.php">Add Officer</a>
			</div>
		

			<div class="float-right">
				<form action="searchOfficer.php" method="post">
					<div class="form-fields">
					<input type="text" name="searchField">
					<i class="fa-solid fa-magnifying-glass"></i>
				</div>
				<input type="submit" name="search" hidden>
				</form>
			</div>
			
		</div>
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
				<th>Operation</th>
				<th hidden>Password</th>
			</tr>
		</thead>
		<tbody>
			<?php	
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
						<a class="btn btn-sm btn-outline-secondary edit_btn" data-toggle="modal" data-target="#editmodal"><i class="fa-solid fa-pen-to-square"></i></a>
						</div>

						<div class="button-press">
						<a class="btn btn-sm btn-outline-secondary" href="officerInfo.php?ii=<?php echo $row['CtrlNum']; ?>&qr=<?php echo $row['qr_code'];?>&numlrn=<?php echo $row['LRN'];?>&fname=<?php echo $row['fullname'];?>&grade=<?php echo $row['grade'];?>&section=<?php echo $row['section'];?>&uname=<?php echo $row['username']?>&pword=<?php echo $row['password']?>"><i class="fa-solid fa-eye"></i></a>

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
</div>


<script type="text/javascript">
  function handleSelect(elm)
  {
     window.location = elm.value+".php";
  }
</script>

<script>
function deleletconfig(){

var del=confirm("Are you sure you want to delete this record?");
if (del==true){
   alert ("record deleted")
}
return del;
}
</script>	



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

		    $('#password').val(data[8]);
		    $('#section').val(data[6]);
		    $('#grade').val(data[5]);
		    $('#username').val(data[4]);
		    $('#name').val(data[3]);
		    $('#lrn').val(data[2]);
		    $('#view_id').val(data[0]);

	}); 

});


$(document).ready(function (){

$('.edit_btn').on('click', function(){
	$('#editmodal').modal('show');

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



</script>


</body>
</html>