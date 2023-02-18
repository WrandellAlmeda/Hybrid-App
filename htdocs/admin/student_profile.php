<?php
session_start();
$title = 'Profile';
include "connection.php";
include "session/sessionStudent.php";
include "include/headerStudent.php";



$conn=mysqli_connect($host,$user,$password,$db);

foreach($query_voter as $student => $val){
  $lrn = $val['LRN'];
  $name = $val['fullname'];
  $email = $val['username'];
  $grade = $val['grade'];
  $section = $val['section'];
  $qr_code = $val['qr_code'];

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
<div class="modal fade" id="editmodal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
			<h4 class="modal-title">Edit Email</h4>
          
        </div>

		<form action="crudFunctionsStudent.php" method="post">
		<div class="modal-body input-group mb-3">

			<div class="input-group mb-3" hidden>
			<div class="input-group-prepend">
			<span class="input-group-text" id="lrn1">LRN</span>
			</div>
			<input type="text" class="form-control input-group-text disabled" name="lrn" value="<?php echo $lrn;?>" aria-describedby="lrn1" readonly>
			</div>


			<div class="input-group mb-3" hidden>
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">NAME</span>
			</div>
			<input type="text" class="form-control input-group-text disabled"  name="name" value="<?php echo $name; ?>" aria-describedby="basic-addon1" readonly>
			</div>

			<div class="input-group mb-3" hidden>
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">GRADE</span>
			</div>
			<input type="text" class="form-control"  name="grade" value="<?php echo $grade; ?>" aria-describedby="basic-addon1" readonly>
			</div>


			<div class="input-group mb-3" hidden>
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">SECTION</span>
			</div>
			<input type="text" class="form-control"  name="section" value="<?php echo $section; ?>" aria-describedby="basic-addon1" readonly>
			</div>


			<div class="input-group mb-1 pt-3">  
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">EMAIL</span>
			</div>
			<input type="email" class="form-control" name="username" value="<?php echo $email; ?>"  aria-describedby="basic-addon1" required>
		</div>
        </div>
       
		<div class="modal-footer">
		<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary" name="edit_user_info">Confirm</button>
        
		</div>
	  </form>

</div>
      
    </div>
  </div>
</div>


<div class="modal fade" id="changePassmodal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
			<h4 class="modal-title">Change Password</h4>
          
        </div>

		<form action="crudFunctionsStudent.php" method="post">

    <input type="hidden" class="form-control" name="email" value="<?php echo $email; ?>"  aria-describedby="basic-addon1" required>
		<div class="modal-body input-group mb-3">
    <input hidden type="text" class="form-control input-group-text disabled" name="lrn" value="<?php echo $lrn;?>" aria-describedby="lrn1" readonly>
    <input hidden type="text" class="form-control input-group-text disabled"  name="name" value="<?php echo $name; ?>" aria-describedby="basic-addon1" readonly>

			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="lrn1">New Password</span>
			</div>
			<input type="password" class="form-control" name="new_pass" minlength="6" aria-describedby="lrn1" id="myInput" required>
			</div>


			<div class="input-group mb-3">
			<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Re-type Password</span>
			</div>
			<input type="password" class="form-control"  name="re_pass" minlength="6" aria-describedby="basic-addon1" id="myInput" required>
			</div>
      <input type="checkbox" onclick="myFunctions()" style="float: right;"> Show Password
      </div>

        
       
		<div class="modal-footer">
		<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary" name="change_pass_user">Confirm</button>
        
		</div>
	  </form>

</div>
      
    </div>
  </div>
</div>



    <div class="prof-con">
    
<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-6 mb-4 mb-lg-0">
      <?php if(isset($_GET['success'])) {?>
         <div class="alert alert-success"  role="alert">
            <h4 class="alert-heading">Success <i class="fa-solid fa-check"></i></h4>
			<p><strong><?php echo $_GET['success'] ?></strong></p>
			<a href="student_profile.php" class="btn btn-outline-success">Close</a>
		</button>
         </div> 
		<?php unset( $_GET['success']); }?>	

    <?php if(isset($_GET['error'])) {?>
            <div class="alert alert-danger" irole="alert">
            <h4 class="message">Failed <i class="fa-solid fa-triangle-exclamation"></i></h4>
			<p><strong><?php echo $_GET['error'] ?></strong></p>
			<a href="student_profile.php" class="btn btn-outline-danger">Close</a>
            </div>
		<?php unset( $_GET['error']); }?>
        <div class="card mb-3" style="border-radius: .5rem;">
          <div class="row g-0">
            <div class="col-md-4 gradient-custom text-center text-white"
              style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
              <img src="<?php echo $qr_code;?>"
                alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
              <p style="text-transform: uppercase;">voter</p>
            </div>
            <div class="col-md-8">
              <div class="card-body p-4">
                <h6>Information</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>Email</h6>
                    <p class="text-muted"><?php echo $email; ?></p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Full Name</h6>
                    <p class="text-muted"><?php echo $name; ?></p>
                  </div>
                </div>
                <h6></h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>Grade</h6>
                    <p class="text-muted"><?php echo $grade?></p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Section</h6>
                    <p class="text-muted"><?php echo $section?></p>
                  </div>
                </div>
                <div class="d-flex justify-content-evenly">
                  <!-- <a class="btn btn-primary btn-sm custom-bg edit_btn" data-toggle="modal" data-target="#editmodal"><i class="fa-solid fa-pen-to-square"></i> Edit</a> -->
                  <a class="btn btn-primary btn-sm custom-bg pass_btn" data-toggle="modal" data-target="#changePassmodal"><i class="fa-solid fa-pen-to-square"></i> Pass</a>
                  <a href="logout.php" class="btn btn-primary btn-sm custom-bg"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
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

   
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
  $(document).ready(function (){

$('.edit_btn').on('click', function(){
	$('#editmodal').modal('hide');
}); 

});

$(document).ready(function (){

$('.pass_btn').on('click', function(){
	$('#changePassmodal').modal('hide');
}); 

});


</script>

<script type="text/javascript">
		
		function myFunction(){
		var x = document.getElementById("myInput");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
		}

	</script>
</body>