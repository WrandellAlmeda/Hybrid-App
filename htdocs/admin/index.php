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

    $queryOfficer = "SELECT COUNT(*) FROM userlogin WHERE usertype='user' AND status='officer'";
    $resultOfficer = mysqli_query($conn, $queryOfficer);

    $queryCandidate1 = "SELECT count(*) FROM candidates WHERE confirm = 1";
    $resultCandidate1 = mysqli_query($conn, $queryCandidate1);

    $queryCandidate = "SELECT COUNT(*) FROM candidates WHERE confirm = 2";
    $resultCandidate = mysqli_query($conn, $queryCandidate);

    if(isset($_POST['btn_votes'])){
        $query_total_vote = mysqli_query($conn, "SELECT * FROM candidates WHERE confirm = 2");

        foreach($query_total_vote as $cast){
            $real_candidate_lrn = $cast['LRN'];
            $select_candidate_lrn = mysqli_query($conn, "SELECT COUNT(candidate_lrn) FROM votes WHERE candidate_lrn = $real_candidate_lrn");
            foreach($select_candidate_lrn as $real){
                $total_votes_candidate = $real['COUNT(candidate_lrn)'];
                $sql_real_votes_insert = mysqli_query($conn, "UPDATE `candidates` SET `total_votes`= $total_votes_candidate WHERE LRN = $real_candidate_lrn");
            }
        }
    }

?>
<style>

    .container-width{
        max-width: 900px;
        height: 100vh;
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

    }



</style>


<body>
<div class="container container-width">

<h1 class="titol">ELECTION</h1>
<div class="jumbotron">
<div class="row w-100">
    <a href="voterslist.php"  class="text-warning text-white">
        <div class="col-md-3">
            <div class="card border-info text-info mx-sm-1 p-3">
                <div class="card border-info shadow text-info p-3 my-card" ><span class="fa-solid fa-user" aria-hidden="true"></span></div>
                <div class="card-text text-center mt-3"><h4>Voters</h4></div>
                <div class=" card-text text-center mt-2"><h1><?php while ($rowUser = mysqli_fetch_array($resultUser)){?>
                    <?php echo $rowUser['COUNT(*)'];?>
            <?php } ?></h1></div>
            </div>
            </a>
        </div>

        <div class="col-md-3">
        <a href="candidateslist.php"  class="text-warning text-white">
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

        <div class="col-md-3">
        <a href="officers.php"  class="text-warning text-white">
            <div class="card border-info text-info mx-sm-1 p-3">
                <div class="card border-info shadow text-info p-3 my-card" ><span class="fa-solid fa-user-shield" aria-hidden="true"></span></div>
                <div class="card-text text-center mt-3"><h4>Staff</h4></div>
                <div class="card-text text-center mt-2"><h1><?php while ($row = mysqli_fetch_array($resultOfficer)){?>
	            <?php echo $row['COUNT(*)'];?>
                <?php }?></h1></div>
            </div>
                </a>
        </div>

        <div class="col-md-3">
            <a href="requests.php"  class="text-warning text-white">
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

     <?php
    
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
                        <?php
                        $ctrnum = $_SESSION['Ctrl_num'];

                        $queryCtr = mysqli_query($conn,"SELECT * FROM admin WHERE CtrlNum = $ctrnum");
                        while($wil = mysqli_fetch_array($queryCtr)){
                        ?>
                        
                        <a class="nav-link" href="generate_report.php?marie=<?php echo $wil['fullname'];?>">Generate Report</a>
                        <?php
                    }
                

                    ?>
                    </li>
                    <li class="nav-item">
                    <form action="" method="post" onchange='if(this.value != 0) { this.form.submit(); }'>
                    <input type="submit" value="Refresh" class="nav-link" name="btn_votes"> 
                    </form>
                        <!-- <a class="nav-link" href="index.php"> Refresh</a> -->
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
     
     ?>

</div>

<div class="separator-line bottom-separator"></div>
<?php include 'footer.php'?>
</body>


