<?php 
    session_start();
    $title = 'Student';
    include 'include/headerStudent.php';
    include "connection.php";
    include 'session/sessionStudent.php';
    

    $conn=mysqli_connect($host,$user,$password,$db);
    $position = mysqli_query($conn,"SELECT * FROM position");
    
    foreach($query_voter as $row_candidate => $candidate){
        $candidate_lrn = $candidate['LRN']; 
    }

    $voted = mysqli_query($conn, "SELECT * FROM voted WHERE LRN = $candidate_lrn");

    $parse = parse_ini_file('config.ini', FALSE, INI_SCANNER_RAW);
    $title = $parse['election_title'];
    $parse_open = parse_ini_file('open.ini', FALSE, INI_SCANNER_RAW);
    $voting_close_open = $parse_open['open_voting'];
?>

<style>

    .con-carousel{
        max-width: 750px;
        height: 10vh;
    }

    section{
        padding-top: 1em;
        max-width: 1200px;
        margin: auto;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        padding-bottom: 2em;
        margin-bottom: 3em;
    }

    .card{
        width: 13rem;
        
    }

    .con-car{
        max-width: 100%;
        margin: auto;
    }

    .image-cover{
        object-fit: cover;
        background-image: linear-gradient(to right, rgba(0,0,0,0.5), rgba(0,0,0,0.8));
    }

    .carousel-item:after{
        content:'';
        position:absolute;
        left:0; top:0;
        width:100%; height:100%;
        display:inline-block;
        background-image: linear-gradient(to right, rgba(0,0,0,0.5), rgba(0,0,0,0.7));
    }

    .img-candidates{
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .two-buttons{
        display: flex;
        flex-direction: row;
        align-items: flex-start;
    }
    .padd-r{
      margin-right: 3px;
    }
    .title-action{
        max-width: 1200px;
        padding-bottom: 2em;
        padding-top: 2em;
        margin: auto;
        text-align: center;
        font-family: 'Poppins', sans-serif;
    }

    .title-action h1{
        padding-top: 1em;
        font-weight: 600;
    }



    .separator-line{
	width: 100%;
	height: 4px;
	background-image: linear-gradient(to right, #8b33c5, #15a0e1);
    }

    .card:hover{
        box-shadow: 10px 6px 10px lightblue;
        border-color: lightblue;
        transition: .3s ease;
    }

    @media (max-width: 1000px){
        section{
            width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        margin: auto;
        }

        section .card{
            width: 18rem;
            margin: auto;
            margin-top: 1em;
            margin-bottom: 1em;
        }

        .separator-line{
	    width: 100%;
	    height: 4px;
	    background-image: linear-gradient(to right, #8b33c5, #15a0e1);
        }

        .bottom-separator{
            width: 100%;
            margin: auto;
        }

        .carousel-mobile{
          display: none;
        }
    }


    
</style>

<?php include 'side_scroll.php'?>
  <body >
    <!-- PAGEANT MODAL STARTS HEREEEEEE!!!!!!!.......... -->

 <div class="modal fade" id="pageant" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
    
      <!-- Modal content-->
      <!-- mag susubmit for pageant -->
      <div class="modal-content">
        <div class="modal-header">
			<h4 class="modal-title text-mute">Pageant </h4>
          
        </div>

		<form action="crudFunctionsStudent.php" method="post" enctype="multipart/form-data">
		<div class="modal-body input-group mb-3">
       <?php
       $validate_pageant = 1;
       $sql_pageant = "SELECT * FROM pageant_candidates WHERE LRN='$candidate_lrn'";
       $run_pageant = mysqli_query($conn,$sql_pageant);

       if($run_pageant->num_rows > 0){
        foreach($run_pageant as $candidate_pageant => $pageant){
          $confirm = $pageant['confirm'];
            if($confirm == 1){
              ?>
               <p style="text-align: center;">Your Application for <b>PAGEANT</b> is in the Process, just wait until we have finished Evaluate your Entry.</p>
              </div>
                <div class="modal-footer">
                <form action="crudFunctionsStudent.php" method="post">
                    <input type="number" name="entry_pageant" value="<?php echo $_SESSION["lrn"]?>" hidden readonly>
                  <button type="submit" class="btn btn-primary" name="unsubmit_pageant">Unsubmit</button>
                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                  </form>
                </div>
              <?php
            }elseif($confirm == 2){
               echo '<p style="text-align: center;">Your Application for <b>PAGEANT</b> is in the Process, just wait until we have finished Evaluate your Entry.</p>';
              ?>
              <p>Your Entry has been Confirm</p>
              </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                </div>
              <?php
            }else{
              // echo 'Sorry to inform you that your Submitted COC was Declined';
              ?>
              <p>Sorry to inform you that your Submitted COC was Declined</p>
              </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                </div>
              <?php
            }
         }
       }else{
        foreach($query_voter as $row_voter => $user){
         $LRN = $user['LRN'];

          $sellrn = "SELECT * FROM userlogin WHERE LRN = '$LRN'";
          $resultlrn = mysqli_query($conn, $sellrn);

          foreach($resultlrn as $emails){
            $emailadd = $emails['username']; 
          }

          ?>
          <div class="input-group mb-3" hidden>
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">LRN</span>
                </div>
                <input type="text" class="form-control" name="email" value="<?php echo $emailadd;?>" aria-describedby="basic-addon1" required readonly>
                <input type="text" class="form-control" name="LRN" value="<?php echo $user['LRN'];?>" aria-describedby="basic-addon1" required readonly>
          </div>

          <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Name</span>
                </div>
         
                <input type="text" class="form-control input-group-text" name="fullname" value="<?php echo $user['fullname'];?>" aria-describedby="basic-addon1" required readonly>
          </div> 

          <div class="input-group mb-3" hidden>
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Grade</span>
                </div>
                <input type="text" class="form-control" name="grade" value="<?php echo $user['grade'];?>" aria-describedby="basic-addon1" required readonly>
          </div>

          <div class="input-group mb-3" hidden>
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Gender</span>
                </div>
                <input type="text" class="form-control" name="gender" value="<?php echo $user['gender'];?>" aria-describedby="basic-addon1" required readonly>
          </div>

          <div class="input-group mb-3" hidden>
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Section</span>
                </div>
                <input type="text" class="form-control" name="section" value="<?php echo $user['section'];?>" aria-describedby="basic-addon1" required readonly>
          </div>


          <input type="text" name="position" value="none" hidden>
          <!-- <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Position</span>
                </div>
                <select name="position" class="form-control" required>
                  <option value="" disabled selected>Select Position</option>
                </select>
          </div> -->

          <div class="input-group mb-3" hidden>
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">confirm</span>
                </div>
                <input type="text" class="form-control" name="confirm" value="1" aria-describedby="basic-addon1" required>
          </div>
          
          <p style="font-size: 13px; text-align: center;" class="text-secondary">NOTE: Can upload 10 mb image file</p>

          <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">PDF</span>
                </div>
                <input type="file" class="form-control" name="pdf_file" accept="application/pdf" aria-describedby="basic-addon1" required>
          </div>
          
          <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Picture</span>
                </div>
                <input type="file" class="form-control" name="picture_file" accept="image/x-png,image/gif,image/jpeg" aria-describedby="basic-addon1" required>
          </div>
      
          <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Motto</span>
                </div>
                <textarea name="platform"  class="form-control"  id="platform3" cols="10" rows="5" aria-describedby="basic-addon1"></textarea>
          </div>
            <?php
            $default = date_default_timezone_set('Asia/Manila');
            // $date = date("F j, Y, g:i a");
            $t = date('Y-m-d H:i:s');
            // $current_date = date('F j, Y, g:i a', strtotime($date));
            ?>
          <input type="text" name="date" value="<?php echo $t?>" hidden>
          <?php
        }
      ?>
      </div>
    <div class="modal-footer">
		<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary" name="submit_application">Submit</button>
		</div>

        
      <?php
       }
       ?>
    </div>
	  </form>
    </div>
  </div>
</div>

  <div class="modal fade" id="coc" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
			<h4 class="modal-title text-mute">Certificate of Candidacy</h4>
          
        </div>

		<form action="crudFunctionsStudent.php" method="post" enctype="multipart/form-data">
		<div class="modal-body input-group mb-3">
       <?php
       $validate = 1;
       $sql_candidate = "SELECT * FROM candidates WHERE LRN='$candidate_lrn'";
       $run = mysqli_query($conn,$sql_candidate);

       if($run->num_rows > 0){
        foreach($run as $candidate_coc => $coc){
          $confirm = $coc['confirm'];
            if($confirm == 1){
              echo '<p style="text-align: center;">Your <b>CERTIFICATE OF CANDIDACY</b> is in the <b>Process</b>, Just wait until we have finished Evaluate your File.';
              ?>
              </div>
                <div class="modal-footer">
                  <form action="crudFunctionsStudent.php" method="post">
                    <input type="number" name="entry_coc" value="<?php echo $_SESSION['lrn']?>" hidden readonly>
                  <button type="submit" class="btn btn-primary" name="unsubmit_coc">Unsubmit</button>
                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                  </form>
                </div>
              <?php
            }elseif($confirm == 2){
              ?>
              <p>You are now Running for <?php echo $coc['Position'];?></p>
              </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                </div>
              <?php
            }else{
              echo 'Sorry to inform you that your Submitted COC was Declined';
              ?>
              </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                </div>
              <?php
            }
         }
       }else{
        foreach($query_voter as $row_voter => $user){

          $LRN = $user['LRN'];


          $sellrn = "SELECT * FROM userlogin WHERE LRN = '$LRN'";
          $resultlrn = mysqli_query($conn, $sellrn);

          foreach($resultlrn as $emails){
            $emailadd = $emails['username']; 
          }


          ?>
          <div class="input-group mb-3" hidden>
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">LRN</span>
                </div>
                <input type="text" class="form-control" name="email" value="<?php echo $emailadd;?>" aria-describedby="basic-addon1" required readonly>
                <input type="text" class="form-control" name="LRN" value="<?php echo $user['LRN'];?>" aria-describedby="basic-addon1" required readonly>
          </div>

          <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Name</span>
                </div>
                <input type="text" class="form-control input-group-text" name="fullname" value="<?php echo $user['fullname'];?>" aria-describedby="basic-addon1" required readonly>
          </div> 

          <div class="input-group mb-3" hidden>
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Grade</span>
                </div>
                <input type="text" class="form-control" name="grade" value="<?php echo $user['grade'];?>" aria-describedby="basic-addon1" required readonly>
          </div>

          <div class="input-group mb-3" hidden>
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Gender</span>
                </div>
                <input type="text" class="form-control" name="gender" value="<?php echo $user['gender'];?>" aria-describedby="basic-addon1" required readonly>
          </div>

          <div class="input-group mb-3" hidden>
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Section</span>
                </div>
                <input type="text" class="form-control" name="section" value="<?php echo $user['section'];?>" aria-describedby="basic-addon1" required readonly>
          </div>

          <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Position</span>
                </div>
                <select name="position" class="form-control" required>
                  <option value="" disabled selected>Select Position</option>
                  <?php 
                    foreach($position as $candidate_position => $available){
                      ?>
                        <option value="<?php echo $available['position'];?>"><?php echo $available['position'];?></option>
                      <?php
                    }
                  
                  ?>
                </select>
          </div>

          <div class="input-group mb-3" hidden>
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">confirm</span>
                </div>
                <input type="text" class="form-control" name="confirm" value="1" aria-describedby="basic-addon1" required>
          </div>
          <p style="font-size: 13px; text-align: center;" class="text-secondary">NOTE: Can upload 10 mb image file</p>
          <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">PDF</span>
                </div>
                <input type="file" class="form-control" name="pdf_file" accept="application/pdf" aria-describedby="basic-addon1" required>
          </div>

          <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Picture</span>
                </div>
                <input type="file" class="form-control" name="picture_file" accept="image/x-png,image/gif,image/jpeg" aria-describedby="basic-addon1" required>
                
          </div>
          <br>
  
          <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Platform</span>
                </div>
                <textarea name="platform"  class="form-control"  id="platform3" cols="10" rows="5" aria-describedby="basic-addon1"></textarea>
          </div>

          
          <?php
          $default = date_default_timezone_set('Asia/Manila');
          // $date = date("F j, Y, g:i a");
          $t = date('Y-m-d H:i:s');
          ?>
          <input type="text" name="date" value="<?php echo $t?>" hidden>
          <?php
        }
      ?>
      </div>
    <div class="modal-footer">
		<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-primary" name="submit_coc">Submit</button>
		</div> 
      <?php
       }
       ?>
    </div>
	  </form>
    </div>
  </div>
</div>



<?php

if(isset($_GET['added'])){
  echo "
  <script>
      Swal.fire(
      'Success!',
      'Thank you for participating, we will review your Application. Please Bear with us',
      'success'
      )
</script>
  
  ";
}

if(isset($_GET['success'])){
			
  $added = $_GET['success'];
echo "
<script>
  Swal.fire(
  'Update Complete!',
  '".$added."',
  'success'
  )
</script>

";
unset( $_GET['success']);
}

//Error handling
if(isset($_GET['error'])){
			
  $added = $_GET['error'];
echo "
<script>
  Swal.fire(
  'Image was too big!',
  '".$added."',
  'error'
  )
</script>

";
unset( $_GET['error']);
}

//Error Delete
if(isset($_GET['deleted'])){
			
  $added = $_GET['deleted'];
echo "
<script>
  Swal.fire(
  'Success!',
  '<b>".$added."</b> <br>has been Removed!',
  'success'
  )
</script>
";
unset( $_GET['deleted']);
}


?>



<!-- PAGEANT MODAL ENDS HEREEEEEEEEEEEE!!!!!!!...... -->
    
    <div id="carouselExampleIndicators" class="carousel slide con-car carousel-mobile" data-bs-ride="true">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="assets/1.JPG" alt="" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100 image-cover" width="800" height="400">
            <div class="carousel-caption d-none d-md-block">
      </div>
        </div>
        <div class="carousel-item">
        <img src="assets/2.JPG" alt="" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100 image-cover" width="800" height="400">
        <div class="carousel-caption d-none d-md-block">
      </div>
    
        </div>
        <div class="carousel-item">
        <img src="assets/3.JPG" alt="" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100 image-cover" width="800" height="400">
        <div class="carousel-caption d-none d-md-block">
      </div>
    </div>

      <div class="carousel-item">
        <img src="assets/4.JPG" alt="" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100 image-cover" width="800" height="400">
        <div class="carousel-caption d-none d-md-block">
      </div>
        </div>

        <div class="carousel-item">
        <img src="assets/5.JPG" alt="" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100 image-cover" width="800" height="400">
        <div class="carousel-caption d-none d-md-block">
      </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
      <div class="separator-line"></div>
    </div>
    
    <div class="title-action">
    <h1>Lets Take Some Action <i class="fa-solid fa-face-smile-wink"></i></h1>
    </div>

    <section>
    <div class="card">
    <img class="card-img-top img-candidates" src="assets/button.gif" alt="Card image cap">
    <div class="card-body">
    <h5 class="card-text">Vote Now!</h5>
    <p class="card-text">Keep calm and vote wisely.</p>
    <?php 
      if($voting_close_open == 'open'){        
          foreach($voted as $vote_validate){
            $voter_val = $vote_validate['LRN'];
          }

          if($voter_val == $candidate_lrn){
            echo '<a class="btn btn-success btn-sm" disabled><i class="fa-solid fa-file"></i> Voted</a>';
          }else{
            echo '<a class="btn btn-primary btn-sm" href="termsAndConditions.php"><i class="fa-solid fa-file"></i> Election</a>';
          }
        }else{
          echo '<a class="btn btn-danger btn-sm"><i class="fa-solid fa-file"></i> Closed</a>';
        }

      ?>
    </div>
    </div>


    <div class="card">
    <img class="card-img-top img-candidates" src="assets/can.gif" alt="Card image cap">
    <div class="card-body">
    <h5 class="card-text">Candidates</h5>
    <p class="card-text">See the list of Candidates</p>
    <div class="two-buttons">
    <a class="btn btn-primary btn-sm padd-r" href="listofcandidates.php"><i class="fa-solid fa-right-to-bracket"></i>Election</a>
    <a class="btn btn-primary btn-sm" href="student_pageant_list.php"><i class="fa-solid fa-right-to-bracket"></i>Pageant</a>
    </div>
    </div>
    </div>

    <div class="card">
    <img class="card-img-top img-candidates" src="assets/pageant.gif" alt="Card image cap">
    <div class="card-body">
    <h5 class="card-text">Download/Submit</h5>
    <p class="card-text">Submit your Entry for <b> Pageant </b></p>
    <a class="btn btn-primary btn-sm" href="Pageant.pdf" download="Pageant_Application_form" data-toggle="tooltip" data-placement="bottom" title="Download Application Form"><i class="fa-solid fa-download"></i></a>
    <?php
        if($voting_close_open == 'open'){
        if($run_pageant->num_rows > 0){
          foreach($run_pageant as $candidate_pageant => $pageant){
            $confirm = $pageant['confirm'];
              if($confirm == 1){
                echo '<a class="btn btn-sm btn-warning submit_application" data-toggle="modal" data-target="#pageant"><span class="spinner-grow spinner-grow-sm text-dark" role="status" aria-hidden="true"></span> Pending...</a>';
              }elseif($confirm == 2){
                echo '<a class="btn btn-sm btn-success submit_application" data-toggle="modal" data-target="#pageant">Confirmed</a>';
              }else{
                echo '<a class="btn btn-sm btn-danger submit_application" data-toggle="modal" data-target="#pageant">Declined</a>';
              }
           }
         }else{
          echo '<a class="btn btn-sm btn-primary submit_application" data-toggle="modal" data-target="#pageant">Submit</a>';
         }
        }else{
          ?><a class="btn btn-sm btn-primary submit_application" data-toggle="modal" data-target="#pageant" data-placement="bottom" title="Submit Application Form">Application Form</a>
          <?php
        }
      
      ?>
    </div>
    </div>

    <div class="card">
    <img class="card-img-top img-candidates" src="assets/document-office.gif" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-text">Download/Submit</h5>
    <p class="card-text">Download or Submit your <strong>COC</strong> here</p>
    <a class="btn btn-primary btn-sm btn-sm" href="COC.pdf" download="Certificate_of_Candidacy" data-toggle="tooltip" data-placement="bottom" title="Download COC"><i class="fa-solid fa-download"></i></a>
    <!-- <a class="btn btn-sm btn-primary submit_coc" data-toggle="modal" data-target="#coc">Submit COC</a> -->
      <?php
        if($voting_close_open == 'open'){
        if($run->num_rows > 0){
          foreach($run as $candidate_coc => $coc){
            $confirm = $coc['confirm'];
              if($confirm == 1){
                echo '<a class="btn btn-sm btn-warning submit_coc" data-toggle="modal" data-target="#coc"><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Pending...</a>';
              }elseif($confirm == 2){
                echo '<a class="btn btn-sm btn-success submit_coc" data-toggle="modal" data-target="#coc">Confirmed</a>';
              }else{
                echo '<a class="btn btn-sm btn-danger submit_coc" data-toggle="modal" data-target="#coc">Declined</a>';
              }
           }
         }else{
          echo '<a class="btn btn-sm btn-primary submit_coc" data-toggle="modal" data-target="#coc">Submit</a>';
         }
        }else{
          ?><a class="btn btn-sm btn-primary submit_coc" data-toggle="modal" data-target="#coc">Close</a>
          <?php
        }
      
      ?>
    </div>
    </div>

    <div class="card">
    <img class="card-img-top img-candidates" src="assets/vote_toggle.gif" alt="Card image cap">
    <div class="card-body">
    <h5 class="card-text">Voting Guidelines</h5>
    <p class="card-text">Know the Rules and Regulation about Voting</p>
    <a class="btn btn-primary btn-sm" href="voters_education.php"  data-toggle="tooltip" data-placement="bottom" title="Voting Guidelines"><i class="fa-solid fa-check-to-slot"></i></a>
    </div>
    </div>

    </section>

    <div class="separator-line bottom-separator"></div>


    <?php include "footer.php";?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
      $(document).ready(function (){

          $('.submit_coc').on('click', function(){
            $('#coc').modal('hide');
          }); 

    });


    $(document).ready(function (){

$('.submit_application').on('click', function(){
  $('#pageant').modal('hide');
}); 

});
    </script>
    
  </body>