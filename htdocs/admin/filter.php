<?php
include "connection.php";
$conn=mysqli_connect($host,$user,$password,$db);

if(isset($_POST['selection'])){

    $selection = $_POST['selection'];
    $filter_section = mysqli_query($conn,"SELECT * FROM userlogin WHERE section = '$selection'");

    if(mysqli_num_rows($filter_section)){
        $result = mysqli_query($conn,"SELECT * FROM userlogin WHERE section LIKE '%".$selection."%'");
    }else{
        $result = mysqli_query($conn,"SELECT * FROM userlogin ORDER BY CtrlNum DESC");
    }
}

?>
