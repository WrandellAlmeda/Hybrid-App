<?php
session_start();
$title = 'Profile';
include "session/session.php";
include "connection.php";
include "include/headerAdmin.php";




$conn=mysqli_connect($host,$user,$password,$db);

$admin_profile_id = $_SESSION['Ctrl_num'];

$sql_candidate = "SELECT * FROM admin WHERE CtrlNum='$admin_profile_id'";
$run = mysqli_query($conn,$sql_candidate);

while($row = mysqli_fetch_array($run)){
    $id = $row['CtrlNum'];
    $name = $row['fullname'];
    $qr_code = $row['qr_code'];
    $admin_user = $row['username'];
    $user_type =  $row['usertype'];
}
?>
<style>
    .prof-con{
        max-width: 870px;
        margin: auto;
    }

    .custom-bg{
        background: -webkit-linear-gradient(to right, #8b33c5, #15a0e1);
        background: linear-gradient(to right, #8b33c5, #15a0e1);
        transition: 1s;
    }

    .gradient-custom { 
    background: -webkit-linear-gradient(to right bottom, #8b33c5, #15a0e1);
    background: linear-gradient(to right bottom, #8b33c5, #15a0e1);
    }
    .text-center {
        align-items: center;
    }

    .custom-bg:hover{
        background: -webkit-linear-gradient(to left, #8b33c5, #15a0e1);
        background: linear-gradient(to left, #8b33c5, #15a0e1);
    }

    @media (max-width: 800px){
        .prof-con{
        margin: auto;
        font-family: 'Poppins', sans-serif;
    }
    }
</style>

<body>
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
  'There is an error!',
  '".$added."',
  'error'
  )
</script>

";
unset( $_GET['error']);
}

//Error Delete
if(isset($_GET['delete'])){
			
echo "
<script>
  Swal.fire(
  'Success!',
  'Election has been successfully Reset',
  'success'
  )
</script>
";
unset( $_GET['deleted']);
}


?>
    <div class="prof-con">
<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-6 mb-4 mb-lg-0">
        <div class="card mb-3" style="border-radius: .5rem;">
          <div class="row g-0">
            <div class="col-md-4 gradient-custom text-center text-white"
              style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
              
            </div>
            <div class="col-md-8">
              <div class="card-body p-4">
                <h6>Information</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>Email</h6>
                    <p class="text-muted"><?php echo $admin_user; ?></p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Full Name</h6>
                    <p class="text-muted"><?php echo $name; ?></p>
                  </div>
                </div>
                <h6>More Option</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                  <a class="btn btn-primary btn-sm btn_edit_pass" href="#" data-bs-toggle="modal" data-bs-target="#changePassmodal"><i class="fa-solid fa-pen-to-square"></i> Change Password</a>
                  </div>
                  <div class="col-6 mb-3">
                  <div class="dropdown">
                  <a class="btn btn-outline-primary dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">More Options</a>

                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <li><a class="dropdown-item" href="resetPageant.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                      <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                    </svg> Reset Pageant</a>
                  </li>
                    <!-- <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#resetelection"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                      <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                      </svg> Reset Election</a>
                    </li> -->
                  
                    <li><a class="dropdown-item" href="resetElection.php?marie=<?php echo $name?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                      <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                      </svg> Reset Election</a>
                    </li>

                    <li><form action="crudFunctions.php" method="POST"> <button type="submit" name="dlexcel" class="dropdown-item" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0z"/>
                    </svg> Back Up Files<b></form></li>
                    <li><a class="dropdown-item" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                    
                  </ul>
                </div>
                  </div>
                </div>

       
            
                <div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    </div>
</body>




<!-- Reset Pageant Modal -->
<div class="modal fade" id="resetpageant" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Reset Pageant</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="alert alert-danger" role="alert">
  <b>NOTE:</b> THIS WILL DELETE ALL THE DATA FROM THE PAST PAGEANT
</div>
      <h5>Are you sure you want to reset School Pageant?</h5>  
<form action="crudFunctions.php" method="POST">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="resetPageant" class="btn btn-primary">Confirm</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- <div class="modal fade" id="resetpass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Change Password</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="#" method="POST">
          <input type="text" value="<?php echo $id;?>">
          <input type="text">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Confirm</button>
        </form>
      </div>
    </div>
  </div>
</div> -->

<div class="modal fade" id="changePassmodal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
			<h4 class="modal-title">Change Password</h4>
    </div>
		<form action="crudFunctions.php" method="post">
		<div class="modal-body input-group mb-3">

			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="lrn1" onclick="myFunctions()">New Password</span>
			</div>
      <input type="hidden" value="<?php echo $admin_user?>" name="email">
      <input type="hidden" value="<?php echo $id?>" name="id">
      <input type="hidden" value="<?php echo $name?>" name="name">

			<input type="password" class="form-control" name="new_pass" minlength="6" aria-describedby="lrn1" id="myInput" required>
			</div>

			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Re-type Password</span>
			</div>
			<input type="password" class="form-control"  name="re_pass" minlength="6" aria-describedby="basic-addon1" required>
			</div>
      <!-- <input type="checkbox" onclick="myFunctions()" style="float: right;"> Show Password -->
      </div>

		<div class="modal-footer">
			<button type="submit" class="btn btn-primary" name="changeadminpass">Confirm</button>
        
		</div>
	  </form>

</div>
      
    </div>
  </div>
</div>



<!-- Reset Election Modal -->
<div class="modal fade" id="resetelection" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Reset Election</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="alert alert-danger" role="alert">
  <b>NOTE:</b> THIS WILL DELETE ALL THE DATA FROM THE PAST ELECTION
</div>
      <h5>Are you sure you want to reset School Election?</h5>  
<form action="crudFunctions.php" method="POST">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="resetElection" class="btn btn-primary">Confirm</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function (){

$('.btn_edit_pass').on('click', function(){
	$('#changePassmodal').modal('hide');

}); 

});
</script>