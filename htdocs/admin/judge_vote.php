<?php 
    session_start();
    $title = 'Vote';
    include "include/headerJudge.php";
    include "connection.php";
    include 'session/sessionJudge.php';
    $conn = mysqli_connect($host, $user, $password, $db);

    $candidate_lrn = $_GET['lrn'];

    $query=mysqli_query($conn, "SELECT * FROM pageant_candidates WHERE LRN = $candidate_lrn");
    $query_criteria=mysqli_query($conn, "SELECT * FROM criteria ORDER BY id ASC");
    foreach($query as $pageant){
        $candidate_name = $pageant['Name'];
        $candidate_img = $pageant['picture'];
        $candidate_motto = $pageant['Motto'];
        $candidate_gender = $pageant['gender'];
        $candidate_grade = $pageant['grade'];
    }

    $email =  $_SESSION['judge_uid'];
    foreach($query_judge as $judge_val){
        $id_judge= $judge_val['id'];
        $name_judge= $judge_val['first_name'];
    }
?>
<style>

    .criteria-body{
        max-width: 870px;
        margin: auto;
        font-family: 'Poppins', sans-serif;
    }

    .percent{
        color: green;
    }

    .submit-criteria{
        float: right;
        margin-top: 5px;
    }

    .card{
        margin-bottom: 1em;
    }

    .candidate-div{
        max-width: 870px;
        margin: auto;
        padding: 12px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        font-family: 'Poppins', sans-serif;
    }

    .jonathan-img{
        width: 300px;
        object-fit: cover;
        margin: auto;
    }


    .invina-div{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .info{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .almeda-div{
        padding : 1em;
        border: 1px solid #333;
        width: 100%;
    }

    .back{
        margin-top: 1em;
        margin-left: 5em;
    }



    @media (max-width: 780px){

        .candidate-div{
        all: unset;
        display: grid;
        grid-template-rows: .5fr .5fr;
        padding: 2em;
    }

    .candidate-div div{
        width: 100%;
    }

    .jonathan-img{
        width: 100%;
        object-fit: cover;        
    }

    .criteria-body{
        padding: 1em;
    }

    .info{
        margin-top: 1em;
    }
    .back{
        margin-top: 1em;
        margin-left: 1em;
    }

    }
    


</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<body>
    <div>   
        <a href="judge_voting_envi.php?email=<?php echo $email?>" class="btn btn-outline-primary back"><i class="fa-solid fa-backward"></i> Back</a>
    </div>
    <div class="candidate-div">
        
        <div class="invina-div">
        <img class="jonathan-img" src="<?php echo $candidate_img ?>" alt="">
        </div>
        <div class="info">
        <p class="almeda-div"><?php echo $candidate_lrn?></p>
            <p class="almeda-div"><?php echo $candidate_name?></p>
            <p class="almeda-div"><?php if($candidate_gender == 'M'){
                echo "Male";
            }else{
                echo "Female";
            }?></p>
            <p class="almeda-div"><?php echo $candidate_motto?></p>
            <p class="almeda-div"> Grade: <?php echo $candidate_grade?></p>
       
        </div>
        
        
    </div>
    <div class="criteria-body">
    <?php
if(isset($_GET['success'])){
			
  $added = $_GET['success'];
echo "
<script>
  Swal.fire(
  'Success',
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
  'There is an Error',
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
        
            <?php
            foreach($query_criteria as $value){
                $id_criteria = $value['id'];
                $criteria_description = $value['criteria_description'];
                $percentage = $value['percentage'];
                $query_judge = mysqli_query($conn, "SELECT * FROM judge_votes WHERE criteria_id = $id_criteria AND judge_id = $id_judge AND candidate_lrn = $candidate_lrn");
                
                if(mysqli_num_rows($query_judge)){
                    foreach($query_judge as $votes_judge){
                        $score_judge = $votes_judge['score'];

                        ?>
                             <div class="card" style="background: #eee;">
                            <div class="card-body">
                            <h5><?php echo $value['criteria_description']?></h5>
                            <p>Your Vote</p>
                            <input class="form-control" type="text" value="<?php echo $score_judge?>" readonly>
                            <input type="submit" value="Submit" class="btn btn-secondary submit-criteria" name="judge_vote" disabled>
                            </div>
                    </div>
                        <?php
                    }
                }else{
                    ?>
                     <form action="judge_submit_votes.php" method="post">
                    <input type="text" name="candidate_lrn" value="<?php echo $candidate_lrn?>" hidden>
                    <input type="text" name="judge_id" value="<?php echo $id_judge?>" hidden>
                    <input type="text" name="id_criteria" value="<?php echo $id_criteria?>" hidden>
                    <input type="text" name="name_criteria" value="<?php echo $criteria_description?>" hidden>
                    <input type="text" name="percentage_criteria" value="<?php echo $percentage?>" hidden>
                <div class="card">
                    <div class="card-body">
                       <h5><?php echo $value['criteria_description']?></h5>
                       <p>Please vote maximum of <b class="percent"><?php echo $value['percentage']?></b> Point/s</p>
                       <input class="form-control" type="number" name="score"placeholder="Enter Score" required>
                       <input type="submit" value="Submit" class="btn btn-primary submit-criteria" name="judge_vote">
                    </div>
                    </div>
                    </form>

                    <?php
                }
                ?>
                <?php
            }
            ?>
       

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
