<?php 
session_start();
include 'connection.php';
include "session/session.php";
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$conn = mysqli_connect($host, $user, $password, $db);

    if(isset($_POST['delete_office'])){
        $lrn = $_POST['lrn'];

        $sql = mysqli_query($conn,"UPDATE userlogin SET status='student' WHERE LRN = $lrn");
        if($sql){
            header("location: officers.php?success_officer= Successfully Removed");
         }else{
            header("location: officers.php?error_officer= Won't work, please try again!");
         }
    }

    //Update Voters info voterslist.php
            if(isset($_POST["update"])){
                $lrn = $_POST["lrn"];
                $name = $_POST["name"];
                $grade = $_POST["grade"];
                $section = $_POST["section"];
                $username = $_POST["username"];
   

                $width = 250;
                $height = 250;
                $url = "https://chart.googleapis.com/chart?cht=qr&chs={$width}x{$height}&chl={$lrn}";


                $run=mysqli_query($conn, "UPDATE userlogin SET LRN = '$lrn', qr_code='$url', username='$username', fullname='$name', grade='$grade', section='$section' WHERE LRN='$lrn'") or die(mysqli_error());
              
                if($run){
                                       //Create instance of PHPMailer
                                       $mail = new PHPMailer();
                                       //Set mailer to use smtp
                                           $mail->isSMTP();
                                       //Define smtp host    
                                           $mail->Host = "smtp.gmail.com";
                                       //Enable smtp authentication
                                           $mail->SMTPAuth = true;
                                       //Set smtp encryption type (ssl/tls)
                                           $mail->SMTPSecure = "tls";
                                       //Port to connect smtp
                                           $mail->Port = "587";
                                       //Set gmail username
                                       $mail->Username = "sfnhs.edu.test@gmail.com";
                                       //Set gmail password
                                           $mail->Password = "xsxjyxnzwhxtvrzc";
                                       //Email subject
                                           $mail->Subject = "ACCOUNT UPDATED";
                                       //Set sender email
                                           $mail->setFrom('sfnhs.edu.test@gmail.com');
                                       //Enable HTML
                                           $mail->isHTML(true);
                                       //Attachment
                                           //$mail->addAttachment('img/attachment.png');
                                       //Email body
                                       $mail->Body = "<p><b>Hi, $name!</b></p>  
                                       <p>Your information has been updated</p>
                                       <p>Email : <b>$username</b></p>
                                      
                   
                   
                                       <p>Thank you.</p>
                                       ";
                   
                                           $mail->AddBCC($username);
                                           $mail->send();
                    header("location:voterslist.php?success=$name");
                    exit();
                }else{
                    header("location:voterslist.php?success=$name");
                    exit();
                }
                
            }

        //Delete Voter in voterslist.php
            if(isset($_POST["delete"])){
                $id = $_POST["lrn"];
                $name = $_POST["name"];
            
                $query = "DELETE FROM userlogin where LRN = '$id'";
                $query_run = mysqli_query($conn, $query);
            
                if($query_run){
                    header("location:voterslist.php?deleted= $name");
                }else{
                    header("location:voterslist.php?deleted= there was an error!");
                }
            }
        //Delete Officer
            if(isset($_POST["deleteOfficer"])){
                $id = $_POST["lrn"];
                $name = $_POST["name"];
            
                $query = "DELETE FROM officers where LRN = '$id'";
                $query_run = mysqli_query($conn, $query);
            
                if($query_run){
                    header("location:officerslist.php?deleted= $name");
                }else{
                    header("location:officerslist.php?deleted= there was an error!");
                }
            }
    //Update Officer
            if(isset($_POST["updateOfficer"])){
                // $ctrlnum = ["view_id"];
                $lrn = $_POST["lrn"];
                $name = $_POST["name"];
                $grade = $_POST["grade"];
                $section = $_POST["section"];
                $username = $_POST["username"];
                $password = $_POST["password"];
            
                $width = 250;
                $height = 250;
                $url = "https://chart.googleapis.com/chart?cht=qr&chs={$width}x{$height}&chl={$lrn}";
            
                // $hash = password_hash($password, 
                //       PASSWORD_DEFAULT);
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $run=mysqli_query($conn, "UPDATE officers SET LRN = '$lrn', qr_code='$url', username='$username', password='$hashedPassword', fullname='$name', grade='$grade', section='$section' WHERE LRN='$lrn'") or die(mysqli_error());
                if($run){
                    $final_query=mysqli_query($conn, "UPDATE userlogin SET LRN = '$lrn', qr_code='$url', username='$username', password='$hashedPassword', fullname='$name', grade='$grade', section='$section' WHERE LRN='$lrn'") or die(mysqli_error());
                    if($final_query){
                        header("location:officerslist.php?success=$name");
                        exit();
                    }else{
                        header("location:officerslist.php?success=There is an error");
                        exit();
                    }
                }
                header("location:officerslist.php?success=$name");
            }

            //Edit Position candidateslist.php PARA DON SA TABLE NG ADDING NG POSITION(mismong POSITION NAME) PARA SA CANDIDATE
            if(isset($_POST["editPosition"])){
                $id = $_POST["view_id"];
                $position = $_POST["section"];
                $maxVotes = $_POST['maxVotes'];
                $query_check = mysqli_query($conn,"UPDATE `position` SET `id`='$id', `position`='$position', `max_vote`='$maxVotes' WHERE `id`='$id'") or die(mysqli_error());
                
                if($query_check){
                    $final_query=mysqli_query($conn,"UPDATE `position` SET `id`='$id', `position`='$position', `max_vote`='$maxVotes' WHERE `id`='$id'") or die(mysqli_error());
                   if($final_query){
                    header("location:candidateslist.php?success=$position");
                    exit();
                   }else{
                    header("location:candidateslist.php?error=$position");
                    exit();
                   }
                }else{
                    header("location:voterslist.php?success=$position");
                    exit();
                }
               
            }

            if(isset($_POST["editCriteria"])){
                $id = $_POST["view_id"];
                $position = $_POST["section"];
                $query_check = mysqli_query($conn,"UPDATE `criteria` SET `id`='$id', `criteria_description`='$position' WHERE `id`='$id'") or die(mysqli_error());
                
                if($query_check){
                    header("location:admin_pageant_list.php?success=$position");
                    exit();
                }else{
                    header("location:admin_pageant_list.php?error=$position Changing Description Failed");
                    exit();
                }
               
            }

            if(isset($_POST["deletePosition"])){
                $section = $_POST["section"];
            
                $query = "DELETE FROM position where position = '$section'";
                $query_run = mysqli_query($conn, $query);
            
                if($query_run){
                    $delete_all = "DELETE FROM `candidates` WHERE `Position`='$section'";
                    $delete = mysqli_query($conn, $delete_all);
                    if($delete){
                        header("location:candidateslist.php?deleted=$section");
                    }
                }else{
                    header("location:candidateslist.php?deleted= there was an error!");
                }
            }

            if(isset($_POST["deleteCriteria"])){
                $section = $_POST["section"];
            
                $query = "DELETE FROM criteria where criteria_description = '$section'";
                $query_run = mysqli_query($conn, $query);
            
                if($query_run){
                        header("location:admin_pageant_list.php?deleted=$section");
                }else{
                    header("location:admin_pageant_list.php?error= there was an error!");
                }
            }

            //Edit of Election title
            if(isset($_POST['EditElectionTitle'])){
                $title = $_POST['electionTitle'];
            
                $file = 'config.ini';
                $content = 'election_title = '.$title;
            
               $run=file_put_contents($file, $content);
            
               if($run){
                header("location:candidateslist.php?success= Election Title ($title)");
                }else{
                header("location:candidateslist.php?error= there was an error!");
                }
            
            }

            //Open or close
            if(isset($_POST['open_close'])){
                $voting_close_open = $_POST['validate_close_open'];
            
                $file = 'open.ini';
                $content = 'open_voting = '.$voting_close_open;


                if($voting_close_open == 'open'){
                    $run=file_put_contents($file, $content);
                    
                    if($run){
                        header("location:candidateslist.php?openorclose= Election is Now $voting_close_open");
                        }else{
                        header("location:candidateslist.php?error= there was an error!");
                        }
                }else{
                    $run=file_put_contents($file, $content);
                    
                    if($run){
                        header("location:candidateslist.php?openorclose= Election is Now $voting_close_open");
                        }else{
                        header("location:candidateslist.php?error= there was an error!");
                        }

                }
            
              
            
            
            }

            if(isset($_POST['open_close_pageant'])){
                $voting_close_open = $_POST['validate_close_open'];
            
                $file = 'open_pageant.ini';
                $content = 'open_voting = '.$voting_close_open;


                if($voting_close_open == 'open'){
                    $run=file_put_contents($file, $content);
                    
                    if($run){
                        header("location:admin_pageant_list.php?openorclose= Election is Now $voting_close_open");
                        }else{
                        header("location:admin_pageant_list.php?error= there was an error!");
                        }
                }else{
                    $run=file_put_contents($file, $content);
                    
                    if($run){
                        header("location:admin_pageant_list.php?openorclose= Election is Now $voting_close_open");
                        }else{
                        header("location:admin_pageant_list.php?error= there was an error!");
                        }

                }
            
              
            
            
            }
        //Update Candidate
            if(isset($_POST["updateCandidate"])){
                $id = $_POST['view_id'];
                $name = $_POST['name'];
                $position = $_POST['position'];
                $Platform = $_POST['platform'];
                $LRN = $_POST['lrn'];
                $grade = $_POST['grade'];
                $section = $_POST['section'];
            
            
                $query = "UPDATE candidates SET id='$id', Position='$position', Name='$name', Platform ='$Platform', LRN ='$LRN', grade ='$grade', section ='$section' WHERE LRN='$LRN'";
                $run = mysqli_query($conn,$query) or die(mysqli_error());
                if($run){
                    header("location:candidateslist.php?success=$name");
                }else{
                    header("location:candidateslist.php?error=There was an error!");
                }
            }

            if(isset($_POST["update_pageant_candidate"])){
                $id = $_POST['view_id'];
                $name = $_POST['name'];
                $position = $_POST['position'];
                $Platform = $_POST['platform'];
                $LRN = $_POST['lrn'];
                $grade = $_POST['grade'];
                $section = $_POST['section'];
            
            
                $query = "UPDATE pageant_candidates SET id='$id', Position='$position', Name='$name', Motto ='$Platform', LRN ='$LRN', grade ='$grade', section ='$section' WHERE LRN='$LRN'";
                $run = mysqli_query($conn,$query) or die(mysqli_error());
                if($run){
                    header("location:admin_pageant_list.php?success=$name");
                }else{
                    header("location:admin_pageant_list.php?error=There was an error!");
                }
            }


        //Delete Candidate
            if(isset($_POST["deleteCandidate"])){
                $id = $_POST["lrn"];
                $name = $_POST["name"];
            
                $query = "DELETE FROM candidates where LRN = '$id'";
                $query_run = mysqli_query($conn, $query);
            
                if($query_run){
                    header("location:candidateslist.php?deleted= $name");
                }else{
                    header("location:candidateslist.php?deleted= there was an error!");
                }
            }

            if(isset($_POST["delete_pageant"])){
                $id = $_POST["lrn"];
                $name = $_POST["name"];
            
                $query = "DELETE FROM pageant_candidates where LRN = '$id'";
                $query_run = mysqli_query($conn, $query);
            
                if($query_run){
                    header("location:admin_pageant_list.php?deleted= $name");
                }else{
                    header("location:admin_pageant_list.php?deleted= there was an error!");
                }
            }
        //Add Position
            if(isset($_POST['addPosition'])){
	
                $section = $_POST['section'];
                $maxvotes = $_POST['maxVotes'];
            
                
                $query_section = "SELECT * FROM position WHERE position = '$section'";
                $query_check = mysqli_query($conn,$query_section) or die(mysqli_error());
            
                if(mysqli_num_rows($query_check)){
                    header("location:candidateslist.php?error= $section");
                    exit();
                }else{
                    $query = "INSERT INTO `position`(position, max_vote) VALUES ('$section', '$maxvotes')";
                    $run = mysqli_query($conn,$query) or die(mysqli_error());
                    if($run){
                        header("location:candidateslist.php?added=$section");
                        exit();
                    }
                }
            }

           
            if(isset($_POST['addCriteria'])){
	
                $section = $_POST['section'];
                $maxvotes = $_POST['maxVotes'];

                $query_percent = "SELECT sum(percentage) FROM criteria";
			    $result_percentage = mysqli_query($conn, $query_percent);
			
                $row_percent = mysqli_fetch_array($result_percentage);
                $total_percentage = $row_percent[0];
                $sum = $maxvotes + $total_percentage;

                if($sum > 100){
                    header("location:admin_pageant_list.php?error= Score Percentage Exceeded!");
                    exit();
                }else{
                    $query = "INSERT INTO `criteria`(criteria_description, percentage) VALUES ('$section', '$maxvotes')";
                        $run = mysqli_query($conn,$query) or die(mysqli_error());
                        if($run){
                            header("location:admin_pageant_list.php?added=$section");
                            exit();
                        }
                }
            
                
                // $query_section = "SELECT * FROM criteria WHERE position = '$section'";
                // $query_check = mysqli_query($conn,$query_section) or die(mysqli_error());
            
                // if(mysqli_num_rows($query_check)){
                //     header("location:candidateslist.php?error= $section");
                //     exit();
                // }else{
                //     $query = "INSERT INTO `position`(position, max_vote) VALUES ('$section', '$maxvotes')";
                //     $run = mysqli_query($conn,$query) or die(mysqli_error());
                //     if($run){
                //         header("location:candidateslist.php?added=$section");
                //         exit();
                //     }
                // }
            }
            
            //filtering of Candidates (showcase candidates)
            if(isset($_POST['candidate_position'])){

                $selection = $_POST['can_position'];
                $filter_section = mysqli_query($conn,"SELECT * FROM candidates WHERE position = '$selection'");
            
                if(mysqli_num_rows($filter_section)){
                    $card = mysqli_query($conn,"SELECT * FROM candidates WHERE position = '$selection'" );
                    $candidateTitle = $selection;
                }else{
                    $card = mysqli_query($conn,"SELECT * FROM candidates ORDER BY id ASC");
                    $candidateTitle = "All Candidates";
                }
            }

            //Confirm request of candidate
        if(isset($_POST["confirmed"])){
            $lrn = $_POST["lrn"];
            $name = $_POST["name"];
            $confirm = 2;
              
            $sellrn = "SELECT * FROM userlogin WHERE LRN = '$lrn'";
            $resultlrn = mysqli_query($conn, $sellrn);
  
            foreach($resultlrn as $emails){
              $emailadd = $emails['username']; 
            }

            $run=mysqli_query($conn, "UPDATE `candidates` SET `confirm`='$confirm' WHERE LRN='$lrn'") or die(mysqli_error());
            if($run){

                      //Create instance of PHPMailer
                      $mail = new PHPMailer();
                      //Set mailer to use smtp
                          $mail->isSMTP();
                      //Define smtp host    
                          $mail->Host = "smtp.gmail.com";
                      //Enable smtp authentication
                          $mail->SMTPAuth = true;
                      //Set smtp encryption type (ssl/tls)
                          $mail->SMTPSecure = "tls";
                      //Port to connect smtp
                          $mail->Port = "587";
                      //Set gmail username
                      $mail->Username = "sfnhs.edu.test@gmail.com";
                      //Set gmail password
                          $mail->Password = "xsxjyxnzwhxtvrzc";
                      //Email subject
                          $mail->Subject = "ACCEPT OF ELECTION COC";
                      //Set sender email
                          $mail->setFrom('sfnhs.edu.test@gmail.com');
                      //Enable HTML
                          $mail->isHTML(true);
                      //Attachment
                          //$mail->addAttachment('img/attachment.png');
                      //Email body
                      $mail->Body = "<p><b>Hi, $name!</b></p>  
                    <p>Congratulations, this is to inform you that your application is <b>ACCEPTED</b>.</p>
                   
                    
                    <p>Thank you.</p>
                    ";
  
                          $mail->AddBCC($emailadd);
                          $mail->send();

                header("location:requests.php?success=$name");
                exit();
            }else{
                header("location:requests.php?success=$name");
                exit();
            }
            
        }

        if(isset($_POST['add_judge'])){
	
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $password = $last_name;
            
        
            $width = 250;
            $height = 250;
            $url = "https://chart.googleapis.com/chart?cht=qr&chs={$width}x{$height}&chl={$email}";
         
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
             $query_section = "SELECT * FROM judge WHERE email = '$email'";
             $query_check = mysqli_query($conn,$query_section) or die(mysqli_error());
         
             if(mysqli_num_rows($query_check)){
                 header("location:admin_judge_list.php?error= $email");
                 exit();
             }else{
                        //Create instance of PHPMailer
                        $mail = new PHPMailer();
                        //Set mailer to use smtp
                            $mail->isSMTP();
                        //Define smtp host    
                            $mail->Host = "smtp.gmail.com";
                        //Enable smtp authentication
                            $mail->SMTPAuth = true;
                        //Set smtp encryption type (ssl/tls)
                            $mail->SMTPSecure = "tls";
                        //Port to connect smtp
                            $mail->Port = "587";
                        //Set gmail username
                        $mail->Username = "sfnhs.edu.test@gmail.com";
                        //Set gmail password
                            $mail->Password = "xsxjyxnzwhxtvrzc";
                        //Email subject
                            $mail->Subject = "REGISTRATION JUDGE SUCCESS NOTIFICATION ";
                        //Set sender email
                            $mail->setFrom('sfnhs.edu.test@gmail.com');
                        //Enable HTML
                            $mail->isHTML(true);
                        //Attachment
                            //$mail->addAttachment('img/attachment.png');
                        //Email body
                        $mail->Body = "<p><b> Hi, $first_name $last_name! </b></p>
                        <p>You are successfully registered to San Felipe National High School Application as a Pageant Judge.</p>
                        <p>Here is your Default Account to access the SFNHS Application!</p>
                        <h4>Username : <b> $email</b></h4>
                        <h4>Password : <b> $password</b></h4>
                        <p><b>Note:</b> We are encouraging to change your password on your first visit on the app for extra security. </p>
                        <a href='$url'><img src='$url'></a>
                        <p>You can download the SFNHS APP on this Link.</p>
                        <p>https://www.mediafire.com/file/w0tl8z738r13mff/SFNHS.apk/file</p>
                        ";

                            $mail->AddBCC($email);
                            $mail->send();


                 $query = "INSERT INTO `judge`(first_name, last_name, email, password, qr_code) VALUES ('$first_name', '$last_name', '$email', '$hashedPassword', '$url')";
                 $run = mysqli_query($conn,$query) or die(mysqli_error());
                 if($run){
                     header("location:admin_judge_list.php?added=$email");
                     exit();
                 }
             }
         }

        //Confirm request of candidate
        if(isset($_POST["declined"])){
            $lrn = $_POST["lrn"];
            $name = $_POST["name"];
            $confirm = 2;

            
            $sellrn = "SELECT * FROM userlogin WHERE LRN = '$lrn'";
            $resultlrn = mysqli_query($conn, $sellrn);
  
            foreach($resultlrn as $emails){
              $emailadd = $emails['username']; 
            }

            $run=mysqli_query($conn, "UPDATE `candidates` SET `confirm`= confirm +'$confirm' WHERE LRN='$lrn'") or die(mysqli_error());
            if($run){

                    //Create instance of PHPMailer
                    $mail = new PHPMailer();
                    //Set mailer to use smtp
                        $mail->isSMTP();
                    //Define smtp host    
                        $mail->Host = "smtp.gmail.com";
                    //Enable smtp authentication
                        $mail->SMTPAuth = true;
                    //Set smtp encryption type (ssl/tls)
                        $mail->SMTPSecure = "tls";
                    //Port to connect smtp
                        $mail->Port = "587";
                    //Set gmail username
                    $mail->Username = "sfnhs.edu.test@gmail.com";
                    //Set gmail password
                        $mail->Password = "xsxjyxnzwhxtvrzc";
                    //Email subject
                        $mail->Subject = "DECLINE OF ELECTION COC";
                    //Set sender email
                        $mail->setFrom('sfnhs.edu.test@gmail.com');
                    //Enable HTML
                        $mail->isHTML(true);
                    //Attachment
                        //$mail->addAttachment('img/attachment.png');
                    //Email body
                    $mail->Body = "<p><b>Hi, $name!</b></p>  
                    <p>Sorry, this is to inform you that your application is DECLINED.</p>
                    <p>Here is the result of your evaluation </p>
                    <b>Qualification for Candidates</b>
                    <ul>
                        <li>Be bona fide students. </li>
                        <li>Be of good academic standing with a general average of 85 and above without any failing grade during the 1st to 3rd grading period of the current school year. </li>
                        <li>Be of good moral character. </li>
                        <li>Have not been subjected to any disciplinary sanction. </li>
                        <li>Have submitted the SPG/SSG Election Application Packet to be approved by a representative of the SPG/SSG Commission on Elections. </li>
                    </ul>  
                    <p>Thank you.</p>
                    ";

                        $mail->AddBCC($emailadd);
                        $mail->send();

                header("location:requests.php?error=$name has been Declined");
                exit();
            }else{
                header("location:requests.php?error=$name has been Declined");
                exit();
            }
            
        }

         //Confirm request of candidate
         if(isset($_POST["confirmed_pageant"])){
            $lrn = $_POST["lrn"];
            $name = $_POST["name"];
            $confirm = 2;


            $sellrn = "SELECT * FROM userlogin WHERE LRN = '$lrn'";
            $resultlrn = mysqli_query($conn, $sellrn);
  
            foreach($resultlrn as $emails){
              $emailadd = $emails['username']; 
            }


            $run=mysqli_query($conn, "UPDATE `pageant_candidates` SET `confirm`='$confirm' WHERE LRN='$lrn'") or die(mysqli_error());
            if($run){
                
                  //Create instance of PHPMailer
                  $mail = new PHPMailer();
                  //Set mailer to use smtp
                      $mail->isSMTP();
                  //Define smtp host    
                      $mail->Host = "smtp.gmail.com";
                  //Enable smtp authentication
                      $mail->SMTPAuth = true;
                  //Set smtp encryption type (ssl/tls)
                      $mail->SMTPSecure = "tls";
                  //Port to connect smtp
                      $mail->Port = "587";
                  //Set gmail username
                  $mail->Username = "sfnhs.edu.test@gmail.com";
                  //Set gmail password
                      $mail->Password = "xsxjyxnzwhxtvrzc";
                  //Email subject
                      $mail->Subject = "ACCEPT PAGEANT APPLICATION";
                  //Set sender email
                      $mail->setFrom('sfnhs.edu.test@gmail.com');
                  //Enable HTML
                      $mail->isHTML(true);
                  //Attachment
                      //$mail->addAttachment('img/attachment.png');
                  //Email body
                  $mail->Body = "<p><b>Hi, $name!</b></p>  
                  <p>Congratulations, this is to inform you that your application is <b>ACCEPTED</b>.</p>
                 
                  
                  <p>Thank you.</p>
                  ";

                    $mail->AddBCC($emailadd);
                    $mail->send();


                header("location:admin_pageant_request.php?success=$name");
                exit();
            }else{
                header("location:admin_pageant_request.php?success=$name");
                exit();
            }
            
        }

        //Confirm request of candidate
        if(isset($_POST["declined_pageant"])){
            $lrn = $_POST["lrn"];
            $name = $_POST["name"];
            $confirm = 2;

            $sellrn = "SELECT * FROM userlogin WHERE LRN = '$lrn'";
            $resultlrn = mysqli_query($conn, $sellrn);
  
            foreach($resultlrn as $emails){
              $emailadd = $emails['username']; 
            }

            $run=mysqli_query($conn, "UPDATE `pageant_candidates` SET `confirm`= confirm +'$confirm' WHERE LRN='$lrn'") or die(mysqli_error());
            if($run){

                //Create instance of PHPMailer
                $mail = new PHPMailer();
                //Set mailer to use smtp
                    $mail->isSMTP();
                //Define smtp host    
                    $mail->Host = "smtp.gmail.com";
                //Enable smtp authentication
                    $mail->SMTPAuth = true;
                //Set smtp encryption type (ssl/tls)
                    $mail->SMTPSecure = "tls";
                //Port to connect smtp
                    $mail->Port = "587";
                //Set gmail username
                $mail->Username = "sfnhs.edu.test@gmail.com";
                //Set gmail password
                    $mail->Password = "xsxjyxnzwhxtvrzc";
                //Email subject
                    $mail->Subject = "DECLINE OF PAGEANT APPLICATION";
                //Set sender email
                    $mail->setFrom('sfnhs.edu.test@gmail.com');
                //Enable HTML
                    $mail->isHTML(true);
                //Attachment
                    //$mail->addAttachment('img/attachment.png');
                //Email body
                $mail->Body = "<p><b>Hi, $name!</b></p>  
                <p>Sorry, this is to inform you that your application is DECLINED.</p>
                <p>Here is the result of your evaluation </p>
                <b>Qualification for Candidates</b>
                <ul>
                    <li>Be bona fide students. </li>
                    <li>Be of good academic standing with a general average of 85 and above without any failing grade during the 1st to 3rd grading period of the current school year. </li>
                    <li>Be of good moral character. </li>
                    <li>Have not been subjected to any disciplinary sanction. </li>
                    <li>Have submitted the SPG/SSG Election Application Packet to be approved by a representative of the SPG/SSG Commission on Elections. </li>
                </ul>  
                <p>Thank you.</p>
                ";
            

         $mail->AddBCC($emailadd);
         $mail->send();


                header("location:admin_pageant_request.php?error=$name has been Declined");
                exit();
            }else{
                header("location:admin_pageant_request.php?error=$name has been Declined");
                exit();
            }
            
        }
        
        if(isset($_POST["register"])){

            $lrn = $_POST['LRN'];
            $querytolrn = "SELECT * FROM userlogin where LRN='$lrn'";
            $query_verify = mysqli_query($conn,$querytolrn);
        
            $queryLrn = "SELECT * FROM student_info where LRN='$lrn'";
            $query_run = mysqli_query($conn,$queryLrn);
        
            if(mysqli_num_rows($query_verify)){
                header("location:voterslist.php?error=$lrn is already registered");
             }
             elseif(mysqli_num_rows($query_run) > 0){
            $lrn = $_POST["LRN"];
            $name = $_POST["name"];
            $grade = $_POST["grade"];
            $section = $_POST["section"];
            $gender = $_POST["gender"];
            $userType = $_POST["user-type"];
            $username = $_POST["username"];
            $password1 = $_POST['password'];
            $status = 'student';
        
        
            $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);
            $width = 250;
            $height = 250;
            $url = "https://chart.googleapis.com/chart?cht=qr&chs={$width}x{$height}&chl={$lrn}&{$name}";
        
            $query = "insert into userlogin(qr_code, username, password, usertype, LRN, fullname, grade, section,gender,status) values('$url','$username','$hashedPassword','$userType','$lrn','$name','$grade','$section','$gender','$status')";
            $run = mysqli_query($conn,$query) or die(mysqli_error());
        
                if($run){
                    header("location:voterslist.php?added=$name");
                    //Create instance of PHPMailer
                    $mail = new PHPMailer();
                    //Set mailer to use smtp
                        $mail->isSMTP();
                    //Define smtp host
                        $mail->Host = "smtp.gmail.com";
                    //Enable smtp authentication
                        $mail->SMTPAuth = true;
                    //Set smtp encryption type (ssl/tls)
                        $mail->SMTPSecure = "tls";
                    //Port to connect smtp
                        $mail->Port = "587";
                    //Set gmail username
                        $mail->Username = "sfnhs.edu.test@gmail.com";
                    //Set gmail password
                        $mail->Password = "xsxjyxnzwhxtvrzc";
                    //Email subject
                        $mail->Subject = "STUDENT REGISTRATION SUCCESS NOTIFICATION";
                    //Set sender email
                        $mail->setFrom('sfnhs.edu.test@gmail.com');
                    //Enable HTML
                        $mail->isHTML(true);
                    //Attachment
                        // $mail->addAttachment("<img src='$url'");
                    //Email body
                    $mail->Body = "<p><b>Hi, $name!</b></p>
                    <p>You are successfully registered to San Felipe National High School Application</p>
                    <p>Here is your Default Account to access the SFNHS Application!</p>
                    <h4>Username : <b> $username</b></h4>
                    <h4>Password : <b> $password1</b></h4>
                    <p><b>Note:</b> We are encouraging to change your password on your first visit on the app for extra security. </p>
                    <a href='$url'><img src='$url'></a>
                    <p>You can download the SFNHS APP on this Link.</p>
                    <p>https://www.mediafire.com/file/w0tl8z738r13mff/SFNHS.apk/file</p>
                    ";

                        
                    $mail->AddBCC($username);
                
                    if ( $mail->send() ) {
                        echo "Email Sent..!";
                        header("location:voterslist.php?added=$name");
                    }else{
                        echo "Message could not be sent. Mailer Error: ";
                    }
                }
                else{
                    header("location:voterslist.php?error=There was an error");
                }

            }
        }
            
        
             //Edit of Election title
             if(isset($_POST['EditPageantTitle'])){
                $title = $_POST['electionTitle'];
            
                $file = 'pageant_title.ini';
                $content = 'election_title = '.$title;
            
               $run=file_put_contents($file, $content);
            
               if($run){
                header("location:admin_pageant_list.php?success= Election Title ($title)");
                }else{
                header("location:admin_pageant_list.php?error= there was an error!");
                }
            
            }


            //update judge 
            if(isset($_POST["updatejudge"])){
                $fname = $_POST['first_name'];
                $lname = $_POST['last_name'];
                $email = $_POST['email'];
                $id = $_POST['id'];
             
            
            
                $query = "UPDATE judge SET first_name='$fname', last_name='$lname', email='$email' WHERE id='$id'";
                $run = mysqli_query($conn,$query) or die(mysqli_error());
                if($run){
                    header("location:admin_judge_list.php?success=successfully updated");
                }else{
                    header("location:admin_judge_list.php?error=There was an error!");
                }
            }
            //delete judge
            if(isset($_POST["deletejudge"])){
                $email = $_POST["email"];
            
                $query = "DELETE FROM judge WHERE email = '$email'";
                $query_run = mysqli_query($conn, $query);
            
                if($query_run){
                        header("location:admin_judge_list.php?delete=$email");
                }else{
                    header("location:admin_judge_list.php?deleted= there was an error!");
                }
            }

                  //reset judge
                  if(isset($_POST["resetPageant"])){
                    $query = "DELETE FROM judge";
                    $query_run = mysqli_query($conn, $query);
                
                    if($query_run){
                        $query = "DELETE FROM judge_votes";
                        $query_run1 = mysqli_query($conn, $query);
                       
                        if($query_run1){
                            $query = "DELETE FROM pageant_candidates";
                            $query_run2 = mysqli_query($conn, $query);
                           
                            if($query_run2){
                                $query = "DELETE FROM criteria";
                                $query_run3 = mysqli_query($conn, $query);

                                if($query_run3){
                                    header("location:admin_profile.php?delete=successfull");
                                }
                                else{
                                    header("location:admin_profile.php?delete=error criteria"); 
                                }
                            }
                            else{
                                header("location:admin_profile.php?delete=error Pageant Candidates"); 
                            }                            
                        }
                        else{
                            header("location:admin_profile.php?delete=error Judge Votes"); 
                        }
                    }else{
                        header("location:admin_profile.php?delete=error Judge");
                    }
                }



                 //reset election
                 if(isset($_POST["resetElection"])){
                    
                            $query = "DELETE FROM voted";
                            $query_run2 = mysqli_query($conn, $query);
                           
                            if($query_run2){
                                $query = "DELETE FROM votes";
                                $query_run3 = mysqli_query($conn, $query);

                                if($query_run3){
                                    header("location:admin_profile.php?delete=Success Reset"); 
                                }
                                else{
                                    header("location:admin_profile.php?delete=error votes"); 
                                }
                            }
                            else{
                                header("location:admin_profile.php?delete=error voted"); 
                            }                            
                        }

                $output = '';
                if(isset($_POST["dlexcel"]))
                {
                
                
              
                
                $query = "SELECT * FROM student_info ORDER BY LRN DESC ";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0)
                {
                 $output .= '
                
                 <h1>SAN FELIPE NATIONAL HIGH SCHOOL</h1>
                
                  <table class="table text-center" bordered="2">  
                
                                   <tr>  
                                   <th>LRN</th>  
                                   <th>NAME</th>  
                                   <th>SEX</th>  
                                   <th>GRADE</th>
                                   <th>SECTION</th>
                                   <th>AGE</th>
                                   </tr>
                 ';
                 while($row = mysqli_fetch_array($result))
                 {
                  $output .= '
                   <tr>  
                                       <td>'.$row["LRN"].'</td>  
                                       <td>'.$row["NAME"].'</td>  
                                       <td>'.$row["SEX"].'</td>  
                                       <td>'.$row["GRADE"].'</td>  
                                       <td>'.$row["SECTION"].'</td>
                                       <td>'.$row["AGE"].'</td>
                                   
                                   </tr>
                  ';
                 }
                 $output .= '</table>';
                 header('Content-Type: application/xls');
                 header('Content-Disposition: attachment; filename=download.xls');
                 echo $output;
                }
                }


            if(isset($_POST['add_as_officer'])){
                $lrn = $_POST['lrn'];

                $query = mysqli_query($conn, "SELECT * FROM userlogin WHERE LRN = $lrn");
                
                foreach($query as $stats){
                    $status = $stats['status'];
                    if($status == 'officer'){
                        header("location: voterslist.php?error_officer=Already an Officer!");
                    }else{
                        $query_officer = mysqli_query($conn, "UPDATE `userlogin` SET `status`='officer' WHERE LRN = $lrn");
                        if($query_officer){
                             header("location: voterslist.php?success_officer=Add officer Successfully!");
                        }else{
                            header("location: voterslist.php?erro_officerr=Won't work, please try again!");
                        }
                    }
                } 
            }

            if(isset($_POST['update_score_pageant'])){
                $select_candidate = mysqli_query($conn, "SELECT * FROM pageant_candidates WHERE confirm = 2");
                $select_judge = mysqli_query($conn, "SELECT COUNT(*) FROM judge");

                foreach($select_judge as $jud){
                    $count_judge = $jud['COUNT(*)'];
                }
                foreach($select_candidate as $real_candidate){
                    
                    $total = 0;
                    $name_of_candidate = $real_candidate['Name'];
                    $lrn_of_candidate = $real_candidate['LRN'];
                    $select_criteria = mysqli_query($conn, "SELECT * FROM criteria");
                    foreach($select_criteria as $real_criteria){
                        $criteria_id = $real_criteria['id'];
                        $query_score = mysqli_query($conn, "SELECT * FROM judge_votes WHERE criteria_id = $criteria_id AND candidate_lrn = $lrn_of_candidate");
        
                        foreach($query_score as $real_score){
                            $total +=  $real_score['score'];
                        }
                        $grand_total = $total / $count_judge;
                        $pageant_query = "UPDATE pageant_candidates SET total_percentage = $grand_total WHERE LRN = $lrn_of_candidate";
                        $run = mysqli_query($conn, $pageant_query);
                    if($run){
                        header("location: admin_pageant_home.php?success=success");
                    }else{
                        header("location: admin_pageant_home.php?error=error");
                    }
                        
                    }
                    
                }
        
            }


            
