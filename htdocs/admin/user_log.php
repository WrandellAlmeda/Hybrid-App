<?php
session_start();
$title = 'Log/s';
include "session/session.php";
include "connection.php";
require 'include/headerAdmin.php';
$conn=mysqli_connect($host,$user,$password,$db);

$limit = 50;
$lrn_query = $_GET['lrn'];
if (isset($_GET["page"])) {
	$page  = $_GET["page"]; 
	} 
	else{ 
	$page=1;
	};  
$start_from = ($page-1) * $limit;  
$result = mysqli_query($conn,"SELECT * FROM logs WHERE user_id = $lrn_query ORDER BY id DESC LIMIT $start_from, $limit");

$query_name = mysqli_query($conn,"SELECT * FROM userlogin WHERE LRN = $lrn_query");
foreach($query_name as $name){
    $name_user = $name['fullname'];
}
?>

<style>
    .body-table{
        max-width: 900px;
        height: 100%;
        margin: auto;
        margin-bottom: 4em;
        font-family: 'Poppins', sans-serif;
    }

    td{
        font-size: 14px;
        padding: 1em;
    }

    h1{
        padding-top: 1em;
        padding-bottom: 1em;
    }

    .laman{
        margin-top: 1em;
    }

    .float-right input{
			padding: 2px 12px 2px 12px;
			border-radius: 5px;
	}

    .float-right{
        max-width: 300px;
        float: right;
        
    }

    input{
	width: 100%;
	background: #fff;
	color: #333;
	padding-left: 10px;
	letter-spacing: 0.5px;
	padding-left: 1em;
	}

	.form-fields{
	width: 100%;
	position: relative;
	}

    .separator-line{
	width: 100%;
	height: 4px;
	background-image: linear-gradient(to right, #8b33c5, #15a0e1);
	margin-top: 20px;
	}

    @media (max-width: 780px){
        .body-table{
            width: 100%;
            height: 100%;
            padding: 1em;
        }
        

        table{
            overflow-x: auto;
        }
        th{
            font-size: 10px;
        }

        h1{
            font-size: 32px;
            text-align: center;
        }
        
        .call-name{
            text-align: center;
        }
        
    
    }
</style>

<body>
    <div class="body-table">
        <div class="laman">
            <h1><i class="fa-solid fa-globe"></i> Logs</h1>
            <p class="text-muted call-name">Activiyt Log of <strong><?php echo $name_user;?></strong></p>
        <table class="table table-hover table-sm table-responsive">
            <thead>
                <tr>
                <th scope="col" hidden>#</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
                <th scope="col">Date and Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row=mysqli_fetch_array($result)){
                    ?>
                    <tr>
                    <td hidden><?php echo $row['id'];?></td>
                    <td class="text-muted" style="padding-top: 1em; padding-bottom: 1em;"><?php echo $row['name'];?></td>
                    <td class="text-primary" style="padding-top: 1em; padding-bottom: 1em;"><?php echo $row['action'];?></td>
                    <td class="text-muted" style="padding-top: 1em; padding-bottom: 1em;"><?php 
                    $date = $row['date'];
                    echo date('M d,Y h:i A', strtotime($date));?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
            </table>
        </div>
        <?php  
        $user_lrn = $_GET['lrn'];
		$result_db = mysqli_query($conn,"SELECT COUNT(id) FROM logs WHERE user_id = $user_lrn"); 
		$row_db = mysqli_fetch_row($result_db);  
		$total_records = $row_db[0];  
		$total_pages = ceil($total_records / $limit); 
		/* echo  $total_pages; */
		$pagLink = "<ul class='pagination overflow-auto'>";  
		for ($i=1; $i<=$total_pages; $i++) {
              $pagLink .= "<li class='page-item'><a class='btn btn-sm btn-primary' href='user_log.php?lrn=$user_lrn&page=".$i."'>".$i."</a></li>";	
            }
            echo $pagLink . "</ul>";  
            ?>
    </div>
    <div class="separator-line bottom-separator"></div>
    <?php include "footer.php";?>
</body>