    <?php
session_start();
$title = 'Scan';
include 'include/headerStudent.php';
include "connection.php";
include 'session/sessionStudent.php';

$conn=mysqli_connect($host,$user,$password,$db);
$parse_open = parse_ini_file('open.ini', FALSE, INI_SCANNER_RAW);
$voting_close_open = $parse_open['open_voting'];

foreach($query_voter as $can){
    $voters_lrn =  $can['LRN'];
}

?>

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

<div class="modal fade" id="editmodal" role="dialog">
    <div class="modal-dialog">
    
      <div class="modal-content">
        <div class="modal-header">
			<h4 class="modal-title">Your Vote</h4>
        </div>
		<div class="modal-body form-update">

            <?php
                
                $view_vote = "SELECT * FROM votes WHERE voters_lrn = $voters_lrn";
                $vote_query = $conn->query($view_vote);

                foreach($vote_query as $voted => $value){
                    $candidate_lrn = $value['candidate_lrn'];
                    $view_can = "SELECT * FROM candidates WHERE LRN = $candidate_lrn";
                    $query = $conn->query($view_can);
                    while($row=mysqli_fetch_array($query)){
                        ?>
                        <p class="backdrop"><img src="<?php echo $row['picture']?>" alt="" width="80px" height="80px"> <b><?php echo $row['Position']; ?></b>: <?php echo $row['Name']; ?></p>
                        <?php
                    }

                }
            
            
            ?>
       
        </div>
        <div class="modal-footer">
			<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
			</div>
    </div>
  </div>
</div>

<?php

if($voting_close_open == 'open'){
    ?>
   
   <div class="scanner">
   <?php 
   $sql = "SELECT * FROM votes WHERE voters_lrn = $voters_lrn";
   $vquery = $conn->query($sql);
   if($vquery->num_rows > 0){
     ?>
       <div class="empty-already">
            <div class="img-gif">
                <img class="emty-img" src="assets/check.gif" alt="" width="100%" height="100%">
                <h4 class="statement">You have already voted for this Election</h4>
            </div>

            <div class="img-gif">
            <!-- <a class="btn btn-xm btn-primary view_vote" data-toggle="modal" data-target="#editmodal"><i class="fa-solid fa-list"></i> View Vote</a> -->
            </div>
        </div>
       <?php
   }else{
   ?>
    <div class="title-scanner">
    <h2>Scan QR Code</h2>
    <?php if(isset($_GET['notYou'])) {?>
        <div class="alert alert-danger" irole="alert">
        <h4 class="message">Failed <i class="fa-solid fa-triangle-exclamation"></i></h4>
        <p>Note: <strong><?php echo $_GET['notYou'] ?></strong></p>
        <a href="scanner.php" class="btn btn-outline-danger">Close</a>
        </div>
    <?php unset( $_GET['notYou']); }?> 
   </div>  
<div class="separator-line"></div>
        <div id="qr-reader"></div>
        <div id="qr-reader-results" hidden></div>
<div class="separator-line-two"></div>
    <form action="voting_ballot.php" method="get">
        <br>
    <input type="number" name="lrn" id="text" placeholder="Enter LRN" class="form-control" hidden>
    </form>
    </div>

    <?php

   }
        }else{
            ?>
        <div class="emtpy">
            <div class="img">
                <img class="emty-img" src="assets/closed.svg" alt="" width="100%" height="100%">
                <h5 class="statement">The Election is close!</h5>
                <p class="statement">Please, bear with us</p>
            </div>
        </div>
            <?php
        }
        
        ?>

<script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"> </script>
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-build/master/instascan.min.js"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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
            "qr-reader", { fps: 20, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);


// function onScanSuccess(decodedText, decodedResult) {
//     console.log(`Code scanned = ${decodedText}`, decodedResult);
// }
// var html5QrcodeScanner = new Html5QrcodeScanner(
// 	"qr-reader", { fps: 10, qrbox: 250 });
// html5QrcodeScanner.render(onScanSuccess);

// html5QrcodeScanner.addListener('scan',function(c){
//       document.getElementById('text').value=c;
//       document.forms[0].submit();
//     });
</script>
<script>
$(document).ready(function (){

$('.edit_btn').on('click', function(){
	$('#editmodal').modal('hide');

	$tr = $(this).closest('tr');

	var data = $tr.children("td").map(function(){
		return $(this).text();
	}).get();

	console.log(data);
}); 

});
</script>
</body>