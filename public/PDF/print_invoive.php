<?php
    session_start();
    
    $day = NULL;
    $invoice = NULL;
    $name = NULL;
    $email = NULL;
    $doctor_id = NULL;
    $doctor_name = NULL;
    $specialty = NULL;
    
    
    
    $conn = mysqli_connect("localhost","root","","hospital");
    $user_id = $_SESSION['user_id'];
    
    $query_01 = "SELECT * FROM reservations WHERE patient_id = $user_id";
    $result = mysqli_query($conn,$query_01);
    
    while ($row = mysqli_fetch_assoc($result))
    {
        
        $day = $row['day'];
        $invoice = $row['invoice'];
        $doctor_id = $row['doctor_id'];
        
    }
    
    
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($conn,$query);
    
    while ($row = mysqli_fetch_assoc($result))
    {
        $name = $row['username'];
        $email = $row['email'];
        
    }
    
    
    
    
    $query = "SELECT * FROM doctors WHERE id = $doctor_id";
    $result = mysqli_query($conn,$query);
    
    while ($row = mysqli_fetch_assoc($result))
    {
        $doctor_name = $row['name'];
        $specialty = $row['specialty'];
        
    }
    



// Include the main TCPDF library (search for installation path).
    require_once('tcpdf/tcpdf.php');

// create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION,PDF_UNIT,PDF_PAGE_FORMAT,TRUE,'UTF-8',FALSE);

// set document information
//    $pdf->SetCreator(PDF_CREATOR);
//    $pdf->SetAuthor('Nicola Asuni');
//    $pdf->SetTitle('TCPDF Example 001');
//    $pdf->SetSubject('TCPDF Tutorial');
//    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
    //$pdf->SetHeaderData(PDF_HEADER_LOGO,PDF_HEADER_LOGO_WIDTH,PDF_HEADER_TITLE . ' 001',PDF_HEADER_STRING,array(0,64,255),array(0,64,128));
    //$pdf->setFooterData(array(0,64,0),array(0,64,128));

// set header and footer fonts
    // $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
    //$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA,'',PDF_FONT_SIZE_DATA));

// set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT,PDF_MARGIN_TOP,PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
    $pdf->SetAutoPageBreak(TRUE,PDF_MARGIN_BOTTOM);

// set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__) . '/lang/eng.php'))
    {
        require_once(dirname(__FILE__) . '/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

// ---------------------------------------------------------

// set default font subsetting mode
    $pdf->setFontSubsetting(TRUE);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
    $pdf->SetFont('dejavusans','',14,'',TRUE);

// Add a page
// This method has several options, check the source code documentation for more information.
    $pdf->AddPage();

// set text shadow effect
    $pdf->setTextShadow(array('enabled' => TRUE,'depth_w' => 0.2,'depth_h' => 0.2,'color' => array(196,196,196),'opacity' => 1,'blend_mode' => 'Normal'));

// Set some content to print
    
    $hey = 'Test 1 2 3';
    
    $html = <<<EOD
          <pre>
          Patient Name      : {$name}<br>
          Email             : {$email}<br>
          Doctor Name       : {$doctor_name}<br>
          Doctor specialty  : {$specialty}<br>
          Reservaion Day    : {$day}<br>
          Total Invoice     : {$invoice} EGP
         </pre>
EOD;




// Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0,0,'','',$html,0,1,0,TRUE,'',TRUE);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
    $pdf->Output('reservation.pdf','I');
    
    //============================================================+
    // END OF FILE
    //============================================================+﻿