//admin change pass
if(isset($_POST["changeadminpass"])){
    $email = $_POST["email"];
    $id = $_POST["id"];
    $name = $_POST["name"];
    $new_pass = $_POST["new_pass"];
    $re_pass = $_POST["re_pass"];

    if($new_pass != $re_pass){
        $action = "Failed Changing Password";
        $logs="INSERT INTO `logs`( `user_id`, `name`, `action`) VALUES ('$id','$name','$action')";
        $run_logs = mysqli_query($conn,$logs);
        header("location: admin_profile.php?error= Input Password Does not Match please try again!");
    }else{
   $finalpass = md5($re_pass);
        $run=mysqli_query($conn, "UPDATE admin SET password='$finalpass' WHERE CtrlNum=$id") or die(mysqli_error());
        if($run){
            $action = "Password modified Successfully";
            $logs="INSERT INTO `logs`( `user_id`, `name`, `action`) VALUES ('$id','$name','$action')";
            $run_logs = mysqli_query($conn,$logs);


            $mail = new PHPMailer();
            //Set mailer to use smtp
                $mail->isSMTP();
            //Define smtp host
                $mail->Host = "smtp.gmail.com";
            //Enable smtp authentication
                $mail->SMTPAuth = true;
            //Set smtp encryption type (ssl/tls)
                $mail->SMTPSecure = "tls";
            //Port to connect smtp
                $mail->Port = "587";
            //Set gmail username
                $mail->Username = "sfnhs.edu.test@gmail.com";
            //Set gmail password
                $mail->Password = "xsxjyxnzwhxtvrzc";
            //Email subject
                $mail->Subject = "CHANGE PASSWORD";
            //Set sender email
                $mail->setFrom('sfnhs.edu.test@gmail.com');
            //Enable HTML
                $mail->isHTML(true);
            //Attachment
                // $mail->addAttachment("<img src='$url'");
            //Email body
            $mail->Body = "<h5><b>Hi, $name!</b></h5>
            <p>Your password was successfully changed</p>
       
            ";

                
            $mail->AddBCC($email);
            $mail->send();
        

            if($run_logs){
                header("location: admin_profile.php?success= Change Password Successfully");
                exit();
            }else{
                header("location: admin_profile.php?error=Won't work, please try again!");
                exit();
            }
            
        }else{
            header("location: admin_profile.php?success=Won't work, please try again!");
            exit();
        }
        header("location: admin_profile.php?success= Change Password Successfully");
    }
}

           
//reset default password
if(isset($_POST["reset_default"])){
    $email = $_POST["email"];
    $lrn = $_POST["lrn"];
    $name = $_POST["name"];
 

    $hashedPassword = password_hash($lrn, PASSWORD_DEFAULT);
    $run=mysqli_query($conn, "UPDATE userlogin SET password='$hashedPassword' WHERE LRN=$lrn") or die(mysqli_error());
    if($run){
        $action = "Password modified Successfully";
        $logs="INSERT INTO `logs`( `user_id`, `name`, `action`) VALUES ('$lrn','$name','$action')";
        $run_logs = mysqli_query($conn,$logs);


      //Create instance of PHPMailer
      $mail = new PHPMailer();
      //Set mailer to use smtp
          $mail->isSMTP();
      //Define smtp host
          $mail->Host = "smtp.gmail.com";
      //Enable smtp authentication
          $mail->SMTPAuth = true;
      //Set smtp encryption type (ssl/tls)
          $mail->SMTPSecure = "tls";
      //Port to connect smtp
          $mail->Port = "587";
      //Set gmail username
          $mail->Username = "sfnhs.edu.test@gmail.com";
      //Set gmail password
          $mail->Password = "xsxjyxnzwhxtvrzc";
      //Email subject
          $mail->Subject = "RESET PASSWORD";
      //Set sender email
          $mail->setFrom('sfnhs.edu.test@gmail.com');
      //Enable HTML
          $mail->isHTML(true);
      //Attachment
          // $mail->addAttachment("<img src='$url'");
      //Email body
      $mail->Body = "<h5><b>Hi, $name!</b></h5>
      <p>Your password was successfully changed</p>
 
      ";
          
      $mail->AddBCC($email);
  
      if ( $mail->send() ) {
          echo "Email Sent..!";
          header("location:voterslist.php?added=$name");
      }else{
          echo "Message could not be sent. Mailer Error: ";
      }
    

        if($run_logs){
            header("location: voterslist.php?success= Change Password Successfully");
            exit();
        }else{
            header("location: voterslist.php?error=Won't work, please try again!");
            exit();
        }
        
    }else{
        header("location: voterslist.php?success=Won't work, please try again!");
        exit();
    }
   
}

        


?>