<?php
	session_start();
	include 'session/sessionStudent.php';
	include 'slugify.php';
	include 'connection.php';

	$conn=mysqli_connect($host,$user,$password,$db);
	$voters_qr_code = $_GET['lrn'];

	if(isset($_POST['vote'])){
		if(count($_POST) == 1){
			$_SESSION['error'][] = 'Please vote atleast one candidate';
			header("location:voting_ballot.php?lrn=$voters_qr_code");
		}
		else{
			$_SESSION['post'] = $_POST;
			$sql = "SELECT * FROM position";
			$query = $conn->query($sql);
			$error = false;
			$sql_array = array();
			while($row = $query->fetch_assoc()){
				$position = slugify($row['position']);
				$pos_id = $row['id'];
				if(isset($_POST[$position])){
					if($row['max_vote'] > 1){
						if(count($_POST[$position]) > $row['max_vote']){
							$error = true;
							$_SESSION['error'][] = 'You can only choose '.$row['max_vote'].' candidates for '.$row['position'];
							header("location:voting_ballot.php?lrn=$voters_qr_code");
						}
						else{
							foreach($_POST[$position] as $key => $values){
								$sql_array[] = "INSERT INTO votes (voters_lrn, candidate_lrn, Grade) VALUES ('".$voter['LRN']."', '$values', '".$voter['grade']."')";
								if($sql_array){
									$sql = "SELECT * FROM voted WHERE LRN =$voters_qr_code";
									$run = mysqli_query($conn, $sql);
									if(mysqli_num_rows($run)){
										header('location:scanner.php?error=Already voted');
									}else{
										$sql = "SELECT * FROM userlogin WHERE LRN =$voters_qr_code";
										$result = mysqli_query($conn, $sql);
										foreach($result as $voted_user){
											$voted = "INSERT INTO voted (`LRN`, `Name`, `Grade`) VALUES ('".$voted_user['LRN']."', '".$voted_user['fullname']."','".$voted_user['grade']."')";
											$run = mysqli_query($conn, $voted);
											if($run){
												$action = "Submit Votes";
												$logs="INSERT INTO `logs`( `user_id`, `name`, `action`) VALUES ('".$voted_user['LRN']."','".$voted_user['fullname']."','$action')";
												$run_logs = mysqli_query($conn,$logs);
												header('location:scanner.php');
											}
										}

									}
								}
								header('location:scanner.php');
							}

						}
						
					}
					else{
						$candidate = $_POST[$position];
						$sql_array[] = "INSERT INTO votes (voters_lrn, candidate_lrn, Grade) VALUES ('".$voter['LRN']."', '$candidate','".$voter['grade']."')";
						if($sql_array){
							$sql = "SELECT * FROM voted WHERE LRN =$voters_qr_code";
							$run = mysqli_query($conn, $sql);
							if(mysqli_num_rows($run)){
								header('location:scanner.php?error=Already voted');
							}else{
								$sql = "SELECT * FROM userlogin WHERE LRN =$voters_qr_code";
								$result = mysqli_query($conn, $sql);
								foreach($result as $voted_user){
									$voted = "INSERT INTO voted (`LRN`, `Name`, `Grade`) VALUES ('".$voted_user['LRN']."', '".$voted_user['fullname']."','".$voted_user['grade']."')";
									$run = mysqli_query($conn, $voted);
									if($run){
										$action = "Submit Votes";
										$logs="INSERT INTO `logs`( `user_id`, `name`, `action`) VALUES ('".$voted_user['LRN']."','".$voted_user['fullname']."','$action')";
										$run_logs = mysqli_query($conn,$logs);
										header('location:scanner.php');
									}
								}

							}
						header('location:scanner.php');
						
						}
						
					}

				}
				
			}

			if(!$error){
				foreach($sql_array as $sql_row){
					$conn->query($sql_row);
				}

				unset($_SESSION['post']);
				$_SESSION['success'] = 'Ballot Submitted';

			}

		}

	}
	else{
		$_SESSION['error'][] = 'Select candidates to vote first';
		header("location:voting_ballot.php?lrn=$voters_qr_code");
	}
	

?>