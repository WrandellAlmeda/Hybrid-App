<?php 
 session_start();
 include "connection.php";
 include 'session/sessionJudge.php';
 $conn = mysqli_connect($host, $user, $password, $db);

if(isset($_POST['judge_vote'])){
    $judge_id = $_POST['judge_id'];
    $candidate_lrn = $_POST['candidate_lrn'];
    $id_criteria = $_POST['id_criteria'];
    $name_criteria = $_POST['name_criteria'];
    $percentage_criteria = $_POST['percentage_criteria'];
    $score = $_POST['score'];

    if($score > $percentage_criteria){
        header("location: judge_vote.php?error=Inputted score exceeded to the maximum score, please try again&lrn=$candidate_lrn");
        exit();
    }
    elseif($score == 0){
        header("location: judge_vote.php?error=Invalid vote value. Please enter the minimum votes per category&lrn=$candidate_lrn"); 
        }
    else{
        $query = mysqli_query($conn, "INSERT INTO `judge_votes`(`criteria_id`, `candidate_lrn`, `judge_id`, `score`) VALUES ('$id_criteria','$candidate_lrn', '$judge_id', '$score')");
    
        if($query){
         header("location: judge_vote.php?success=Vote has been Submitted&lrn=$candidate_lrn");
        }
      
        else{
         header("location: judge_vote.php?error=Won't work, please try again!&lrn=$candidate_lrn");
        }
    }
  
}

?>