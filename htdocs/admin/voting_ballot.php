<?php
session_start();
$title = 'Student';
include 'include/headerStudent.php';
include "connection.php";
include 'session/sessionStudent.php';

$conn=mysqli_connect($host,$user,$password,$db);


$voters_qr_code = $_GET['lrn'];
					foreach($query_voter as $can){
        				$voters_lrn =  $can['LRN'];
						if($voters_qr_code == $voters_lrn){
							
							?>
							<div class="pad-info">
								<div class="voters-info">
									<div class="info-content">
										<div><p>LRN: <strong> <?php echo $voters_lrn; ?></strong></p></div>
										<div><p>Fullname: <strong> <?php echo $can['fullname'];?></strong></p></div>
										<div><p>Grade: <strong> <?php echo $can['grade'];?></strong></p></div>
										<div><p>Section: <strong> <?php echo $can['section'];?></strong></p></div>
									</div>
									<div class="info-content"><img src="<?php echo $can['qr_code'];?>" alt="" width="150px" height="150px"></div>
								</div>
								<hr>
								</div>
							<?php
						}else{
							header('location: scanner.php?notYou= Your QR does not match the Credential in this account!');
						}
						
					}

?>

<style>
    .ballot{
        max-width: 870px;
        margin: auto;
        text-align: center;
    }

    .ballot_promax{
        max-width: 870px;
        margin: auto;
    }

    li{
        list-style: none;
    }

    .voters-info{
        max-width: 870px;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Poppins', sans-serif;
		background: #333;
		color: #fff;
    }

	.info-content > img{
		border-radius: 20px;
	}

    .info-content{
        padding: 1em;
    }

	.pad-info{
		max-width: 870px;
		margin: auto;
		margin-top: 1em;
		margin-bottom: 1em;
	}

	input{
		margin-right: 1em;
	}

	li > img{
		max-width: 200px;
		height: 120px;
	}

	span{
		margin-left: 1em;
	}

	.clist{
		max-width: 100px;
		object-fit: cover;
	}

	.pad{
		padding: 5px;
		font-family: 'Poppins', sans-serif;
	}

	.pad img{
		width: 100px;
		height: 100px;
		object-fit: cover;
	}

	
	@media (max-width: 780px){
		.voters-info{
			margin: 5px;

		}

		.row{
			width: 100%;
		}

		.col-xs-12{
			width: 100%;
		}

		.ballot_promax{
			margin: 5px;
		}

		.pad-info{
		margin-top: 5px;
		margin-bottom: 1em;
		}

		input{
		margin-right: 0;
		}

		span{
		margin-left: 5px;
		}

		li > img{
		max-width: 80px;
		height: 80px;
		}

		.pad{
		padding: 3px;
		width: 100%;
		font-family: 'Poppins', sans-serif;
		}

		.pad span{
			font-size: 12px;
			font-weight: bold;
			font-family: 'Poppins', sans-serif;
			text-align: center;
		}

		.submit-btn{
			padding: 3em;
		}
	}
</style>

