<?php
session_start();
$title = 'CANDIDATES LIST';
include "connection.php";
include "session/session.php";
require "include/headerAdmin.php";

$conn=mysqli_connect($host,$user,$password,$db);


 
$result = mysqli_query($conn,"SELECT * FROM pageant_candidates WHERE confirm=2 ORDER BY id DESC");
$criteria = mysqli_query($conn,"SELECT * FROM criteria");

$parse = parse_ini_file('pageant_title.ini', FALSE, INI_SCANNER_RAW);
$parse_open = parse_ini_file('open_pageant.ini', FALSE, INI_SCANNER_RAW);
$title = $parse['election_title'];
$voting_close_open = $parse_open['open_voting'];
?>

<style type="text/css">

	.table-container{
		max-width: 1100px;
		margin: 40px auto 0;
		height: 100%;
		margin-bottom: 3em;
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


			<div class="input-group mb-3" hidden>
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Position</span>
			</div>
			<input type="text" class="form-control" name="username" id="position" aria-describedby="basic-addon1" readonly>
		</div>

        </div>
       
		<div class="modal-footer">
		<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">No, Don't Delete it!</button>
		<button type="submit" class="btn btn-danger" name="delete_pageant">Yes, Delete it!</button>
		</div>
	  </form>

</div>
		<div class="modal-footer">
	  		
		</div>
	   
      
    </div>
  </div>
</div>

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

			<div class="input-group mb-3" hidden>
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">LRN</span>
			</div>
			<input type="number" class="form-control" name="lrn" id="lrn2" aria-describedby="basic-addon1" readonly>
			</div>

 
			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">NAME</span>
			</div>
			<input type="text" class="form-control input-group-text"  name="name" id="name1" aria-describedby="basic-addon1" readonly>
			</div>

			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">GRADE</span>
			</div>
			<input type="number" class="form-control input-group-text"  name="grade" id="grade1" aria-describedby="basic-addon1">
			</div>


			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">SECTION</span>
			</div>
			<input type="text" class="form-control input-group-text"  name="section" id="section1" aria-describedby="basic-addon1">
			</div>


			<div class="input-group mb-3" hidden>
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Position</span>
			</div>
			<input type="text" class="form-control"  name="position" id="position1" aria-describedby="basic-addon1" readonly>
			</div>


			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Motto</span>
			</div>
			<textarea name="platform"  class="form-control"  id="platform1" cols="30" rows="10" aria-describedby="basic-addon1"></textarea>
			</div>

		</div>

       
		<div class="modal-footer">
		<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
			<button type="submit" class="btn btn-danger" name="update_pageant_candidate">Update</button>
        
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
			<textarea name="platform"  class="form-control"  id="platform3" cols="30" rows="10" aria-describedby="basic-addon1" readonly></textarea>
			</div>
		</div>
		<div class="modal-footer">
	  		<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
		</div>

</div>
		
	   
      
    </div>
  </div>
</div>
<!----UPDATE POSITION AND ITS MAXIMUM VOTES MODAL------>
<div class="modal fade" id="editSectionmodal" role="dialog">
    <div class="modal-dialog">
    
      <div class="modal-content">
        <div class="modal-header">
			<h4 class="modal-title text-primary">UPDATE</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
		<div class="modal-body form-update">
			<form action="crudFunctions.php" method="post">
			<input type="text" name="view_id" id="id-section" hidden>
			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Criteria</span>
			</div>
			<input type="text" class="form-control" name="section" id="edit-section" aria-describedby="basic-addon1">
			</div>

			<!-- <div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Percentage</span>
			</div>
			<input type="number" class="form-control input-group-text" name="maxVotes" id="edit-percent" aria-describedby="basic-addon1" readonly>
			</div> -->
		

			<div class="modal-footer">
			<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary" name="editCriteria">UPDATE</button>
			</div>
			</form>
        </div>

</div>
	     
    </div>
  </div>
</div>
<!------ADDING OF POSITIONS AND ITS MAXIMUM VOTES MODAL------>
<div class="modal fade" id="addSectionmodal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
			<h4 class="modal-title">Add Criteria</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
		<div class="modal-body form-update">
			<form action="crudFunctions.php" method="post">

			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Description</span>
			</div>
			<input type="text" class="form-control" name="section" id="add-section" aria-describedby="basic-addon1" required>
			</div>

			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Point/s</span>
			</div>
			<input type="number" class="form-control" name="maxVotes" id="add-section" aria-describedby="basic-addon1" required>
			</div>

			<?php
			$query_percent = "SELECT sum(percentage) FROM criteria";
			$result_percentage = mysqli_query($conn, $query_percent);
			
			$row_percent = mysqli_fetch_array($result_percentage);
			$total_percentage = $row_percent[0];
			$default_value = 100;
			$sum = $default_value - $total_percentage;

			if($sum >= 60 || $sum <= 100 ){
				?>
				<p style="text-align: right; color: green;">Remaining Score: <?php echo $sum?> Point/s</p>
		<?php

			}elseif($sum <= 60){
				?>
				<p style="text-align: right; color: orange;">Remaining Score Percentage: <?php echo $sum?>%</p>
			<?php
			}else{
				?>
				<p style="text-align: right; color: red;">Remaining Score Percentage: <?php echo $sum?>%</p>
				<?php
			}
			?>
			<!-- <p style="text-align: right;">Remaining Score Percentage: <?php echo $sum?>%</p>
		 -->
			
			<div class="modal-footer">
			<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
			<!-- addPosition crudfunctions -->

			<?php
			if($sum == 0){
				?>
				<button type="submit" class="btn btn-secondary" name="addCriteria" disabled>Completed</button>
					
				<?
			}else{
				?>
				<button type="submit" class="btn btn-primary" name="addCriteria">ADD</button>
				<?php
			}
			
			?>
		
			</div>
			</form>
        </div>

</div>
	     
    </div>
  </div>
</div>

<div class="modal fade" id="deleteSectionmodal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
			<h4 class="modal-title text-danger">WARNING!!!</h4>
        </div>
		<div class="modal-body form-update">
			<form action="crudFunctions.php" method="post">
			<p class="text-muted text-center">Are you sure? you want to <strong>Permanently Delete</strong> this item?</p>
			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Criteria Description</span>
			</div>
			<input type="text" class="form-control is-invalid" name="section" id="delete-section" aria-describedby="basic-addon1" readonly>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-danger" name="deleteCriteria">YES</button>
			</div>
			</form>
        </div>

</div>
	     
    </div>
  </div>
</div>

<div class="modal fade" id="editTitle" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
			<h4 class="modal-title text-danger">EDIT PAGEANT TITLE</h4>
        </div>
		<div class="modal-body form-update">
			<form action="crudFunctions.php" method="post">
			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Title</span>
			</div>
			<input type="text" class="form-control" name="electionTitle"  value="<?php echo strtoupper($title); ?>" aria-describedby="basic-addon1">
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-danger" name="EditPageantTitle">Edit</button>
			</div>
			</form>
        </div>

</div>
	     
    </div>
  </div>
</div>


<div class="modal fade" id="open" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
		<h4 class="modal-title text-danger">PAGEANT</h4>
        </div>
		<div class="modal-body form-update">

		<?php
		if($voting_close_open == 'open'){
					?>
					<p>You Want to Close the Pageant?</p>
					<form action="crudFunctions.php" method="post">
					<div class="input-group mb-3">
					<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1" hidden>Close or Open</span>
					</div>
					<input type="text" class="form-control" name="validate_close_open"  value="close" aria-describedby="basic-addon1" hidden>
					</div>
					<div class="modal-footer">
					<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-danger" name="open_close_pageant">Close Pageant</button>
					</div>
					</form>
					<?php
				}else{
					?>
					<p>You Want to Open the Pageant?</p>
					<form action="crudFunctions.php" method="post">
					<div class="input-group mb-3">
					<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1" hidden>Close or Open</span>
					</div>
					<input type="text" class="form-control" name="validate_close_open"  value="open" aria-describedby="basic-addon1" hidden>
					</div>
					<div class="modal-footer">
					<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success" name="open_close_pageant">Open Pageant</button>
					</div>
					</form>
					<?php
				}
		?>
        </div>
	</div>
			
		</div>
	</div>
	</div>
	
	<div class="table-container">
	<?php if(isset($_GET['success'])) {?>
         <div class="alert alert-success"  role="alert">
            <h4 class="alert-heading">Success <i class="fa-solid fa-check"></i></h4>
			<p>Note: <strong><?php echo $_GET['success'] ?></strong> has been updated</p>
			<a href="admin_pageant_list.php" class="btn btn-outline-success">Close</a>
		</button>
         </div> 
		<?php unset( $_GET['success']); }?>


		<?php if(isset($_GET['openorclose'])) {?>
         <div class="alert alert-success"  role="alert">
            <h4 class="alert-heading">Success <i class="fa-solid fa-check"></i></h4>
			<p>Note: <strong><?php echo $_GET['openorclose'] ?></strong></p>
			<a href="admin_pageant_list.php" class="btn btn-outline-success">Close</a>
		</button>
         </div> 
		<?php unset( $_GET['openorclose']); }?>

		<?php if(isset($_GET['added'])) {?>
            <div class="alert alert-success"  role="alert">
			<h4 class="alert-heading">Success <i class="fa-solid fa-check"></i></h4>
			<p>Note: <strong><?php echo $_GET['added'] ?></strong> has been added!</p>
			<a href="admin_pageant_list.php" class="btn btn-outline-success">Close</a>
            </div>
		<?php unset( $_GET['added']); }?>	

		<?php if(isset($_GET['error'])) {?>
            <div class="alert alert-danger" irole="alert">
            <h4 class="message">Failed <i class="fa-solid fa-triangle-exclamation"></i></h4>
			<p>Note: <strong><?php echo $_GET['error'] ?></strong></p>
			<a href="admin_pageant_list.php" class="btn btn-outline-danger">Close</a>
            </div>
		<?php unset( $_GET['error']); }?>

		<?php if(isset($_GET['response'])) {?>
			<p class="alert"><strong><?php echo $_GET['response'] ?></strong></p>
		<?php unset($_GET["response"]);} ?>

		<?php if(isset($_GET['deleted'])) {?>
            <div class="alert alert-success"  role="alert">
            <h4><i class="fa-solid fa-check"></i> Success</h4>
			<p>Note: <strong> <?php echo $_GET['deleted'] ?></strong> has been removed!</p>
			<a href="admin_pageant_list.php" class="btn btn-outline-success">Close</a>
        </div>
		<?php unset($_GET["deleted"]);} ?>

		<div>
		<h1 class="page-header text-center title"><b><?php echo strtoupper($title); ?></b> <a class="btn btn-sm btn-outline-secondary edit_title" data-toggle="modal" data-target="#editTitle"><i class="fa-solid fa-pen-to-square""></i></a></h1>
		
		</div>
	
		<div class="flex-search">

			<div class="float-left">
				<div class="plus-buttons">
				<div>
				<a class="btn btn-sm btn-primary section_add_btn test_btn" data-toggle="modal" data-target="#addSectionmodal" style="margin-bottom: 1em;" data-placement="bottom" title="Add Criteria"><i class="fa-solid fa-plus"></i> Criteria</a>
				</div>
				<div hidden>
				<?php
				if($voting_close_open == 'open'){
					?>
					<a class="btn btn-primary btn-sm open" data-toggle="modal" data-target="#open" style="margin-bottom: 1em;" data-placement="bottom" title="Voting is Open">Open for Voting</a>
					<?php
				}else{
					?>
					<a class="btn btn-danger btn-sm open" data-toggle="modal" data-target="#open" style="margin-bottom: 1em;" data-placement="bottom" title="Voting is Close">Voting is Close</a>
					<?php
				}
				
				?>
				
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
            <h3 class="candidates_pos">Candidates</h3>
		<div class="separator-line"></div>
		<div class="table1">
		<table class="table table-hover table-responsive">
			<caption>List of Candidates</caption>
		<thead>
			<tr>
				<th hidden>id</th>
				<th>LRN</th>
				<th>Name</th>
				<th>Grade</th>
				<th>Section</th>
				<th hidden>Position</th>
				<th hidden>Motto</th>
				<th>Gender</th>
				<th>Picture</th>
				<th>Operations</th>
			</tr>
		</thead>
		<tbody id="myTable">
			<?php	
		//$query=mysqli_query($conn,"select * from userlogin ORDER BY CtrlNum DESC");
		while($row=mysqli_fetch_array($result)){?>
			<tr>
				<td hidden><?php echo $row['id']?></td>
				<td><?php echo $row['LRN']?></td>
				<td><?php echo $row['Name']?></td>
				<td><?php echo $row['grade']?></td>
				<td><?php echo $row['section']?></td>
				<td hidden><?php echo $row['Position']?></td>
				<td hidden><?php echo $row['Motto']?></td>
				<!-- <a href="pdf_file.php?pdf=<?php echo $row['pdf']; ?>" class="btn btn-sm btn-danger pdf">PDF</a> -->
				<!-- <td class="truncate"><?php echo $row['Motto']?></td> -->
				<td><?php $gender= $row['gender'];
						if($gender == M){
							echo "MALE";
						}else{
							echo "FEMALE";
						}
				?></td>
				<td><img class="profile-candidate" src="<?php echo $row['picture']?>"></td>
				<td>
				<div class="d-flex justify-content-between space-button">
						<div class="button-press">
						<a class="btn btn-sm btn-outline-secondary edit_btn" data-toggle="modal" data-target="#editmodal" data-placement="bottom" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
						</div>

						<div class="button-press">
						<a class="btn btn-sm btn-outline-secondary view_btn" data-toggle="modal" data-target="#viewmodal" data-placement="bottom" title="View"><i class="fa-solid fa-eye"></i></a>
						</div>

						<div class="button-press">
						<a class="btn btn-sm btn-outline-danger delete_btn" data-toggle="modal" data-target="#deletemodal" data-placement="bottom" title="Delete"><i class="fa-solid fa-trash-can "></i></a>
						</div>
					
					</div>
				</td>

			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>


<div>
    <h3 class="candidates_pos">Criteria</h3>
	<div class="separator-line"></div>
	<table class="table table-sm table-hover table-responsive">
	<caption>List of Criteria</caption>
			<thead>
			<th hidden>id</th>
			<th>Description</th>
			<th>Point/s</th>
			<th>Operations</th>
			</thead>
			<tbody>
			<?php while($section_row=mysqli_fetch_array($criteria)){?>
			<tr>
				<td hidden><?php echo $section_row['id']?></td>
				<td style="text-transform: uppercase; font-size: 18; font-family: 'Poppins', sans-serif; "><center><?php echo $section_row['criteria_description']?></center></td>
				<td style="font-weight: 800;"><center><?php echo $section_row['percentage']?></center></td>
				<td>
					<div class="d-flex justify-content-center space-button">
						<div class="button-press">
						<a class="btn btn-sm btn-outline-secondary section_edit_btn" data-toggle="modal" data-target="#editSectionmodal" data-placement="bottom" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
						</div>
						<div class="button-press">
						<a class="btn btn-sm btn-outline-danger section_delete_btn" data-toggle="modal" data-target="#deleteSectionmodal" data-placement="bottom" title="Delete"><i class="fa-solid fa-trash-can "></i></a>
						</div>
					</div>
				</td>
			</tr>
			<?php } ?>
			</tbody>
	</table>
</div>

</div>


<div class="separator-line"></div>
<?php include 'footer.php';?>


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
	$('#editSectionmodal').modal('hide');

	$tr = $(this).closest('tr');

	var data = $tr.children("td").map(function(){
		return $(this).text();
	}).get();

	console.log(data);
		$('#edit-percent').val(data[2]);
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