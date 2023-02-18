<?php 
session_start();
$title="Terms & Conditions";
include "include/headerStudent.php";
include "session/sessionStudent.php";
include "connection.php";

?>

<style>
    .body-of-paragraph{
        max-width: 780px;
        min-height: 70vh;
        margin: auto;
        font-family: 'Poppins', sans-serif;
        
    }

    .box{
        height: 60vh;
        padding: 1em;
        overflow-x: auto;
        
    }

    .box p{
       text-align: justify;
       font-size: 14px;
    }
    .separator-line{
	width: 100%;
	height: 4px;
	background-image: linear-gradient(to right, #8b33c5, #15a0e1);
	margin-top: 20px;
    }

    .separator-line-footer{
	width: 100%;
	height: 4px;
	background-image: linear-gradient(to right, #8b33c5, #15a0e1);
    }

    .pinaka-box h4{
        font-size: 3ch;
        align-items: center;
        padding: 5px;
        padding-top: 18px;
        line-height: 20px;
    }

    .form{
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        
    }
    .form .item{
        /* padding: 10px; */
        padding-right: 5px;
    }

    /* width */
    ::-webkit-scrollbar {
    width: 10px;
    height: 7px;
    }

/* Track */
    ::-webkit-scrollbar-track {
    box-shadow: inset 0 0 1px grey; 
    border-radius: 10px;
    }
 
/* Handle */
    ::-webkit-scrollbar-thumb {
    background: linear-gradient(to right, #8b33c5, #15a0e1); 
    border-radius: 10px;
    }

/* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to right, #8b33c5, #15a0e1);  
    }
</style>


<body>

    <div class="body-of-paragraph">
    <div class="separator-line"></div>
    <div class="promax-box">
        <div class="pinaka-box">
            <h4>Terms and Conditions</h4>
            <hr>
        </div>
                <div class=box>
                   <ul>
                    <li>
                    Election voting is available only through SFNHS Voting App
                    </li>
                    <li>
                    Election voting is available only for current enrolled students of SFNHS
                    </li>
                    <li>
                    Election voting is available only to the following Member contacts registered
                    </li>
                    <li>
                    An online vote cannot be withdrawn after it has been submitted
                    </li>
                    <li>
                    Every ballot is confidential
                    </li>
                    <li>
                        The following information is recorded for audit purposes:
                            <ul>
                                <li>
                                <p> The student’s information submitting the ballot</p>
                                </li>
                                <li>
                                 <p> The number of votes submitted </p>
                                </li>
                                <li>
                                <p>The time the ballot was submitted</p>
                                </li>
                                <li>
                                <p> The specific choice exercised by the voter is not linked to any voter’s identity</p>
                                </li>
                                <li>
                                <p> A vote verification page listing receipt of all votes submitted. This allows voters to verify that their votes have been submitted anonymously</p>
                                </li>
                            </ul>
                    </li>
                <li>
                A ballot that is submitted is deemed to be representative of the SFNHS Student in whose name it is submitted.
                </li>
                </ul>
                </div>
                <hr>      
    </div>
    <div class="form">
        <div class="item">
        <a href="studentHome.php" class="btn btn-outline-primary">Decline</a>
        </div>
        <div class="item">
        <a href="scanner.php" class="btn btn-primary">Accept</a>
        </div>
    </div>
    </div>
</body>