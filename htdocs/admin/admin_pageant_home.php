<?php 
    session_start();
    $title = 'Admin';
    include "connection.php";
    include "session/session.php";
    include 'include/headerAdmin.php';
    include 'slugify.php';
    $conn=mysqli_connect($host,$user,$password,$db);
    
    $query = "SELECT COUNT(*) FROM userlogin WHERE usertype = 'user'";
    $resultUser = mysqli_query($conn, $query);
    
    $queryAdmin = "SELECT usertype, COUNT(*) FROM admin GROUP BY usertype";
    $resultAdmin = mysqli_query($conn, $queryAdmin);

    $queryjudge = "SELECT COUNT(*) FROM judge";
    $resultjudge = mysqli_query($conn, $queryjudge);

    $queryCandidate1 = "SELECT count(*) FROM pageant_candidates WHERE confirm = 1";
    $resultCandidate1 = mysqli_query($conn, $queryCandidate1);

    $queryCandidate = "SELECT COUNT(*) FROM pageant_candidates WHERE confirm = 2";
    $resultCandidate = mysqli_query($conn, $queryCandidate);

?>
<style>

    .container-width{
        max-width: 900px;
        margin: auto;
        font-family: 'Poppins', sans-serif;
    }
    a{
        text-decoration: none;
    }

    .my-card{
    position:absolute;
    left:40%;
    top:-20px;
    border-radius:50%;
    }

    .jumbotron{
        margin-top: 3em;
    }

    .card:hover{
        box-shadow: 10px 10px 5px lightblue;
        transition: .3s ease;
    }

    h1,
    h4,
    span{
        color: #088F8F;
    }

    .voting-card{
        max-width: 100%;
        margin-top: 1em;
        margin-bottom: 1em;
    }

    .col-4{
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 1fr;
        margin: auto;
        justify-content: center;
        align-items: center;
    }
    
    .separator-line{
	width: 100%;
	height: 4px;
	background-image: linear-gradient(to right, #8b33c5, #15a0e1);
	margin-top: 20px;
	}

    .titol{
        text-align: center;
        padding-top: 1em;
    }

    .buttons-election{
        border-bottom: 2px solid blue;
    }

    .list-candidates{
        width: 100%;
        display: flex;
        flex-direction: column;
        margin: auto;
        justify-content: center;
        align-items: center;
    }

    .candidates_votes{
        width: 100%;
        padding: .5em;
        border: 1px solid #eee;
        margin-bottom: 2px;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .candidates_votes p{
        justify-content: center;
        align-items: center;
    }

    .candidates_votes:hover{
        background: #eee;
    }

    .pageant-candidates{
        width: 100%;
       display: grid;
       grid-template-columns: 1fr 1fr;
       background: #eee;
       border-left: 2px solid blue;
       padding: 1em;
       margin-top: 1em;
    }

    .title-buttons{
        display: flex;
        flex-direction: column;
        justify-content:center;
    }


    .tag-candidates{
        width: 100%;
    }

    .ranking-candidates{
        width: 100%;
        display: flex;
        flex-direction: row;
        margin: auto;
        justify-content: space-between;
        align-items: center;
        padding: 1em;
        gap: 5x;
    }
    .card-img{
        max-width: 300px;
    }

    .rank-card{
        margin: 5px;
    }
    .select-form{
        display: flex;
        flex-direction: row-reverse;
        align-items: center;
    }

    .select-form div{
        padding-left: 1em;
    }

    @media (max-width: 780px){
        .container-width{
            height: 100%;
        }
        .row{
            display: flex;
            flex-direction: column;
            margin: auto;
            gap: 2em;
        }

        .my-card{
        position:absolute;
        left:43%;
        top:-25px;
        border-radius:50%;
    }

    .ranking-candidates{
        width: 100%;
        display: flex;
        flex-direction: column;
        margin: auto;
        justify-content: center;
        align-items: center;
        padding: 2em;
    }
    .card-img{
        max-width: 100%;
    }

    }



</style>


<body>
<div class="container container-width">

<h1 class="titol">PAGEANT</h1>
<div class="jumbotron">
<div class="row w-100">
    <!-- <a href="voterslist.php"  class="text-warning text-white">
        <div class="col-md-3">
            <div class="card border-info text-info mx-sm-1 p-3">
                <div class="card border-info shadow text-info p-3 my-card" ><span class="fa-solid fa-user" aria-hidden="true"></span></div>
                <div class="card-text text-center mt-3"><h4>Voters</h4></div>
                <div class=" card-text text-center mt-2"><h1><?php while ($rowUser = mysqli_fetch_array($resultUser)){?>
                    <?php echo $rowUser['COUNT(*)'];?>
            <?php } ?></h1></div>
            </div>
            </a>
        </div> -->

        <div class="col-md-4">
        <a href="admin_pageant_list.php"  class="text-warning text-white">
            <div class="card border-info text-info mx-sm-1 p-3">
                <div class="card border-info shadow text-info p-3 my-card"><span class="fa-solid fa-user-tie" aria-hidden="true"></span></div>
                <div class="card-text text-center mt-3"><h4>Candidates</h4></div>
                <div class="card-text text-center mt-2"><h1>
                <?php
                while ($row = mysqli_fetch_array($resultCandidate)){
                    echo $row['COUNT(*)'];
                }
                ?>   
                </h1>
              </div>
            </div>
            </a>
        </div>
        
        <div class="col-md-4">
        <a href="admin_judge_list.php"  class="text-warning text-white">
            <div class="card border-info text-info mx-sm-1 p-3">
                <div class="card border-info shadow text-info p-3 my-card" ><span class="fa-solid fa-user-shield" aria-hidden="true"></span></div>
                <div class="card-text text-center mt-3"><h4>Judge</h4></div>
                <div class="card-text text-center mt-2"><h1><?php while ($row = mysqli_fetch_array($resultjudge)){?>
	            <?php $count_judge = $row['COUNT(*)'];
                    echo $count_judge;
                ?>
                <?php }?></h1></div>
            </div>
                </a>
        </div>

        <div class="col-md-4">
            <a href="admin_pageant_request.php"  class="text-warning text-white">
            <div class="card border-info text-info mx-sm-1 p-3">
                <div class="card border-info shadow text-info p-3 my-card" ><span class="fa fa-inbox" aria-hidden="true"></span></div>
                <div class="card-text text-center mt-3"><h4>Pending</h4></div>
                <div class="card-text text-center mt-2"><h1>
                <?php
                while ($row = mysqli_fetch_array($resultCandidate1)){
                    echo $row['count(*)'];
                }
              
                ?>
                </h1></div>
            </div>
            </a>
        </div>
     </div>
     </div> 

     <div>
     
     </div>
     
       
        <div class="pageant-candidates">
            <div class="title-buttons">
            <h5 >Ranking</h5>
            </div>  
            <div class="select-form">
                <div>
                <form action="crudFunctions.php" method="post" onchange='if(this.value != 0) { this.form.submit(); }'>
                <input type="submit" name="update_score_pageant" value="Update Ranking" class="btn btn-primary btn-sm">
            </form>
                </div>
                <div>
                     
            <form action="" method="post">
            <select name="gender"  class="form-select form-select-sm" onchange='if(this.value != 0){ this.form.submit(); }'>
            <option selected disabled>Gender</option>
            <option <?php if(isset($_POST['gender'])){$choice = $_POST['gender']; if($choice == 'M'){ echo "selected";}else{echo "";}}?> value="M">Male</option>
            <option <?php if(isset($_POST['gender'])){$choice = $_POST['gender']; if($choice == 'F'){ echo "selected";}else{echo "";}}?> value="F">Female</option>
             </select>
            </form>
                </div>
           
            </div>
        </div>

        <div class="ranking-candidates">
        <?php
        if(isset($_POST['gender'])){
            $selection = $_POST['gender'];

            if($selection == 'M'){
                $ranking = mysqli_query($conn, "SELECT * FROM pageant_candidates WHERE gender = 'M' AND confirm = 2 ORDER BY total_percentage DESC LIMIT 5");
            }elseif($selection =- 'F'){
                $ranking = mysqli_query($conn,"SELECT * FROM pageant_candidates WHERE gender = 'F' AND confirm = 2 ORDER BY total_percentage DESC LIMIT 5");
            }else{
                $ranking = mysqli_query($conn,"SELECT * FROM pageant_candidates WHERE gender = 'F' AND confirm = 2 ORDER BY total_percentage DESC LIMIT 5");
            }
        }else{
            $ranking = mysqli_query($conn, "SELECT * FROM pageant_candidates WHERE gender = 'F' AND confirm = 2 ORDER BY total_percentage DESC LIMIT 5");
        }
        $count_rank = 1;
        foreach($ranking as $rank_position){
            // echo $count_rank." | ".$rank_position['Name']." = ".$rank_position['total_percentage']."<br>";
            ?>

            <div class="card margin-candidates mb-4">
                <div class="view overlay">
                <img class="card-img-top" src="<?php echo $rank_position['picture'];?>" alt="Card image cap">
                <a href="#!">
                    <div class="mask rgba-white-slight"></div>
                </a>
                </div>
                <div class="card-body">
                <h4 class="card-title"><?php echo "Rank ".$count_rank;?></h4>
                <p class="card-text" style="font-size: 11px;"><?php echo $rank_position['Name']; ?> <span style="color: green; text-transform: bold; font-size: 12px;"><?php echo $rank_position['total_percentage']."%"; ?></span></p>
                <a href="admin_pageant_score.php?lrn=<?php echo $rank_position['LRN'];?>" class="btn btn-light-blue btn-sm">View Scores</a>
                </div>
            </div>
            <?php
            $count_rank += 1;
        }
        ?>
        </div>        
    
<!-- <div class="card bg-dark text-white rank-card">
            <img src="<?php echo $rank_position['picture'];?>" class="card-img" alt="...">
            <div class="card-img-overlay">
                <h5 class="card-title"><?php echo "Rank ".$count_rank;?></h5>
                <p class="card-text"><?php echo $rank_position['Name']; ?></p>
                <p class="card-text"><?php echo $rank_position['total_percentage']."%"; ?></p>
            </div>
            </div> -->
        
        <div class="pageant-candidates">
            <div class="title-buttons">
            <h5 >Candidate</h5>
            </div>  
            <div class="title-buttons">
            <a href="admin_pageant_report.php" class="btn btn-primary">Generate Breakdown Report</a>
            </div>
        </div>
     <div class="list-candidates">
        <?php 
        $query_can = mysqli_query($conn,"SELECT * FROM `pageant_candidates` WHERE confirm = 2");
      
        foreach($query_can as $list){
            $pageant_lrn_list = $list['LRN'];
            ?><a href="admin_pageant_score.php?lrn=<?php echo $pageant_lrn_list;?>" style="text-transform: uppercase;" class="tag-candidates">
            <div class="candidates_votes"><p><?php echo $list['Name'];?></p></div>
            </a>
            <?php
        }
        ?>
     </div>

     <!-- <?php
    
    $voting = "SELECT * FROM votes";
    $run = mysqli_query($conn, $voting);
                
    $row_of_votes=mysqli_fetch_array($run, MYSQLI_ASSOC);
    if(!$row_of_votes){
        echo '';
    }else{
        $queryVotes = "SELECT COUNT(*) FROM voted";
        $result = mysqli_query($conn, $queryVotes);

        $outof = "SELECT COUNT(*) FROM userlogin";
        $result_voters = mysqli_query($conn, $outof);
       ?>
            <div class="card text-center voting-card">
            <?php if(isset($_GET['success'])) {?>
            <div class="alert alert-success"  role="alert">
                <h4 class="alert-heading">Success <i class="fa-solid fa-check"></i></h4>
                <p>Note: <strong><?php echo $_GET['success'] ?></strong> has been updated</p>
                <a href="index.php" class="btn btn-outline-success">Close</a>
            </button>
            </div> 
		    <?php unset( $_GET['success']); }?>	
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Votes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="generate_report.php">Generate Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="fa-sharp fa-solid fa-rotate"></i> Refresh</a>
                    </li>
                    </ul>
                </div>
                <div class="card-body">

                    <h5 class="card-title"> <b><?php
                    while ($row = mysqli_fetch_array($result)){
                        $current= $row['COUNT(*)'];
                        echo $current;
                    }
                ?></b> <span class="text-secondary d">out of</span>
                <?php while ($rowUser = mysqli_fetch_array($result_voters)){
                     $max_voters = $rowUser['COUNT(*)'];
                     echo $max_voters;
                } ?>
                </h5>
                <p class="card-text">Already Voted</p>
                <progress value="<?php echo $current;?>" max="<?php echo $max_voters;?>"> <?php echo $current;?></progress>
                <br>
                <a href="all_over_votes.php" class="btn btn-primary">All Over Election Votes</a>
                </div>
                </div>

       <?php
    }
     
     ?> -->

</div>

<div class="separator-line bottom-separator"></div>
<?php include 'footer.php'?>
</body>


