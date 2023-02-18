<?php 
    session_start();
    $title = 'Vote';
    include "include/headerJudge.php";
    include "connection.php";
    include 'session/sessionJudge.php';
    $conn = mysqli_connect($host, $user, $password, $db);
    
    $parse = parse_ini_file('pageant_title.ini', FALSE, INI_SCANNER_RAW);
    $title = $parse['election_title'];

    $judge_qr_code = $_GET['email'];
    foreach($query_judge as $val){
        $valid_qr = $val['email'];
    }

    $email =  $_SESSION['judge_uid'];
    $judge_id = $_SESSION['id'];
    ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <div class="title">
        <h1><?php echo strtoupper($title); ?></h1>
    </div>
   
    <div class="row">

    <div class="form">
        <form action="" method="post">
            <select name="gender" class="form-control" onchange='if(this.value != 0){ this.form.submit(); }'>
                <option value="" selected disabled>Gender</option>
                <option <?php if(isset($_POST['gender'])){$choice = $_POST['gender']; if($choice == 'F'){ echo "selected";}else{echo "";}}?> value="F" >Female</option>
                <option <?php if(isset($_POST['gender'])){$choice = $_POST['gender']; if($choice == 'M'){ echo "selected";}else{echo "";}}?> value="M">Male</option>
            </select>
        </form>
    </div>
   

    <div class="col-4 flex-row">
    <?php
    if(isset($_POST['gender'])){
        $gender = $_POST['gender'];

        if($gender == 'M'){
            $card_position = mysqli_query($conn,"SELECT * FROM pageant_candidates WHERE confirm = 2 AND gender = 'M'");
        }elseif($gender == 'F'){
            $card_position = mysqli_query($conn,"SELECT * FROM pageant_candidates WHERE confirm = 2 AND gender = 'F'");
        }else{
            $card_position = mysqli_query($conn,"SELECT * FROM pageant_candidates WHERE confirm = 2");
        }
    }else{
        $card_position = mysqli_query($conn,"SELECT * FROM pageant_candidates WHERE confirm = 2");
    }

    if($judge_qr_code == $valid_qr){
        foreach($card_position as $position => $row_candidates){
            $candidate_lrn = $row_candidates['LRN'];
      ?>
        <div class="card">
        <img src="<?php echo $row_candidates['picture']?>" alt="" class="card-img-top img-candidates">
                    <div class="card-body">
                    <p class="text-candidate"><?php echo $row_candidates['Name']?></p>
                    <p class="text-candidate">Grade: <?php echo $row_candidates['grade']?></p>
                    <?php
                    $query_criteria=mysqli_query($conn, "SELECT * FROM criteria ORDER BY id ASC");
                    foreach($query_criteria as $valc){
                        $id_criteria = $valc['id'];
                        $query_judge = mysqli_query($conn, "SELECT * FROM judge_votes WHERE criteria_id = $id_criteria AND judge_id = $judge_id AND candidate_lrn = $candidate_lrn");
                        
                        if(mysqli_num_rows($query_judge)){
                            ?>
                            <i style="color: green;" class="fa-solid fa-check-to-slot"></i>
                            <?php
                        }else{
                            ?>
                            <i style="color: grey;" class="fa-solid fa-check-to-slot"></i>
                            <?php
                        }
                    }
                    ?>
                    <a href="judge_vote.php?lrn=<?php echo $row_candidates['LRN']?>" class="btn btn-outline-primary right">Vote Now</a>
                    </div>
        </div>
    <?php
        }
    }
    else{
        header("location: judge_home.php?notYou= Credential does not match!");
    }
?>
</div>
</div>
<style>
    .title{
        text-align: center;
        padding: 2em;
        font-family: 'Poppins', sans-serif;
    }

    .form{
        width:  80%;
        margin: auto;
        margin-bottom: 2em;
    }

    .form select{
        width: 200px;
        margin: auto;
        float: right;
    }
    .row{
        max-width: 1100px;
        margin: auto;
    }

    .text-candidate{
        font-size: 12px;
    }

    .right{
        float: right;
    }

    .flex-row{
        width: 100%;
        height: auto;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
    }

    .card{
        margin: 5px;
    }
    .img-candidates{
        width: 100%;
        object-fit: cover;
    }

    .col-4{
        margin-bottom: .3em;
    }

    .card{
        width: 18rem;
    }

    @media (max-width: 1000px){
        .form{
        width:  90%;
        margin: auto;
        margin-bottom: 2em;
        padding: 1em;
    }

    .form select{
        width: 100%;
        margin: auto;
        float: right;
    }
    }
</style>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        