<?php
session_start();
$title = 'CANDIDATES LIST';
include "connection.php";
include "session/sessionStudent.php";
require "include/headerStudent.php";

$conn=mysqli_connect($host,$user,$password,$db);

$parse = parse_ini_file('pageant_title.ini', FALSE, INI_SCANNER_RAW);
$title = $parse['election_title'];

$card = mysqli_query($conn,"SELECT * FROM pageant_candidates WHERE confirm = 2");
$row_of_candidates=mysqli_fetch_array($card, MYSQLI_ASSOC);


?>
<style>
    .content{
        max-width: 1100px;
        margin: auto;
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
    .title{
        padding: 1em;
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
        width: 18rem;
    }
    .img-candidates{
        width: 100%;
        object-fit: cover;
    }
    .name-candidate{
        width:100%;
        white-space: nowrap; 
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 18px;
        font-weight: bold;
    }

    .run-cand{
        font-size: 12px;
    }

    @media (max-width: 780px){

        .content{
            padding: 1em;
        }

        .img-candidates{
        width: 100%;
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
<?php

if(!$row_of_candidates){
    ?>
    <div class="empty-box-promax">
    <div class="empty-box">
        <div>
        <img src="assets/empty3.jpg" alt="">
        </div>
        <div>
            <p class="text-muted">There is no Pageant as of now!</p>
        </div>
        
    </div>
    </div>
    
    <?php
    }else{?>
     <div class="title">
        <h1><?php echo strtoupper($title); ?></h1>
    </div>
    
    <div class="row">
    <div class="col-4 flex-row">
    <?php
    $card_position = mysqli_query($conn,"SELECT * FROM pageant_candidates WHERE confirm = 2");
    if($judge_qr_code == $valid_qr){
        foreach($card_position as $position => $row_candidates){
      ?>
        <div class="card">
        <img src="<?php echo $row_candidates['picture']?>" alt="" class="card-img-top img-candidates">
                    <div class="card-body">
                    <p class="text-candidate"><?php echo $row_candidates['Name']?></p>
                    <p class="text-candidate">Grade: <?php echo $row_candidates['grade']?></p>
                    </div>
        </div>
    <?php
        }
    }
}
?>
</div>
</div>
     
</body>

<style>
    .title{
        text-align: center;
        padding: 2em;
        font-family: 'Poppins', sans-serif;
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
</style>