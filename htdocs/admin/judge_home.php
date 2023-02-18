<?php 
    session_start();
    $title = 'Scan QR Code';
    // include "include/headerJudge.php";
    include "connection.php";
    include 'session/sessionJudge.php';
?>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="../sanfelipe_logo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <script src="https://kit.fontawesome.com/a9c1005e87.js" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<!-- CSS only -->
	<!-- JavaScript Bundle with Popper -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    .title-scanner{
        max-width: 780px;
        margin: auto;
        text-align: center;
        padding-top: 2em;
        font-family: 'Poppins', sans-serif;
        color: #333;
    }
    .scanner{
        max-width: 500px;
        height: 100vh;
        margin: auto;
        font-family: 'Poppins', sans-serif;
    }

    .scanner video{
        width: 100%;
    }

    .separator-line{
	width: 100%;
	height: 4px;
	background-image: linear-gradient(to right, #8b33c5, #15a0e1);
	margin-top: 20px;
    margin-bottom: 5px;
    }

    .separator-line-two{
	width: 100%;
	height: 4px;
	background-image: linear-gradient(to left, #8b33c5, #15a0e1);
    }

    .or{
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        padding-top: 10px;
        text-align: center;
    }

    form{
        padding-top: none;
    }

    .hypen{
        font-size: 30px;
        color: #ABA2A0;
    }
    
    .empty{
        max-width: 870px;
        margin: auto;
    }

    .img{
        max-width: 870px;
        height: 70vh;
        margin: auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .img img{
        width: 30%;
        margin: auto;
    }

    .img-gif img{
        width: 100%;
        margin: auto;
    }

    .img-gif > h3{
        text-align: center;
    }

    .statement{
        color:  #707070;
    }

    .modal{
        font-family: 'Poppins', sans-serif;
    }

    .empty-already{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    #qr-reader__status_span{
        display: none;
    }

    span a {
        display: none;
    }

    #qr-reader{
        width: 100%;
    }

    #qr-reader button{
        font-family: 'Poppins', sans-serif;
        font-size: 12px;
        color: #333;
    }

    #qr-reader__dashboard_section_swaplink{
        display: none;
    }

    #qr-reader__dashboard_section_swaplink button{
        font-family: 'Poppins', sans-serif;
        color: #333;
        font-size: 12px;
    }

   

    @media (max-width: 750px){
        .title-scanner{
            margin: 5px;
        }

        .scanner{
            margin: auto;
            height: 80vh;
        }

        .empty-already{
            margin-top: 3em;
        }

         .empty-already h4{
            text-align: center;
         }

         .form-update img{
            display: none;
         }

         .backdrop{
            padding: .3em;
            border-bottom: 2px solid #eee;
         }
    }
</style>

<body>
<div class="scanner">
<div class="title-scanner">
    <h2>Scan QR Code</h2>
    <?php if(isset($_GET['notYou'])) {?>
        <div class="alert alert-danger" irole="alert">
        <h4 class="message">Failed <i class="fa-solid fa-triangle-exclamation"></i></h4>
        <p>Note: <strong><?php echo $_GET['notYou'] ?></strong></p>
        <a href="judge_home.php" class="btn btn-outline-danger">Close</a>
        </div>
    <?php unset( $_GET['notYou']); }?> 
   </div>  
<div class="separator-line"></div>
        <div id="qr-reader"></div><br>
        <div id="qr-reader-results" hidden></div>
<div class="separator-line-two"></div>
    <form action="judge_voting_envi.php" method="get">
        <br>
    <input type="text" name="email" id="text" value="" placeholder="Email Address" class="form-control" hidden>
    </form>
    </div>
    </div>

     <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
     <!-- <script src="https://unpkg.com/html5-qrcode"></script> -->
    <!-- <script src="html5-qrcode.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script src="/assets/js/html5-qrcode.min.v2.3.4.js"></script>
    <script src="/assets/js/app.min.v2.3.3.js"></script> -->

    <!-- <script src="./node_modules/html5-qrcode/html5-qrcode.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js" integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"> </script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-build/master/instascan.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->

<script>
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, result, countResults = 0;

        function onScanSuccess(decodedText, decodedResult) {
        if (decodedText !== lastResult) {
            ++countResults;
            lastResult = decodedText;
            // Handle on success condition with the decoded message.
            // console.log (`Scan result ${decodedText}`, decodedResult);
            var code_id_value = document.getElementById("qr-reader-results").innerHTML=  lastResult;
            document.getElementById("text").value = code_id_value;
            document.forms[0].submit();
        }
    }
         var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);

        


</script>               
</body>