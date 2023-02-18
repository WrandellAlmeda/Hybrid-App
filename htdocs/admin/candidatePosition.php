<?php
include "connection.php";
$conn=mysqli_connect($host,$user,$password,$db);

if(isset($_POST['candidate_position'])){

    $selection = $_POST['can_position'];
    $filter_section = mysqli_query($conn,"SELECT * FROM candidates WHERE position = '$selection'");

    if(mysqli_num_rows($filter_section)){
        $card = mysqli_query($conn,"SELECT * FROM candidates WHERE position = '$selection'" );
        $candidateTitle = $selection;
    }else{
        $card = mysqli_query($conn,"SELECT * FROM candidates ORDER BY id ASC");
        $candidateTitle = "All Candidates";
    }   
}

?>