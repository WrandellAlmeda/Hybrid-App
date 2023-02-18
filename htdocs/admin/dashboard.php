<?php 
    session_start();
    $title = 'Dashboard';
    include "connection.php";
    include "session/session.php";
    include 'include/headerAdmin.php';
    include 'slugify.php';
    $conn=mysqli_connect($host,$user,$password,$db);
?>
<style>
    .dashboard{
        max-width: 870px;
        height: 100%;
        margin: auto;
        font-family: 'Poppins', sans-serif;
    }

    .padd{
        margin-top: 1em;
    }

    .col-4{
        margin-bottom: 1em;
    }

    .title{
        text-align: center;
        padding: 1em;
        font-weight: bold;
    }

    .grid{
        display: grid;
        grid-template-rows: 1fr;
        padding-bottom: 3em;
    }

    .btn{
        width: 100%;
        margin:12px;
    }

    .buttons{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

    .buttons a{
        text-decoration: none;
    }

    .graph{
        width: 100%;
        align-items: center;
        justify-content: center;
        margin:0 !important;
        padding-left: 1em;
    }

    .choices{
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    select{
        padding: 3px;
    }

    .charts{
        width: 100%; 
        min-height: 350px;
    }
    .separator-line{
	width: 100%;
	height: 4px;
	background-image: linear-gradient(to right, #8b33c5, #15a0e1);
	margin-top: 20px;
	}

    .tabular{
        max-width: 1100px;
        margin: auto;
    }

    p{
        margin-bottom: 0em;
    }

    .card{
        margin: 8px;
        font-family: 'Poppins', sans-serif;
        width: 28rem; 
        height: 50vh;
    }
    .card-body{
        overflow-x: auto;
    }

    progress{
        width: 100%;
        height: 30px;
    }

    .text-candidate{
        font-size: 12px;
    }

    .grade-count{
        font-size: 16px;
        text-align: center;
        padding: 8px;
    }
    ::-webkit-scrollbar {
  width: 4px;
  border: 1px solid #d5d5d5;
}

::-webkit-scrollbar-track {
  border-radius: 0;
  background: #eeeeee;
}

::-webkit-scrollbar-thumb {
  border-radius: 0;
  background: #b0b0b0;
}

hr{
    color: red;
}

.offcl_vote{
    color: green;
    background: #eee;
    padding-left: 5px;
    padding-right: 5px;
    border-radius: 10px;
    text-transform: bold;
}

.already_vote{
    color: green;
    background: #eeeeee;
    padding-left: 5px;
    padding-right: 5px;
    border-radius: 10px;
    text-transform: bold;
}

.grade_span{
    color: #fff;
    background: #15a0e1;
    padding-left: 12px;
    padding-right: 12px;
}

    @media (max-width: 780px){
        .graph{
            overflow-x: auto;
            margin-left: 12px;
        }

        form{
            width: 100%;
            margin: center;
        }

        .charts{
        width: 100%; 
        }

        .choices{
            width: 100%;
            display: flex;
            flex-direction: row;
            margin: auto;
            align-items: center;
            justify-content: center;
        }
        .align select{
            width: 100%;
        }

        .aling .input{
            width: 100%;
        }
        .buttons{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 1em;
        }

        .buttons a{
            width: 100%;
            margin-bottom: 12px;
            text-decoration: none;
            
        }
        .tabular{
        margin: auto;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 3em;
        }

        .card{
           width: 100%;
           margin: auto;
           margin-top: 1em;
        }

        progress{
        width: 100%;
        height: 30px;
         }

    }

    

</style>
<body>
    <div class="dashboard">
        <h1 class="title">Vote Transmission Progress</h1>
    <form action="" method="post">
        <div class="choices">
            <div class="align">
            <select name="graphs" id="" class="form-select" onchange='if(this.value != 0) { this.form.submit(); }'>
                    <optgroup label="Graphs">
                    <option <?php if(isset($_POST['graphs'])){$choice = $_POST['graphs']; if($choice == 'bar'){ echo "selected";}else{echo "";}}?> value="bar">Bar Graph</option>
                    <option <?php if(isset($_POST['graphs'])){$choice = $_POST['graphs']; if($choice == 'pie'){ echo "selected";}else{echo "";}}?> value="pie">Pie Graph</option>
                    <option <?php if(isset($_POST['graphs'])){$choice = $_POST['graphs']; if($choice == 'column'){ echo "selected";}else{echo "";}}?> value="column">Column Graph</option>
                    </optgroup>
                    </select>

            </div>

            <div class="choices">
            <select class="form-select" onchange="location = this.value;">
            <option value="" selected disabled>Vote Transmission</option>
            <?php 
                    $x = 7;
                    while($x <= 12){
                        $grade = $x;
                        ?>
                        <option value="votes.php?grade=<?php echo $grade ?>">Grade <?php echo $grade;?></option>
                        <?php
                         $x += 1;
                    }
                    ?>
            </select>
            </div>
            <!-- <div class="align">
            <input type="submit" name="choice_graph" value="confirm" class="input btn btn-primary btn-sm">
            </div> -->
        </div>
                </form>
                <hr>
        <div class="grid">
            <div class="graph">
                <?php
                if(isset($_POST['graphs'])){
                    $graphs = $_POST['graphs'];

                    if($graphs == 'bar'){
                        ?>
                        <div id="bar_chart" class="charts"></div>
                        <?php
                    }elseif($graphs == 'pie'){
                        ?>
                        <div id="piechart" class="charts"></div>
                        <?php
                    }elseif($graphs == 'column'){
                        ?>
                        <div id="top_x_div" class="charts"></div>
                        <?php
                    }else{
                        ?>
                         <div id="bar_chart" class="charts"></div>
                        <?php
                    }
                }else{
                    ?>  
                        <div id="bar_chart" class="charts"></div>
                        <?php
                }
                ?>
            </div>

            </div>

    </div>
    <div class="tabular d-flex flex-nowrap" >
        <?php

            $x = 7;
            while($x <= 9){
                $grade = $x;
                ?>
                <div class="card">
                <div class="card-header">
                    <?php
                     $query = "SELECT grade, COUNT(*) FROM userlogin WHERE grade = $grade";
                $resultUser = mysqli_query($conn, $query);
                while ($rowUser = mysqli_fetch_array($resultUser)){
                     $count =  $rowUser['COUNT(*)'];
                } 

                $total_voter = mysqli_query($conn, "SELECT COUNT(Grade) FROM voted WHERE Grade = $grade");
                while ($row_user = mysqli_fetch_array($total_voter)){
                    $count_user =  $row_user['COUNT(Grade)'];
               } 
                ?>
            
                 <?php echo "<p> <span class='grade_span'>Grade ".$grade."</span> <span class='already_vote'>".$count_user." Student already voted </span></p>"; ?>
                </div>
                <div class="card-body">
                <?php $query_count = mysqli_query($conn, "SELECT * FROM position");
               
                
                foreach($query_count as $pos){
                    $current_position = $pos['position'];

                    $ranking = mysqli_query($conn,"SELECT * FROM candidates WHERE Position='$current_position' AND confirm = 2 ORDER BY total_votes DESC");
                    echo  "<hr>";
                    echo "<p class='grade-count'>".$current_position."</p>";
                    foreach($ranking as $winner){
                        $can_lrn = $winner['LRN'];
                        $count_vote = mysqli_query($conn, "SELECT candidate_lrn, Grade, COUNT(*) FROM votes WHERE candidate_lrn = $can_lrn AND Grade = $grade");
                        while($row=mysqli_fetch_array($count_vote)){
                            echo "<p class='text-candidate'>".$winner['Name']." <span>".$row['COUNT(*)']." Votes</span></p>";
                           ?>
                            <progress value="<?php echo $row['COUNT(*)']?>" max="<?php echo $count?>"> <?php echo $row['COUNT(*)']?></progress>
                        <?php
                        }
                    }
                }
                ?>
                </div>
                </div>
                <?php
                $x += 1;
            }
        ?>
    </div>

    <div class="tabular d-flex justify-content-between">
        <?php

            $x = 10;
            while($x <= 12){
                $grade = $x;
                ?>
                <div class="card">
                <div class="card-header">
                <?php
                $query = "SELECT grade, COUNT(*) FROM userlogin WHERE grade = $grade";
                $resultUser = mysqli_query($conn, $query);
                while ($rowUser = mysqli_fetch_array($resultUser)){
                     $count =  $rowUser['COUNT(*)'];
                }
                $total_voter = mysqli_query($conn, "SELECT COUNT(Grade) FROM voted WHERE Grade = $grade");
                while ($row_user = mysqli_fetch_array($total_voter)){
                    $count_user =  $row_user['COUNT(Grade)'];
               } 
                ?>
                <?php echo "<p> <span class='grade_span'>Grade ".$grade."</span> <span class='already_vote'>".$count_user." Student already voted </span></p>"; ?>

                </div>
                <div class="card-body">
                <?php $query_count = mysqli_query($conn, "SELECT * FROM position");
                
                foreach($query_count as $pos){
                    $current_position = $pos['position'];

                    $ranking = mysqli_query($conn,"SELECT * FROM candidates WHERE Position='$current_position' AND confirm = 2 ORDER BY total_votes DESC");
                    echo  "<hr>";
                    echo "<p class='grade-count'>".$current_position."</p>";
                    foreach($ranking as $winner){
                        $can_lrn = $winner['LRN'];
                        $count_vote = mysqli_query($conn, "SELECT candidate_lrn, Grade, COUNT(*) FROM votes WHERE candidate_lrn = $can_lrn AND Grade = $grade");
                        while($row=mysqli_fetch_array($count_vote)){
                            echo "<p class='text-candidate'>".$winner['Name']." <span class='offcl_vote'>".$row['COUNT(*)']." Votes</span></p>"
                           ?>
                            <progress value="<?php echo $row['COUNT(*)']?>" max="<?php echo $count?>"> <?php echo $row['COUNT(*)']?></progress>
                        <?php
                        }
                    }
                }
                ?>
                </div>
                </div>
                
                <?php
                $x += 1;
            }
        ?>
    </div>
    <div class="separator-line bottom-separator"></div>
<?php include "footer.php";?>
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Grade', 'number'],
            <?php
            $x = 7;
   
            while($x <= 12){
                $grade= $x;
                $sql = "SELECT count(*)FROM voted WHERE grade = $grade";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)){
                    echo "['Grade ".$grade."', ".$row["count(*)"]."],";
                }
                $x += 1;
            }
            ?>
        ]);

        var options = {
          title: 'Votes'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
            ['Grade', 'votes'],
            <?php
            $x = 7;
   
            while($x <= 12){
                $grade= $x;
                $sql = "SELECT count(*)FROM voted WHERE grade = $grade";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)){
                    echo "['Grade ".$grade."', ".$row["count(*)"]."],";
                }
                $x += 1;
            }
            ?>
        ]);

        var options = {
          width: 780,
          legend: { position: 'none' },
          chart: {
            title: 'Counting Per Year Level',
            subtitle: 'From Grade 7 to 12' },
          axes: {
            x: {
              0: { side: 'top', label: 'Vote Count'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };
    </script>

<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
            ['Grade', 'votes'],
            <?php
            $x = 7;
   
            while($x <= 12){
                $grade= $x;
                $sql = "SELECT count(*)FROM voted WHERE grade = $grade";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)){
                    echo "['Grade ".$grade."', ".$row["count(*)"]."],";
                }
                $x += 1;
            }
            ?>
        ]);

        var options = {
          title: 'Counting Per Year Level',
          width: 780,
          legend: { position: 'none' },
          chart: { title: 'Counting Per Year Level',
                   subtitle: 'popularity by percentage' },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Percentage'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('bar_chart'));
        chart.draw(data, options);
      };
    </script>
</body>