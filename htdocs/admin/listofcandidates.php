<?php 
session_start();
$title = 'CANDIDATES LIST';
include "connection.php";
include "session/sessionStudent.php";
require "include/headerStudent.php";

$conn=mysqli_connect($host,$user,$password,$db);
$confirm = 1;
$card = mysqli_query($conn,"SELECT * FROM candidates WHERE confirm=2");

$result = mysqli_query($conn,"SELECT * FROM position");

$row_of_candidates=mysqli_fetch_array($card, MYSQLI_ASSOC);

$parse = parse_ini_file('config.ini', FALSE, INI_SCANNER_RAW);
$title = $parse['election_title'];

$candidateTitle = 'All Candidates';
?>

<style>
    .div-row{
        max-width: 1000px;
        margin: auto;
        font-family: 'Poppins', sans-serif;
    }

    .img-candidates{
        width: 100%;
        height: 250px;
        object-fit: cover;
    }


    .col-4{
        margin-bottom: .3em;
    }

    h1{
        padding-top: 1em;
        padding-bottom: 1em;
    }

    .card{
        width: 18rem;
    }

    /* .button-con{
        max-width: 870px;
        display: grid;
        grid-auto-flow: column;
        grid-auto-columns: 21%;
        overflow-x: auto;
        overscroll-behavior-inline: contain;
        
    } */

    .con{
        display: flex;
        flex-direction: row;
    }

    .item{
        margin: 5px;
    }

    .item button{
        width: 45ch;
        font-size: 12px;
        
    }


    .separator-line{
	width: 100%;
	height: 4px;
	background-image: linear-gradient(to right, #8b33c5, #15a0e1);
	margin-top: 20px;
    margin-top: 4em;
    }

    .separator-line-head{
	width: 100%;
	height: 4px;
	background-image: linear-gradient(to right, #8b33c5, #15a0e1);
    }

    .btn-sm{
        background-image: linear-gradient(to right, #8b33c5, #15a0e1);
        color: #fff;
    }

    .btn-sm:hover{
        background: 
    }

    .title{
        padding: 1em;
    }


    /* width */
    ::-webkit-scrollbar {
    width: 10px;
    height: 7px;
    }

/* Track */
    ::-webkit-scrollbar-track {
    box-shadow: inset 0 0 1px grey; 
    border-radius: 10px;
    }
 
/* Handle */
    ::-webkit-scrollbar-thumb {
    /* background: linear-gradient(to right, #8b33c5, #15a0e1);  */
    background: #15a0e1;
    border-radius: 10px;
    }

/* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to right, #8b33c5, #15a0e1);  
    }

    .empty-box{
        max-width: 870px;
        height: 80vh;
        margin: auto;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        font-family: 'Poppins', sans-serif;
        
    }

    .empty-box img{
        max-width: 300px;
    }

    .empty-box p{
        padding: 8px;
    }

    .flex-row{
        width: 100%;
        height: auto;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
    }

    .row{
        margin-bottom: 1em;
    }

    .card{
        margin: 5px;
    }

    .Position{
        background: #eee;
        border-left: 2px solid blue;
        padding: 1em;
        text-align: center;
        font-weight: bold;
        font-size: 22px;
    }

    .default-img img{
        max-width: 150px;
    }

    .name-candidate{
        width:100%;
        white-space: nowrap; 
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 12px;
        font-weight: bold;
    }

    .run-cand{
        font-size: 12px;
    }

    .button-for-counting{
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1em;
    }


    @media (max-width: 780px){

        .img-candidates{
         width: 100%;
         height: 250px;
         object-fit: cover;
        }
        .div-row{
            width: 100%;
            margin: auto;
        }
        /* .row{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        } */

        .flex-row{
        all: unset;
        }

        .row{
            width: 100%;
            margin: auto;
            margin-bottom: .5em;
        }
        .flex-row{
            width: 100%;
            margin: auto;
        }

        .card{
            width: 100%;
        }

        .card-center{
            width: 100%;
        }
        .btn{
            font-size: 12px;
        }

        .title{
            text-align: center;
        }
        .item button{
        width: 50ch;
        font-size: 12px;
        
    }

        /* .button-con{
        max-width: 100%;
        display: grid;
        grid-auto-flow: column;
        grid-auto-columns: 36%;
        overflow-x: auto;
        
        } */


    }

    

</style>

<body>
<!-- <div class="separator-line-head"></div> -->

<?php

if(!$row_of_candidates){
    ?>
    <div class="empty-box-promax">
    <div class="empty-box">
        <div>
        <img src="assets/empty3.jpg" alt="">
        </div>
        <div>
            <p class="text-muted">There is no Election as of now!</p>
        </div>
        
    </div>
    </div>
    
    <?php
}else{
    ?>

    <div class="container div-row">
    <h1 class="page-header text-center title"><b><?php echo strtoupper($title); ?></b></h1>
        <div class="button-for-counting">
        <form action="student_election_count.php" method="post" onchange='if(this.value != 0) { this.form.submit(); }'>
        <center>
            <input type="submit" value="Overall Election Vote" class="btn btn-primary btn-lg" name="btn_votes"> 
        </center>
        </form>
            <!-- <a href="student_election_count.php" class="btn btn-primary">Over All Election Vote</a> -->
        </div>
    <div>
        <?php
        
       while($row_position=mysqli_fetch_array($result)){
        ?>
        <div>
            <h5 class="Position"><?php echo $row_position['position']; ?></h5>
            
        </div>
        <?php
        $position_candidates = $row_position['position'];
        $card_position = mysqli_query($conn,"SELECT * FROM candidates WHERE Position = '$position_candidates'");
        ?>
        <div class="row">
                <div class="col-4 flex-row"><?php
        foreach($card_position as $position => $row_candidates){
            $confirm = $row_candidates['confirm'];
            $card_position = mysqli_query($conn,"SELECT * FROM candidates WHERE Position = '$confirm'");
            if($confirm == 2){
                ?>
                <div class="card">
                    <img src="<?php echo $row_candidates['picture']?>" alt="" class="card-img-top img-candidates">
                    <div class="card-body">
                        <p class="name-candidate"><?php echo $row_candidates['Name']?></p>
                        <p class="run-cand"><?php echo $row_candidates['grade']?> <?php echo $row_candidates['section']?></p>
                        <!-- <p class="run-cand"><?php echo $row_candidates['Platform']?></p> -->
                    </div>
                </div>
        <?php }elseif(mysqli_num_rows($card_position) < 0){
                echo 'empty';
            }
        }
        ?>
        </div>
            </div>
        <?php
       }
        
        ?>
    </div>
    </div>

   
<?php } ?>

<?php include "footer.php";?>

</body>

