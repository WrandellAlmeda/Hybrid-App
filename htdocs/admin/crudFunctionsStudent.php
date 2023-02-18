
<?php 
session_start();
include 'connection.php';
include "session/sessionStudent.php";

require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$conn = mysqli_connect($host, $user, $password, $db);

if(isset($_POST["unsubmit_coc"])){
    $un_coc = $_POST['entry_coc'];
    $query = mysqli_query($conn, "DELETE FROM `candidates` WHERE LRN = $un_coc");
    if($query){
        header("location: studentHome.php?success= COC has been unsubmit!");
    }else{
        header("location: studentHome.php?error= Won't work, please try again!");
    }
}

if(isset($_POST["unsubmit_pageant"])){
    $un_coc = $_POST['entry_pageant'];
    $query = mysqli_query($conn, "DELETE FROM `pageant_candidates` WHERE LRN = $un_coc");
    if($query){
        header("location: studentHome.php?success=Application for pageant has been unsubmit!");
    }else{
        header("location: studentHome.php?error= Won't work, please try again!");
    }
}


//Requesting to admin
if(isset($_POST['submit_coc'])){
    $lrn = $_POST['LRN'];
    $emails = $_POST['email'];
    $name = $_POST['fullname'];
    $grade = $_POST['grade'];
    $gender = $_POST['gender'];
    $section = $_POST['section'];
    $position = $_POST['position'];
    $confirm = $_POST['confirm'];
    $pdf = $_FILES['pdf_file'];
    $picture = $_FILES['picture_file'];
    $platform = $_POST['platform'];

    $fileName = $_FILES['pdf_file']['name'];
    $fileTmpName = $_FILES['pdf_file']['tmp_name'];
    $fileSize = $_FILES['pdf_file']['size'];
    $fileError = $_FILES['pdf_file']['error'];
    $fileType = $_FILES['pdf_file']['type'];

    $fileName1 = $_FILES['picture_file']['name'];
    $fileTmpName1 = $_FILES['picture_file']['tmp_name'];
    $fileSize1 = $_FILES['picture_file']['size'];
    $fileError1 = $_FILES['picture_file']['error'];
    $fileType1 = $_FILES['picture_file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    $fileExt1 = explode('.', $fileName1);
    $fileActualExt1 = strtolower(end($fileExt1));
    $allowed1 = array('jpg', 'jpeg', 'png', 'pdf');
    

    if (in_array($fileActualExt1, $allowed1)){

        if ($fileError === 0 && $fileError1 === 0){
            if ($fileSize < 209715200 && $fileSize1 < 209715200) {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileNameNew1 = uniqid('', true).".".$fileActualExt1;
                $fileDestination = 'pdf/'.$fileNameNew;
                $fileDestination1 = 'img/'.$fileNameNew1;
                move_uploaded_file($fileTmpName, $fileDestination);
                move_uploaded_file($fileTmpName1, $fileDestination1);


                $query_lrn = "SELECT * FROM candidates WHERE LRN = '$lrn'";
                $query_check = mysqli_query($conn,$query_lrn);
                if(mysqli_num_rows($query_check)){
                    header("location:studentHome.php?error=$name already candidates");
                }else{

 // This will send a gmail notification when form was submitted
                    // need pa ng email sa input


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
                      $mail->Subject = "SUBMISSION FOR ELECTION APPLICATION NOTIFICATION";
                  //Set sender email
                      $mail->setFrom('sfnhs.edu.test@gmail.com');
                  //Enable HTML
                      $mail->isHTML(true);
                  //Attachment
                      //$mail->addAttachment('img/attachment.png');
                  //Email body
                  $mail->Body = "<p><b>Hi, $name!</b></p>
                    <p>Your application is now pending and waiting for evaluation.</p>
                    <p>Kindly wait for the evaluation result.</p>

                    <p>Thank you.</p>
                  ";

                    $mail->AddBCC($emails);
                    $mail->send();



                    $action = "Submitted COC";
                    $logs="INSERT INTO `logs`( `user_id`, `name`, `action`) VALUES ('$lrn','$name','$action')";
                    $run_logs = mysqli_query($conn,$logs);

                    if($run_logs){


                        $query = "INSERT INTO `candidates`(`Position`, `Name`, `Platform`, `picture`, `LRN`, `grade`, `section`,`pdf`,`confirm`) VALUES ('$position','$name','$platform','$fileDestination1','$lrn','$grade','$section','$fileDestination','$confirm')";
                         $run = mysqli_query($conn,$query);
                    }
                    header("location:studentHome.php?added=$name");
                }
                
                
            }else
            {
                header("location:studentHome.php?error= The image file was too big, please attach less than 10 mb!");
            }
        }else{
            header("location:studentHome.php?error=Error upload, please try again!");
        }
    }else{
        header("location:studentHome.php?error=connot upload of this type of file");
    }
} 

if(isset($_POST['submit_application'])){
    $lrn = $_POST['LRN'];
    $email = $_POST['email'];
    $name = $_POST['fullname'];
    $grade = $_POST['grade'];
    $gender = $_POST['gender'];
    $section = $_POST['section'];
    $position = $_POST['position'];
    $confirm = $_POST['confirm'];
    $pdf = $_FILES['pdf_file'];
    $picture = $_FILES['picture_file'];
    $platform = $_POST['platform'];
    $date = $_POST['date'];

    $fileName = $_FILES['pdf_file']['name'];
    $fileTmpName = $_FILES['pdf_file']['tmp_name'];
    $fileSize = $_FILES['pdf_file']['size'];
    $fileError = $_FILES['pdf_file']['error'];
    $fileType = $_FILES['pdf_file']['type'];

    $fileName1 = $_FILES['picture_file']['name'];
    $fileTmpName1 = $_FILES['picture_file']['tmp_name'];
    $fileSize1 = $_FILES['picture_file']['size'];
    $fileError1 = $_FILES['picture_file']['error'];
    $fileType1 = $_FILES['picture_file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    $fileExt1 = explode('.', $fileName1);
    $fileActualExt1 = strtolower(end($fileExt1));
    $allowed1 = array('jpg', 'jpeg', 'png', 'pdf');
    

    if (in_array($fileActualExt1, $allowed1)){

        if ($fileError === 0 && $fileError1 === 0){
            if ($fileSize < 209715200 && $fileSize1 < 209715200) {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileNameNew1 = uniqid('', true).".".$fileActualExt1;
                $fileDestination = 'pdf/'.$fileNameNew;
                $fileDestination1 = 'pageant/'.$fileNameNew1;
                move_uploaded_file($fileTmpName, $fileDestination);
                move_uploaded_file($fileTmpName1, $fileDestination1);

                $query_lrn = "SELECT * FROM pageant_candidates WHERE LRN = '$lrn'";
                $query_check = mysqli_query($conn,$query_lrn);
                if(mysqli_num_rows($query_check)){
                    header("location:studentHome.php?error=You're Application is already Submitted");
                }else{



                    // This will send a gmail notification when form was submitted
                    // need pa ng email sa input


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
                      $mail->Subject = "SUBMISSION FOR PAGEANT APPLICATION NOTIFICATION";
                  //Set sender email
                      $mail->setFrom('sfnhs.edu.test@gmail.com');
                  //Enable HTML
                      $mail->isHTML(true);
                  //Attachment
                      //$mail->addAttachment('img/attachment.png');
                  //Email body
                  $mail->Body = "
                  <p><b>Hi, $name!</b></p>
                  <p>Your application is now pending and waiting for evaluation.</p>
                  <p>Kindly wait for the evaluation result.</p>

                  <p>Thank you.</p>
             ";

                    $mail->AddBCC($email);
                    $mail->send();

                        $action = "Submitted Entry (Pageant)";
						$default = date_default_timezone_set('Asia/Manila');
						$t = date('Y-m-d H:i:s');
						$query="INSERT INTO `logs`( `user_id`, `name`, `action`,`date`) VALUES ('$lrn','$name','$action','$t')";
						$run_logs = mysqli_query($conn,$query) or die(mysqli_error());
                    // $action = "Submitted Entry (Pageant)";
                    // $logs="INSERT INTO `logs`( `user_id`, `name`, `action`, `date`) VALUES ('$lrn','$name','$action', '$date')";
                    // $run_logs = mysqli_query($conn,$logs);

                    if($run_logs){
                        $query = "INSERT INTO `pageant_candidates`(`Position`, `Name`, `Motto`, `picture`, `LRN`, `grade`, `gender`, `section`,`pdf`,`confirm`,`Date`) VALUES ('$position','$name','$platform','$fileDestination1','$lrn','$grade','$gender','$section','$fileDestination','$confirm','$date')";
                         $run = mysqli_query($conn,$query);
                         header("location:studentHome.php?added=$name");
                    }

                } 
                
            }else
            {
                header("location:studentHome.php?error= The image file was too big, please attach less than 10 mb!");
            }
        }else{
            header("location:studentHome.php?error=Error upload, please try again! ");
        }
    }else{
        header("location:studentHome.php?error=Connot upload of because the type of file not supported!");
    }
}   

//update user (user nagpalit)
if(isset($_POST["edit_user_info"])){
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
            $action = "Update Credentials Successfully";
                    $logs="INSERT INTO `logs`( `user_id`, `name`, `action`) VALUES ('$lrn','$name','$action')";
                    $run_logs = mysqli_query($conn,$logs);

                    if($run_logs){
                        header("location: student_profile.php?success= Your Credential has been updated!");
                        exit();
                    }else{
                        header("location: student_profile.php?error=Won't work, please try again!");
                        exit();
                    }
    
    }else{
        header("location: student_profile.php?success=Your Credential has been updated!");
    }
    
}

//update user (user nagpalit)
if(isset($_POST["change_pass_user"])){
    $email = $_POST["email"];
    $lrn = $_POST["lrn"];
    $name = $_POST["name"];
    $new_pass = $_POST["new_pass"];
    $re_pass = $_POST["re_pass"];

    if($new_pass != $re_pass){
        $action = "Failed Changing Password";
        $logs="INSERT INTO `logs`( `user_id`, `name`, `action`) VALUES ('$lrn','$name','$action')";
        $run_logs = mysqli_query($conn,$logs);
        header("location: student_profile.php?error= Input Password Does not Match please try again!");
    }else{
        $hashedPassword = password_hash($new_pass, PASSWORD_DEFAULT);
        $run=mysqli_query($conn, "UPDATE userlogin SET password='$hashedPassword' WHERE LRN=$lrn") or die(mysqli_error());
        if($run){
            $action = "Password modified Successfully";
            $logs="INSERT INTO `logs`( `user_id`, `name`, `action`) VALUES ('$lrn','$name','$action')";
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
        
            if ( $mail->send() ) {
                echo "Email Sent..!";
                header("location:student_profile.php?added=$name");
            }else{
                echo "Message could not be sent. Mailer Error: ";
                header("location:student_profile.php?error= Message could not be sent. Mailer Error");
            }



            if($run_logs){
                header("location: student_profile.php?success= Change Password Successfully");
                exit();
            }else{
                header("location: student_profile.php?error=Won't work, please try again!");
                exit();
            }
            
        }else{
            header("location: student_profile.php?success=Won't work, please try again!");
            exit();
        }
        header("location: student_profile.php?success= Change Password Successfully");
    }
}

if(isset($_POST["register"])){

    $lrn = $_POST['LRN'];
    $querytolrn = "SELECT * FROM userlogin where LRN='$lrn'";
    $query_verify = mysqli_query($conn,$querytolrn);

    $queryLrn = "SELECT * FROM student_info where LRN='$lrn'";
    $query_run = mysqli_query($conn,$queryLrn);

    if(mysqli_num_rows($query_verify)){
        header("location:student_officer.php?error=$lrn is already registered");
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
            header("location:student_officer.php?added=$name");
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
            $mail->Body = "<h5><b>Hi, $name!</b></h5>
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
                header("location:student_officer.php?added=$name");
            }else{
                echo "Message could not be sent. Mailer Error: ";
                header("location:student_officer.php?error= Message could not be sent. Mailer Error");
            }
        }
        else{
            header("location:student_officer.php?error=There was an error");
        }

    }
} 
  

?>