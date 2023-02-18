<?php
session_start();
$title = "Requests";
include "connection.php";
include "session/session.php";
require "include/headerAdmin.php";

$conn = mysqli_connect($host, $user, $password, $db);
$candidate_request = mysqli_query($conn, "SELECT * FROM candidates WHERE confirm = 1");
$candidate_row = mysqli_query($conn, "SELECT * FROM candidates");


$pending = mysqli_query($conn, "SELECT count(*) FROM candidates WHERE confirm = 1");

$declined = mysqli_query($conn, "SELECT count(*) FROM candidates WHERE confirm = 3");

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

	.nav-pending{
		text-decoration: none;
		margin-bottom: 1em;
	}

	.box-pending{
		margin-bottom: 1em;
	}

	.box-pending{
		margin-bottom: 1em;
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
	}

	.first-btn{
		margin-right: 8px;
	}

	.app-pending{
		width: 100%;
		display: grid;
		grid-template-columns: 1fr 1fr;
	}

	.title-page{
		display: flex;
		flex-direction: row;
		align-items: center;
	}

	th{
		font-size: 12px;
	}
	
	td{
        font-size: 12px;
    }

	.trun-platform{
	font-size: 12px;
	text-align: justify;
	width: 100px;
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
		<div class="app-pending">
			<div class="title-page">
			<h5>Pending Candidates Application</h5>
			</div>
			<div class="box-pending">
                <a class="btn btn-primary first-btn" href="requests.php">Pending (<?php while ($rowUser = mysqli_fetch_array($pending)){ 
					echo $rowUser['count(*)'];
				}?>)</a>

			<a class=" btn btn-outline-danger" href="decline.php">Declined (<?php while ($rowDeclined = mysqli_fetch_array($declined)){ 
					echo $rowDeclined['count(*)'];
				}?>)</a>
            </div>
		</div>

			
			<div class="separator-line"></div>
			<div class="table-con">
			<table class="table table-hover table-responsive">
			
				<caption>List of Requests</caption>
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
					<th>COC</th>
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
					<td hidden><?php echo $row['grade']?></td>
					<td hidden><?php echo $row['section']?></td>
					<td><?php echo $row['Position']?></td>
					<td class="truncate"><p class="trun-platform"><?php echo $row['Platform']?></p></td>
					<td><img class="profile-candidate" src="<?php echo $row['picture']?>"></td>
					<td>
						<a href="pdf_file.php?pdf=<?php echo $row['pdf']; ?>" class="btn btn-sm btn-danger pdf">PDF</a>
					</td>
					<td>
					<div class="d-flex justify-content-between space-button">
							<div class="button-press">
							<form action="crudFunctions.php" method="post">
								<input type="text" value="<?php echo $row['LRN']?>"  name="lrn" hidden>
								<input type="text" value="<?php echo $row['Name']?>"  name="name" hidden>
								<input type="submit" name="confirmed" value="Confirm" class="btn btn-sm btn-primary">
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
								<input type="submit" name="declined" value="Decline" class="btn btn-sm btn-secondary">
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