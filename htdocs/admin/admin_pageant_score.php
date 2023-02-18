<?php 
    session_start();
    $title = 'Admin';
    include "connection.php";
    include "session/session.php";
    include 'include/headerAdmin.php';
    include 'slugify.php';
    $conn=mysqli_connect($host,$user,$password,$db);

    $pageant_candidate_lrn = $_GET['lrn'];
    $judge_query = mysqli_query($conn, "SELECT * FROM judge");
    $criteria = mysqli_query($conn, "SELECT * FROM criteria");
    $pageant_candidate = mysqli_query($conn, "SELECT * FROM pageant_candidates WHERE LRN = $pageant_candidate_lrn");
    $query_count = "SELECT count(*) FROM judge";
    $result_count = mysqli_query($conn, $query_count);

    while ($rowUser = mysqli_fetch_array($result_count)){
        $total_judge = $rowUser['count(*)'];
    } 
?>
<style>
    .box{
        max-width: 1100px;
        margin: auto;
        overflow-x: auto;
    }

    .info{
        max-width: 1100px;
        margin: auto;
        display: grid;
        grid-template-columns: .5fr 1fr;
        margin-top: 1em;
        margin-bottom: .5em;
        border: 1px solid #eee;
        padding: .5em;
    }
    .img{
        width: 200px;
    }

    .pic{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
         
    }
    h5{
    background: #eee;
    padding: 1em;
    border-left: 2px solid blue;
    margin-top: 5px;
    }
</style>

<body>

    <div class="info">
        <?php
        foreach($pageant_candidate as $keme){
            $name = $keme['Name'];
            $lrn = $keme['LRN'];
            $img =  $keme['picture'];
            $grade =  $keme['grade'];
            $section =  $keme['section'];
            $gender =  $keme['gender'];
        }
        ?>
        <div class="pic">
            <img src="<?php echo $img?>" alt="" class="img">

        </div>
        <div>
        <p><?php echo $name?></p>
        <p><?php echo $grade?></p>    
        <p><?php echo $section?></p>    
        <p><?php if($gender == "M"){
            echo "MALE";
            }else{
                echo "FEMALE";
            }?></p>        
        </div>
    </div>

    
    <div class="box">
    <h5>Scores Breakdown</h5>
   
<table class="table table-bordered table-responsive-sm">
    <thead>
        <tr>
        <th>Judge</th>
        <?php foreach($criteria as $cri){
            ?>
            <th><?php echo $cri['criteria_description'];?> (<?php echo $cri['percentage']?> Points)</th>
            <?php
            }?>
            <!-- <th>Total</th> -->
        </tr>
    </thead>
    <tbody>
   
        <?php
       
         foreach($judge_query as $row){
                 $id = $row['id'];
                 $total = 0;
            ?>
             <tr>
            <td scope="row" style="text-transform: uppercase;"><?php echo $row['first_name'];?> <?php echo $row['last_name'];?></td>
            <?php
            foreach($criteria as $list_cri){
                $criteria_id = $list_cri['id'];
                
                $query_score = mysqli_query($conn, "SELECT * FROM judge_votes WHERE candidate_lrn = $pageant_candidate_lrn AND criteria_id = $criteria_id AND judge_id = $id");
                
                foreach($query_score as $score => $sc){
                    $score_fin =  $sc['score'];
                    $total +=  $sc['score'];
                    ?>
                     <td><?php echo $score_fin?></td>
                    <?php
                   
                }?>
                <?php
            }
            ?>
            <!-- <td scope="row"><?php echo $total?></td> -->
            </tr>   
            <?php
        }?>
    </tbody>
</table>

<table class="table table-bordered table-responsive-sm">
    <thead>
        <tr>
        <th>Judge</th>
       <th>Total Score</th>
        </tr>
    </thead>
    <tbody>
   
        <?php
        $grand_total = 0;
         foreach($judge_query as $row){
                 $id = $row['id'];
                 $total = 0;
            ?>
             <tr>
            <td scope="row" style="text-transform: uppercase;"><?php echo $row['first_name'];?> <?php echo $row['last_name'];?></td>
            <?php
            foreach($criteria as $list_cri){
                $criteria_id = $list_cri['id'];
                
                $query_score = mysqli_query($conn, "SELECT * FROM judge_votes WHERE candidate_lrn = $pageant_candidate_lrn AND criteria_id = $criteria_id AND judge_id = $id");
                
                foreach($query_score as $score => $sc){
                    $score_fin =  $sc['score'];
                    $total +=  $sc['score'];
                    
                }?>
                <?php
            }
            ?>
            <td scope="row"><?php echo $total?></td>
            </tr>
            
            <?php
            $grand_total += $total;
        }?>
        <tr>
            <td align="right" colspan="1">Total Percentage</td>
            <td align="center" colspan="1"><?php 
            $total_percentage = $grand_total / $total_judge;
            echo $total_percentage;
            
            ?> %</td>
        </tr> 
       
            
        
   
    </tbody>
</table>

    </div>
</body>