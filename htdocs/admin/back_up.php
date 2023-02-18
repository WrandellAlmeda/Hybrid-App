<?php
session_start();
$title = 'List Of Voters';
include "connection.php";
include "session/session.php";
require 'include/headerAdmin.php';
$conn=mysqli_connect($host,$user,$password,$db);


$sql_election_files = mysqli_query($conn, "SELECT * FROM dump WHERE type = 'Election Report' ORDER BY id DESC");
$sql_pageant_files = mysqli_query($conn, "SELECT * FROM dump WHERE type = 'Pageant Report' ORDER BY id DESC");

?>

<style>
    .lagayan{
        max-width: 780px;
        margin: auto;
        justify-content: center;
        align-items: center;
    }

    .card-text{
        font-size: 10px;
    }
    
    .card{
        width: 12rem;
        margin: 8px;
    }

    .button{
        max-width: 780px;
        margin: auto;
        margin-top: 2em;
    }

    .title-head{
        padding: 1em;
        background: #eee;
        margin-top: 10px;
    }
</style>

<div id="Page1">
    <div class="button">
    <a href="#" class="btn btn-primary" onclick="return show('Page2','Page1');"><i class="fa-solid fa-folder"></i> Show Pageant Files</a>
    <h5 class="title-head">Election Files</h5>
    </div>

<div class="lagayan d-flex flex-wrap">

    <?php 
    while($row = mysqli_fetch_array($sql_election_files)){
        ?>
        <div>
        <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?php echo $row['type'];?></h5>
            <p class="card-text"><?php echo $row['date'];?></p>
            <a href="<?php echo $row['pdf_file']?>" class="card-link" download>Download</a>
        </div>
        </div>
        </div>

        <?php
    }
    ?>
</div>
</div>

<div id="Page2" style="display:none">
<div class="button">
    <a href="#" class="btn btn-primary" onclick="return show('Page1','Page2');"><i class="fa-solid fa-folder"></i> Show ELection Files</a>
    <h5 class="title-head">Pageant Files</h5>
</div>

<div class="lagayan d-flex flex-wrap">
<?php 
    while($row = mysqli_fetch_array($sql_pageant_files)){
        ?>
        <div>
        <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?php echo $row['type'];?></h5>
            <p class="card-text"><?php echo $row['date'];?></p>
            <a href="<?php echo $row['pdf_file']?>" class="card-link" download>Download</a>
        </div>
        </div>
        </div>

        <?php
    }
    ?>
</div>
</div>



<script>
		function show(shown, hidden) {
		document.getElementById(shown).style.display='block';
		document.getElementById(hidden).style.display='none';
		return false;
		}
</script>