<body>

    <div class="ballot">
    <h1 class="page-header text-center title"><b><?php
	$parse = parse_ini_file('config.ini', FALSE, INI_SCANNER_RAW);
	$title_elect = $parse['election_title'];
	 echo strtoupper($title_elect); ?></b></h1>
	        	<div>
	        		<?php
				        if(isset($_SESSION['error'])){
				        	?>
				        	<div class="alert alert-danger alert-dismissible">
				        		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					        	<ul>
					        		<?php
					        			foreach($_SESSION['error'] as $error){
					        				echo "
					        					<li>".$error."</li>
					        				";
					        			}
					        		?>
					        	</ul>
					        </div>
				        	<?php
				         	unset($_SESSION['error']);

				        }
				        if(isset($_SESSION['success'])){
				          	echo "
				            	<div class='alert alert-success alert-dismissible'>
				              		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				              		<h4><i class='icon fa fa-check'></i> Success!</h4>
				              	".$_SESSION['success']."
				            	</div>
				          	";
				          	unset($_SESSION['success']);
				        }

				    ?>
 
				    <div class="alert alert-danger alert-dismissible" id="alert" style="display:none;">
		        		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			        	<span class="message"></span>
			        </div>

				</div>
	
	<hr>
    </div>
	
    <div class="ballot_promax">
		
    <?php				
					
				    	$sql = "SELECT * FROM votes WHERE voters_lrn = $voters_qr_code";
				    	$vquery = $conn->query($sql);
				    	if($vquery->num_rows > 0){
				    		?>
				    		<div class="text-center">
					    		<h3>You have already voted for this election.</h3>
					    		<a href="studentHome.php" data-toggle="modal" class="btn btn-primary btn-lg">Home</a>
					    	</div>
				    		<?php
				    	}
				    	else{
				    		?>
			    			<!-- Voting Ballot -->
						    <form method="POST" id="ballotForm" action="submit_ballot.php?lrn=<?php echo $voters_qr_code?>">
				        		<?php
				        			include 'slugify.php';

				        			$candidate = '';
				        			$sql_position = "SELECT * FROM position";
									$query = $conn->query($sql_position);
									while($row = $query->fetch_assoc()){
										$sql = "SELECT * FROM candidates WHERE position='".$row['position']."' AND confirm = 2";
										$cquery = $conn->query($sql);
										while($crow = $cquery->fetch_assoc()){ 
											$slug = slugify($row['position']);
											$checked = '';
											if(isset($_SESSION['post'][$slug])){
												$value = $_SESSION['post'][$slug];

												if(is_array($value)){
													foreach($value as $val){
														if($val == $crow['position']){
															$checked = 'checked';
														}
													}
												}
												else{
													if($value == $crow['position']){
														$checked = 'checked';
													}
												}
											}
											$input = ($row['max_vote'] > 1) ? '<input type="checkbox" class="flat-red '.$slug.'" name="'.$slug."[]".'" value="'.$crow['LRN'].'" '.$checked.'>' : '<input type="radio" class="flat-red '.$slug.'" name="'.slugify($row['position']).'" value="'.$crow['LRN'].'" '.$checked.'>';
											$image = (!empty($crow['picture'])) ? $crow['picture'] : 'images/profile.jpg';
											$candidate .= '
												<li class="pad">
													'.$input.'  <img src="'.$image.'"><span class="cname clist">'.$crow['Name'].'</span>
												</li>
											';
										}
										$instruct = ($row['max_vote'] > 1) ? 'You may select up to <b style="color: blue;">'.$row['max_vote'].'</b> candidates' : 'Select only <b style="color: blue;">one</b> candidate';

										echo '
											<div class="row">
												<div class="col-xs-12">
													<div class="box box-solid" id="'.$row['id'].'">
														<div class="box-header with-border">
															<h3 class="box-title"><b>'.$row['position'].'</b></h3>
														</div>
														<div class="box-body">
															<p>'.$instruct.'
															</p>
															<div id="candidate_list">
																<ul>
																	'.$candidate.'
																</ul>
															</div>

														</div>
													</div>
												</div>
											</div>
											<hr>
										';
										$candidate = '';

									}	

				        		?>
				        		<div class="text-center submit-btn">
					        		<button type="submit" class="btn btn-primary btn-flat" name="vote"><i class="fa fa-check-square-o"></i> Submit</button>
					        	</div>
				        	</form>
				        	<!-- End Voting Ballot -->
				    		<?php
				    	}

				    ?>
              
	        	</div>
	        </div>
	      </section>
	     
	    </div>
        
		</div>
      </div>
    
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $(function(){
        $('.content').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });

        $(document).on('click', '.reset', function(e){
            e.preventDefault();
            var desc = $(this).data('desc');
            $('.'+desc).iCheck('uncheck');
        });

        $(document).on('click', '.platform', function(e){
            e.preventDefault();
            $('#platform').modal('show');
            var platform = $(this).data('platform');
            var fullname = $(this).data('fullname');
            $('.candidate').html(fullname);
            $('#plat_view').html(platform);
        });

	$('#preview').click(function(e){
		e.preventDefault();
		var form = $('#ballotForm').serialize();
		if(form == ''){
			$('.message').html('You must vote atleast one candidate');
			$('#alert').show();
		}
		else{
			$.ajax({
				type: 'POST',
				url: 'preview.php',
				data: form,
				dataType: 'json',
				success: function(response){
					if(response.error){
						var errmsg = '';
						var messages = response.message;
						for (i in messages) {
							errmsg += messages[i]; 
						}
						$('.message').html(errmsg);
						$('#alert').show();
					}
					else{
						$('#preview_modal').modal('show');
						$('#preview_body').html(response.list);
					}
				}
			});
		}
		
	});

});
</script>
</body>


