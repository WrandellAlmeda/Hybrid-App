<?php
require_once('TCPDF-main/tcpdf.php');
include "connection.php";


$conn=mysqli_connect($host,$user,$password,$db);
date_default_timezone_set('Asia/Manila');
$date = date("F j, Y, g:i a"); ;
$current_date = date('F j, Y, g:i a', strtotime($date));

$query_count = "SELECT count(*) FROM judge";
    $result_count = mysqli_query($conn, $query_count);

    while ($rowUser = mysqli_fetch_array($result_count)){
        $total_judge = $rowUser['count(*)'];
    } 

class PDF extends TCPDF{
    public function Header(){
        $imageFile = K_PATH_IMAGES.'sanfelipe_logo.jpg';
        $this->Image($imageFile, 40, 10, 20, '', 'JPG', '','T', false, 300, '',false, false, 0, false, false, false);
        $this->Ln(5);
        $this->SetFont('helvetica','B',12);
        $this->Cell(295,5,"SAN FELIPE NATIONAL HIGH SCHOOL", 0,1,'C');
        $this->SetFont('helvetica','B', 8);
        $this->Cell(295,5,"San Felipe Central, Binalonan Pangasinan", 0,1,'C');
    }

    public function Footer(){
        $this->SetY(-48);
        $this->Ln(5);
        $this->SetFont('times','B',10);
        $this->Cell(200,1,'',0,0);
        $this->Cell(51,1,'Prepared By:',0,0);
        $this->Ln(10);
        $this->Cell(200,1,'',0,0);
        $this->Cell(70,1,'_________________________________',0,1);
        $this->Cell(218,5,'',0,0);
        $this->SetFont('times','',8);
        $this->Cell(70,5,'SFNHS ADMIN');

    }
}

// create new PDF document
$pdf = new PDF('L', 'mm', 'A4', true, 'UTF-8', false);

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

$query_candidates = mysqli_query($conn, "SELECT * FROM pageant_candidates WHERE confirm = 2");
$c = 1;
while($can= mysqli_fetch_assoc($query_candidates)){
    $name_candidate = $can['Name'];
    $lrn = $can['LRN'];
    $pdf->Ln(18);
    $pdf->SetFont('times', 'B', 10);
    $pdf->Cell(295,5,"CANDIDATE #$c $name_candidate", 0,1,'C');
    $pdf->Cell(295,10,"As of $current_date", 0,1,'C');
    $pdf->Ln(10);
    $pdf->SetFont('times', 'B', 10);
    $pdf->Ln(7);
    $pdf->SetFont('times', 10);
    $pdf->SetFillColor(224,235,255);
    $pdf->Cell(45,8,'Judge',1,0,'C',1);
    $sql_criteria = mysqli_query($conn, "SELECT * FROM criteria");
    foreach($sql_criteria as $cri){
    $pdf->Cell(30,8,$cri['criteria_description'],1,0,'C',1);  
    }
    $pdf->Cell(30,8,'Total',1,0,'C',1);  
    $pdf->Ln(8);
    $sql_judge = mysqli_query($conn, "SELECT * FROM judge");
    $grand_total = 0;
    foreach($sql_judge as $judge){
        $judge_id = $judge['id']; 
        $first_name = $judge['first_name'];
        $last_name = $judge['last_name'];
        $total = 0;
        $pdf->Cell(45,8,$first_name,1,0,'C');
        foreach($sql_criteria as $criteria){
            $id_criteria = $criteria['id'];
            $query_score = mysqli_query($conn, "SELECT * FROM judge_votes WHERE candidate_lrn = $lrn AND criteria_id = $id_criteria AND judge_id = $judge_id");
            foreach($query_score as $sc){
                $score_fin =  $sc['score'];
                $total +=  $sc['score'];
                $pdf->Cell(30,8,$score_fin,1,0,'C');
            }
            
        }
        $pdf->Cell(30,8,$total,1,0,'C');
        $pdf->Ln(8);
        $grand_total += $total;
     }
     $total_percentage = $grand_total / $total_judge;
     $pdf->Ln(10);
     $pdf->SetFont('times', 'B', 14);
     $pdf->Cell(45,8,"Total Score: $total_percentage%",0,1,'C');
     $c++;

    $pdf->AddPage();
}

$pdf->Output('Pageant_breakdown_report.pdf', 'D');