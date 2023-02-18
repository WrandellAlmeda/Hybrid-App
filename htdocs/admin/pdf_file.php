<?php

session_start();
$title = 'ADD STUDENT';
include "connection.php";
include "session/session.php";
require "include/headerAdmin.php";

// Database Connection 
$conn=mysqli_connect($host,$user,$password,$db);
//Check for connection error

$pdf_file = $_GET['pdf']; 

?>
<style>
    .pdf-con{
        max-width: 100%;
        height: 90vh;
        margin: auto;
    }

    .pdf-con iframe{
        width: 100%;
        height: 100%;
    }

    .pdf-title{
        max-width: 1200px;
        margin: auto;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        padding: 1em;
    }

    .a{
        font-size: 30px;
        padding: 1em;
    }

    .separator-line{
	width: 100%;
	height: 4px;
	background-image: linear-gradient(to right, #8b33c5, #15a0e1);
    }
</style>

<body>
    <div class="pdf-title" hidden>
        <div>
        <a href="requests.php" class="a"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        <div>
        <h1 hidden>PDF FILE</h1>
        </div>
    </div>
    <div class="separator-line bottom-separator"></div>
<div class="pdf-con">
<object data='<?php echo $pdf_file; ?>' width ="100%" height="100%" frameborder="0"></object>
</div>
</body>

