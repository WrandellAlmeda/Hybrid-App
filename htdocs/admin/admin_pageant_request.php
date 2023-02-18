<?php
session_start();
$title = "Requests";
include "connection.php";
include "session/session.php";
require "include/headerAdmin.php";

$conn = mysqli_connect($host, $user, $password, $db);
$candidate_request = mysqli_query($conn, "SELECT * FROM pageant_candidates WHERE confirm = 1");
$candidate_row = mysqli_query($conn, "SELECT * FROM pageant_candidates");

?>
<style>
    .buong-box{
        max-width: 870px;
        margin: auto;
		justify-content: center;
		margin-top: 5em;
		font-family: 'Poppins', sans-serif;
    }

	h4{
		padding-bottom: 1em;
		font-weight: bold;
	}
	.table-con{
		max-width: 870px;
	}

    .profile-candidate{
	    max-width: 80px;
		object-fit: cover;
    }

	.button-press{
		padding: 5px;
	}

	.pdf{
		padding: 5px;
		margin-top: 5px;
	}

	.separator-line{
	width: 100%;
	height: 4px;
	background-image: linear-gradient(to right, #8b33c5, #15a0e1);
	}

	.title{
		padding: .5em;
		border-left: 2px solid blue;
		background: #eee;
	}
	th{
		font-size: 12px;
	}

	td{
		font-size: 12px;
	}

	@media (max-width: 780px){
		.buong-box{
			padding: 5px;
		}
		.table{
			overflow-x: auto;
		}

		.table-con{
			padding: 5px;
			overflow-x: auto;
		}

		h4{
			padding: 5px;
		}

		.FILE{
			display: none;
		}
		.separator-line{
		width: 100%;
		height: 4px;
		background-image: linear-gradient(to right, #8b33c5, #15a0e1);
		}

	}
</style>

<body>

<?php


?>

<div class="buong-box">
		<div>
			<h4 class="title">Pending Candidates Application</h4>
			</div>
			<div class="table-con">
			<div class="separator-line"></div>
			<table class="table table-hover table-responsive">
			
				<caption>List of Requests</caption>
			<thead>
				<tr>
					<th hidden>id</th>
					<th>LRN</th>
					<th>Name</th>
					<th>Grade</th>
					<th>Section</th>
					<th hidden>Position</th>
					<th>Motto</th>
					<th>Picture</th>
					<th class="FILE">FILE</th>
					<th>Operation</th>
				</tr>
			</thead>
			<tbody>
				<?php	
			//$query=mysqli_query($conn,"select * from userlogin ORDER BY CtrlNum DESC");
			while($row=mysqli_fetch_array($candidate_request)){?>
				<tr>
					<td hidden><?php echo $row['id']?></td>
					<td><?php echo $row['LRN']?></td>
					<td><?php echo $row['Name']?></td>
					<td><?php echo $row['grade']?></td>
					<td ><?php echo $row['section']?></td>
					<td hidden><?php echo $row['Position']?></td>
					<td class="truncate"><?php echo $row['Motto']?></td>
					<td><img class="profile-candidate" src="<?php echo $row['picture']?>"></td>
					<td class="FILE">
						<a href="pdf_file.php?pdf=<?php echo $row['pdf']; ?>" class="btn btn-sm btn-danger pdf">PDF</a>
					</td>
					<td>
					<div class="d-flex justify-content-between space-button">
							<div class="button-press">
							<form action="crudFunctions.php" method="post">
								<input type="text" value="<?php echo $row['LRN']?>"  name="lrn" hidden>
								<input type="text" value="<?php echo $row['Name']?>"  name="name" hidden>
								<input type="submit" name="confirmed_pageant" value="Confirm" class="btn btn-sm btn-primary">
							</form>
							</div>
							<div class="button-press">
							<form action="crudFunctions.php" method="post">
								<div>
								<input type="text" value="<?php echo $row['LRN']?>" name="lrn" hidden>
								</div>
								<div>
								<input type="text" value="<?php echo $row['Name']?>"  name="name" hidden>
								</div>
								<input type="submit" name="declined_pageant" value="Decline" class="btn btn-sm btn-secondary">
							</form>
							</div>					
						</div>
					</td>
	
				</tr>
			<?php } ?>
			</tbody>
		</table>
			</div>
		</div>
</body>