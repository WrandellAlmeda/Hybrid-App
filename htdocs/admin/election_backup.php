<?php
require_once('TCPDF-main/tcpdf.php');
include "connection.php";
$name_gen=$_GET['marie'];


$conn=mysqli_connect($host,$user,$password,$db);
date_default_timezone_set('Asia/Manila');
$date = date("F j, Y, g:i a"); ;
$current_date = date('F j, Y, g:i a', strtotime($date));
$current_date_pdf = date('F j Y g ia', strtotime($date));

class PDF extends TCPDF{
    public function Header(){
        $imageFile = K_PATH_IMAGES.'sanfelipe_logo.jpg';
        $this->Image($imageFile, 40, 10, 20, '', 'JPG', '','T', false, 300, '',false, false, 0, false, false, false);
        $this->Ln(5);
        $this->SetFont('helvetica','B',12);
        $this->Cell(189,5,"SAN FELIPE NATIONAL HIGH SCHOOL", 0,1,'C');
        $this->SetFont('helvetica','B', 8);
        $this->Cell(189,5,"San Felipe Central, Binalonan Pangasinan", 0,1,'C');
    }

    // public function Footer(){
    //     $this->SetY(-148);
    //     $this->Ln(5);
    //     $this->SetFont('times','B',10);
    //     $this->Cell(99,1,'',0,0);
    //     $this->Cell(51,1,'Prepared By:',0,0);
    //     $this->Ln(10);
    //     $this->Cell(112,1,'',0,0);
    //     $this->Cell(51,1,'_________________________________',0,1);
    //     $this->Cell(130,5,'',0,0);
    //     $this->SetFont('times','',8);
    //     $this->Cell(70,5,'SFNHS ADMIN');

    // }
}

// create new PDF document
$pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

$pdf->setFontSubsetting(true);
$pdf->SetFont('helvetica', '', 14, '', true);
$pdf->AddPage();

// $pdf->SetFillColor(224,235,255);
// $pdf->Cell(45,8,'LRN',1,0,'C',1);
// $pdf->Cell(65,8,'Name of Candidate',1,0,'C',1);
// $pdf->Cell(40,8,'Position',1,0,'C',1);
// $pdf->Cell(30,8,'Total Votes',1,0,'C',1);
// $pdf->SetFont('times', 10);


$query_position = mysqli_query($conn, "SELECT * FROM position");

foreach($query_position as $val){
    $pdf->Ln(18);
    $pdf->SetFont('times', 'B', 10);
    $pdf->Cell(189,5,"ELECTION VOTE REPORT", 0,1,'C');
    $pdf->Cell(189,5,"As of $current_date", 0,1,'C');
    $pdf->Ln(10);
    $pos = $val['position'];
    $pdf->SetFont('times', 'B', 10);
    $pdf->Cell(189,5,$pos, 0,1,'C');
    $pdf->Ln(7);
    $pdf->SetFont('times', 10);
    $pdf->SetFillColor(224,235,255);
    $pdf->Cell(9,8,'#',1,0,'C',1);
    $pdf->Cell(45,8,'LRN',1,0,'C',1);
    $pdf->Cell(100,8,'Name of Candidate',1,0,'C',1);
    $pdf->Cell(30,8,'Total Votes',1,0,'C',1);
    $pdf->Ln(8);
 $sql = mysqli_query($conn, "SELECT * FROM candidates WHERE Position = '$pos' AND confirm = 2 ORDER BY total_votes DESC");
 $c = 1;
 foreach($sql as $row){
    $lrn = $row['LRN'];
    $name = $row['Name'];
   
    // $count_vote = mysqli_query($conn, "SELECT candidate_lrn, COUNT(candidate_lrn) FROM votes WHERE candidate_lrn = '$lrn' ORDER BY COUNT(candidate_lrn) DESC");
    $count_vote = mysqli_query($conn,"SELECT COUNT(*) FROM votes WHERE candidate_lrn = '$lrn'");
   
    while($total = mysqli_fetch_assoc($count_vote)){
       
        $vote_count = $total['COUNT(*)'];
        $pdf->SetFont('times', 8);
        $pdf->SetFillColor(224,235,255);
        $pdf->Cell(9,8,$c,1,0,'C');
        $pdf->Cell(45,8,$lrn,1,0,'C');
        $pdf->Cell(100,8,$name,1,0,'C');
        $pdf->Cell(30,8,$vote_count,1,0,'C');
        $pdf->Ln(8);
       
    }
    $c++;
 }
      $pdf->SetY(-148);
        $pdf->Ln(5);
        $pdf->SetFont('times','B',10);
        $pdf->Cell(99,1,'',0,0);
        $pdf->Cell(51,1,'Prepared By:',0,0);
        $pdf->Ln(10);
        $pdf->Cell(127,1,'',0,0);
        $pdf->Cell(51,1,$name_gen,0,1);
        $pdf->Cell(130,5,'',0,0);
        $pdf->SetFont('times','',8);
        $pdf->Cell(70,5,'SFNHS ADMIN');

 $pdf->AddPage();
}

$time = "Election Report ".$current_date_pdf;
$sFilePath = __DIR__ . '/backup_files/'.$time.'.pdf';
$sFilePath_pdf= 'backup_files/'.$time.'.pdf' ;

$sql_insert_pdf=mysqli_query($conn, "INSERT INTO `dump`(`pdf_file`, `date`, `type`) VALUES ('$sFilePath_pdf','$current_date','Election Report')");

$pdf->Output($sFilePath,'F');
header('location: resetElection.php?backup=Success');
