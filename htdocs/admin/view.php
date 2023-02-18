<?php
session_start();
$title = "VIEW INFO";
include 'connection.php';
require_once "include/headerAdmin.php";
include "session/session.php";


$i = $_GET['ii'];
$numlrn = $_GET['numlrn'];
$fname = $_GET['fname'];
$grade = $_GET['grade'];
$section = $_GET['section'];
$uname = $_GET['uname'];
$pword = $_GET['pword'];
$qr = $_GET["qr"];

$width = 250;
$height = 250;
$res = "$qr&chs={$width}x{$height}&chl={$numlrn}&{$fname}";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>View</title>
</head>

<style type="text/css">

	.container-form{
		max-width: 750px;
		margin: auto;
		padding: .5em;
		font-family: 'Poppins', sans-serif;
		margin-bottom: 1em;
	}

	.field-info{
		display: flex;
		flex-direction: column;
		padding: 12px;
	}

	.userAccount{
		display: flex;
		flex-direction: column;
	}

	h5{
		font-size: clamp(1rem, 1.5vh, 5rem);
		background: #a0c3d6;
		padding: 12px;
		border-radius: 20px;
		color: 	#232b2b;
	}

	h3{
		align-items: center;
		padding: 12px;
	}

	.gridForyou{
		display: grid;
		grid-template-columns: 1fr 1fr;
		grid-gap: 5px;
	}

	.button a{
		background:  #a0c3d6;
		padding: 1em;
		text-decoration: none;
		color: #333;
		font-family: 'Poppins', sans-serif;
		font-weight: bold;
		font-size: clamp(1.3rem, 1.5vh, 5rem);
		border-radius: 20px;
	}
	.back_btn{
		display: none;
	}


	@media (max-width: 750px){
		.container-form{
		margin: auto;
	}

	h5{
		border-radius: 1px;
	}

	.back_btn{
		display: block;
		font-size: 2em;
	}

	.gridForyou{
		display: flex;
		flex-direction: column;
	}

	}

</style>
<body>



	<div class="container-form">
		<a href="voterslist.php" class="back_btn"><i class="fa-solid fa-circle-arrow-left"></i></a>
		<h3>VOTERS DETAILS</h3>

		<div class="field-info">
		<div class="gridForyou">

			<div>
				<h5>Ctrl #: <strong style="text-transform:uppercase; color: #000;"><?php echo $i;?></strong></h5>
			</div>
			<div>
				<h5>LRN: <strong style="text-transform:uppercase; color: #000;"><?php echo $numlrn; ?></strong></h5>	
			</div>
		</div>
		</div>

		<div class="field-info">
			<h5>Full Name: <strong style="text-transform:uppercase; color: #000;"><?php echo $fname; ?></strong></h5>
		</div>

		<div class="field-info">
			<div class="gridForyou">

				<div>
					<h5>Grade: <strong style="text-transform:uppercase; color: #000;"><?php echo $grade; ?></strong></h5>
				</div>
				<div>
					<h5>Section: <strong style="text-transform:uppercase; color: #000;"><?php echo $section; ?></strong></h5>
				</div>
			</div>
		</div>

		<div class="field-info userAccount">
			<div><h3>Account Details</h3></div>
			<div>
				<h5>Username: <strong style="color: #000;"><?php echo $uname; ?></strong></h5>
			</div>
		</div>

		<div class="field-info margin_bottom">
			<div><h3>QR Code</h3></div>
			<img src="<?php echo $res;?>">
				<div class="button" style="margin: auto;">
					 <p>Please Take a screenshot for now</p>
				</div>
				
		</div>
		
	</div>
</body>
</html>