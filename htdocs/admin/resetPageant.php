<?php
session_start();
$title = 'Reset Election';
include "session/session.php";
include "connection.php";
include "include/headerAdmin.php";

$conn=mysqli_connect($host,$user,$password,$db);

?>

<style>
    .lagayan{
        max-width: 780px;
        margin: auto;
        height: 80vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
</style>
<div class="lagayan">
<h1>
    Reset Pageant
</h1>

<p class="text-secondary">Please Click <b>Backup</b> before resetting Pageant</p>

<?php
        //Add Student
        if(isset($_GET['backup'])){
                    
        echo "
        <script>
            Swal.fire(
            'Success!',
            'You can now reset the Pageant',
            'success'
            )
        </script>

        ";
        }

    $sql = mysqli_query($conn, "SELECT COUNT(*) FROM judge_votes");
    $me = $_GET['marie'];
    while($row = mysqli_fetch_array($sql)){
        $count = $row['COUNT(*)'];
    }

    if($count == 0){
        ?>
        <div>
            <a href="" class="btn btn-secondary" style="pointer-events: none;">Back Up</a>
            <a href="" class="btn btn-secondary" style="pointer-events: none;">Reset Now</a>
        </div>
            
        <?
    }else{
        ?>
        <div>

            <?php
            if($_GET['backup'] == 'Success'){
                ?>
                    <a class="btn btn-secondary" style="pointer-events: none;" class="btn btn-primary">Back Up</a>
                <?php

            }else{
                ?>
                <a href="pageant_file_backup.php?backup=Success&marie=<?php echo $me;?>" class="btn btn-primary">Back Up</a>
                <?php
            }
            
            
            ?>
            

            <?php
            // $bu = $_GET['backup'];
            
            if($_GET['backup'] == 'Success'){
                ?>
                <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#resetpageant">Reset Now</a>
                <?php
            }else{
                ?>
                <a href="" class="btn btn-secondary" style="pointer-events: none;">Reset Now</a>
                <?php
            }
            ?>
            </div>
        <?
    }
?>

</div>

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

