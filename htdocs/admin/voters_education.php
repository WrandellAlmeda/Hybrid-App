<?php 
    session_start();
    $title = 'Student';
    include 'include/headerStudent.php';
    include "connection.php";
    include 'session/sessionStudent.php';
?>


<style>
    .section{
        max-width: 1100px;
        height: auto;
        margin: auto;
        margin-top: 2em;
        margin-bottom: 2em;
        display: grid;
        grid-template-columns: 1fr 1fr;
        font-family: 'Poppins', sans-serif; 
    }
    
    .title{
        background: -webkit-linear-gradient( #8b33c5, #15a0e1);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
        text-align: right;
        font-weight: bold;
        margin-right: .5em;
        
    }

    h4{
        color: #333;
        background-color: #eee;
        border-left: 2px solid blue;
        padding-left: 1em;
        padding-top: .5em;
        padding-bottom: .5em;
        margin-right: 1em;
    }

    b{
        color: blue;
    }

    .paragraph{
       
        font-size: 12px;
        padding: 2.5em;
        text-align  : justify;
        font-family: 'Poppins', sans-serif;
        border-left: 2px solid red;
    }

    .img-div{
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    
    .steps{
        height: 80vh;
        overflow-x: auto;
    }
    ::-webkit-scrollbar {
    width: 5px;
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
    @media (max-width: 780px){
        .section{
            all: unset;
            width: 100%;
            display: flex;
            flex-direction: column-reverse;
        }

        .steps{
        width: 100%;
        height: 100%;
        padding: 1em;
        padding-right: 0;
        
        }

        .img{
            width:100%;
            padding: 1em;
        }

        .title{
            padding: 1em;
            text-align: center;
        }
    }
</style>
<body>

    <div class="section">
        <div class="img-div">
        <img src="assets/Steps In Votingv2.png" class="img" alt="Steps">

        </div>
        <div class="steps">
            <h1 class="title">Voters Education</h1>
            
            <h4> Step 1</h4>
            <p class="paragraph">
                <b>WAIT</b> for your <b>QR CODE</b> and email which you will need to use on any 
                activity on SAN FELIPE NATIONAL HIGH SCHOOL Voting System that is sent to you by the Election 
                Officers
            </p>
            <h4> Step 2</h4>
            <p class="paragraph">
                <b>HAVE</b> your QR ready for Scanning and keep it private.
            </p>
            <h4> Step 3</h4>
            <p class="paragraph">
                <b>CONNECT</b> to any types of internet Connection to Access the SAN FELIPE NATIONAL HIGH SCHOOL Voting Application.
            </p>

            <h4> Step 4</h4>
            <p class="paragraph">
                <b>PROCEED</b> to Login your account on SAN FELIPE NATIONAL HIGH SCHOOL Voting Application.
            </p>

            <h4> Step 5</h4>
            <p class="paragraph">
                <b>Go</b> Access the SFNHS Voting App and on <b>Vote Now card</b>, select the module you are participating in. Choose between <b>"Election"</b> and <b>"Pageant"</b>.
            </p>

            <h4> Step 6</h4>
            <p class="paragraph">
                <b>ACCOMPLISH</b> the ballot by selecting the oval button before the name of the candidate you
                wish to vote for. Do not overvote.
            </p>

            <h4> Step 7</h4>
               <p class="paragraph">
                    <b>CHECK</b> All of your votes if correct and change it if there is a mistake.
                    <br>
                    <b>AFTER</b> Checking. Press SUBMIT to finally cast your vote.
               </p>

               <h4> Step 8</h4>
               <p class="paragraph">
                    <b>DONE VOTING</b>, your vote is already casted.
               </p>
        </div>
    </div>
    
    <?php include 'footer.php';?>
</body>