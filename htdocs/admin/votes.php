<?php
session_start();
$title = 'Votes';
include "connection.php";
include "session/session.php";
require 'include/headerAdmin.php';
$conn=mysqli_connect($host,$user,$password,$db);

$grade = $_GET['grade'];
$sql = mysqli_query($conn, "SELECT * FROM position");
$query = "SELECT grade, COUNT(*) FROM userlogin WHERE grade = $grade";
$resultUser = mysqli_query($conn, $query);



while ($rowUser = mysqli_fetch_array($resultUser)){
     $count =  $rowUser['COUNT(*)'];
}
?>

<style>
    .section{
        max-width: 870px;
        margin: auto;
        padding-top: 1em;
        font-family: 'Poppins', sans-serif;
    }

    .row{
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .col-4{
        width: 100%;
        margin-bottom: 12px;
    }

    .img{
        width: 100px;
    }
    .grid-candidate{
        display: grid;
        grid-template-columns: .5fr 1fr .3fr;
        justify-content: center;
        align-items: center;
        margin: auto;

    }

    progress{
        width: 100%;
    }

    h1{
        text-align: center;
        padding: 1em;
        font-weight: bold;
    }

    progress{
        padding: 20px;
    }

  

    .votes{
        text-align: right;
    }

    .card-title{
        font-size: 30px;
       text-align: center;
    }

    .separator-line{
	width: 100%;
	height: 4px;
	background-image: linear-gradient(to right, #8b33c5, #15a0e1);
	margin-top: 20px;
	}

    @media (max-width: 750px){
        .section{
            width: 100%;
        }

        .card-prod{
            width: 100%;
            margin: auto;
        }

        .row{
            width: 100%;
            align-items: center;
        }

        .row > *{
            padding-right: none;
        }

        .card{
            margin: auto;
        }
        
    }
</style>
<body>
<div class="section">
    <h1>Election Vote (Grade <?php echo $grade?>)</h1>
    <div class="row">
    <?php 
    while($val=mysqli_fetch_array($sql)){
        $position = $val['position'];
        ?>
        <div class="col-4 card-prod"> 
        <div class="card" style="width: 100%;">
        <div class="card-body">
            <h3 class="card-title"><?php echo $position;?></h3>
            <hr>
                <?php 
                $can = mysqli_query($conn, "SELECT * FROM candidates WHERE confirm= 2 ORDER BY total_votes DESC");
                while($row = mysqli_fetch_array($can)){
                    $can_pos = $row['Position'];
                    if($position == $can_pos){
                        
                        ?>
                        <div class="grid-candidate">
                            <div>
                                <img class="img" src="<?php echo $row['picture']?>" alt="">
                                <?php 
                                $can_lrn= $row['LRN'];
                                $count_vote = mysqli_query($conn, "SELECT candidate_lrn, Grade, COUNT(*) FROM votes WHERE candidate_lrn = $can_lrn AND Grade = $grade");
                                ?>
                            </div>
                            <div>
                                <p class="card-text"><?php echo $row['Name']; ?></p>
                                <?php 
                                 while ($rowUser = mysqli_fetch_array($count_vote)){
                                    $vote_count = $rowUser['COUNT(*)'];
                                    if($vote_count < 1){
                                        ?>
                                        <progress value="0" max="<?php echo $count?>">0</progress>
                                        <?php
                                    }else{
                                        ?> 
                                         <progress value="<?php echo $vote_count?>" max="<?php echo $count?>"> <?php echo $vote_count?></progress>
                                        <?php
                                    }
                                    ?>
                                    <p class="votes"><?php echo $vote_count;?> Vote/s</p>
                                    <?php
                               }
                                ?>
                                
                            </div>
                        </div>
                        <?php
                    }
                    
                    
                }
                
                ?>
        </div>
        </div>
        </div>
        <?php
    }
    ?>
    </div>
</div>
<div>
<div class="separator-line bottom-separator"></div>
<?php include "footer.php";?>
</div>

</body>
