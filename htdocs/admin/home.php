<?php
session_start();
$title = 'Option';
include "connection.php";
include "session/session.php";
require 'include/headerAdmin.php';



?>

<style>
    .section{
        max-width: 1100px;
        height: 90vh;
        margin: auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1em;
        align-items: center;
        font-family: 'Poppins', sans-serif;
    }

    .card{
        width: 100%;
        height: 50%;
        border-radius: none;
        border-left: 5px solid blue;
    }

    h2{
        background: -webkit-linear-gradient( #8b33c5, #15a0e1);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
    }

    .card-body a{
        float: right;
    }

    .card-body{
        padding: 70px 1em;
        align-items: center;
        justify-content: center;
    }
   
    @media (max-width: 800px){
        body{
            width: 100%;
        }
        .section{
            all: unset;
            height: 100%;
            margin: auto;
            padding: 1em;
            display: flex;
            flex-direction: column;
        }

        .card{
        width: 100%;
        height: 50%;
        padding: 1em;
        margin-top: 1em;
        border-left: 5px solid blue;
    }

    .card-img-overlay{
        padding: 3em;
    }

    }

</style>


<body>
    <div class="section"> 

            <div class="card">
            <div class="card-body">
            <h2 class="card-title">ELECTION</h2>
                <p class="card-text">Proceed to Election Home page</p>
                <a href="index.php" class="btn btn-outline-primary"><i class="fa-solid fa-arrow-right-to-bracket"></i> Proceed</a>
            </div>
            </div>

            <div class="card">
            <div class="card-body">
            <h2 class="card-title">PAGEANT</h2>
                <p class="card-text">Proceed to Pageant Home Page</p>
            <a href="admin_pageant_home.php" class="btn btn-outline-primary"><i class="fa-solid fa-arrow-right-to-bracket"></i> Proceed</a>
            </div>
            </div>
    </div>

    <?php include 'footer.php';?>

</body>