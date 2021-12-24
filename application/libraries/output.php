<?php
// File name   : example_custom_header_footer.php
// Begin       : 2013-12-03
// Last Update : 2013-12-03
//
// Description : Example to overwite header, footer of TCPDF class

ini_set("display_errors", 1);

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// Extend the TCPDF class to create custom Header and Footer
    class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = 'images/tcpdf_logo.jpg'; // *** Very IMP: make sure this image is available on given path on your server
        $this->Image($image_file,15,6,30);
        // Set font
        $this->SetFont('helvetica', 'C', 12);
    
        // Line break
        $this->Ln();        
        $this->Cell(294, 15, 'ABC test company', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(5);        
        $this->Cell(300, 0, 'Company tag line here', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        // We need to adjust the x and y positions of this text ... first two parameters
        
    }

    // Page footer
    public function Footer() {
        // Position at 25 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        
        $this->Cell(0, 0, 'Product Company - ABC test company, Phone : +91 1122 3344 55, TIC : TESTTEST', 0, 0, 'C');
        $this->Ln();
        $this->Cell(0,0,'www.clientsite.com - T : +91 1 123 45 64 - E : info@clientsite.com', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
    
}

///////////////// End of class ////////////////////////////

//////////////////////////////////
//
//
// Create new PDF document
//
//
//////////////////////////////////
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Chandra SA');
$pdf->SetTitle('Invoice');
$pdf->SetSubject('Invoice');
$pdf->SetKeywords('PDF, Invoice');


// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
// $pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 15); 
// *** Very IMP: Please use times font, so that if you send this pdf file in gmail as attachment and if user
//opens it in google document, then all the text within the pdf would be visible properly.

// add a page
$pdf->AddPage();

// create some HTML content
$now = date("j F, Y");
$company_name = 'ABC test company';

$user_name = 'Mr. Lorel Ispum';
$invoice_ref_id = '2013/12/03/0001';

// *** IMP: The value of $html and $html_terms can come from db
// But, If these values contain, other language special characters, then
// PDF is not getting generated. in that case should find such invalid charactes and 
// make use of its htmlentity substitute 
// for ex. If copyright is invalid character then use &copy; in html content


// $html on page 1 of PDF and $html_terms are on page 2 of PDF


$html = '';
$html .= '<table cellpadding="5">
            <tr>
                <td colspan="2" align="center"><u><h1>Invoice</b></h1></td>
            </tr>
            <tr>
                <td colspan="2" align="right"><u>{now}</u></td>
            </tr>
            <tr>
                <td>Dear {user_name},<br>here is your invoice.</td>
            </tr>
         </table>';

$html .= '<br><br>
          <table border="1" cellpadding="5">
            <tr>
                <td colspan="3">Invoice # {invoice_ref_id}</td>            
            </tr>
            <tr>
                <td><b>Product</b></td>
                <td><b>Quantity</b></td>
                <td align="right"><b>Amount (Rs.)</b></td>
            </tr>
            <tr>
                <td>Product 1</td>
                <td>30</td>
                <td align="right">300</td>
            </tr>
            <tr>
                <td>Product 2</td>
                <td>15</td>
                <td align="right">75</td>
            </tr>
            <tr>
                <td colspan="3" align="right"><b>Total: 375</b></td>
            </tr>
         </table>';

$html .= '<br><br>Some more text can come here...';

$html = str_replace('{now}',$now, $html);
$html = str_replace('{company_name}',$company_name, $html);
$html = str_replace('{user_name}',$user_name, $html);
$html = str_replace('{invoice_ref_id}',$invoice_ref_id, $html);


// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// add a page
$pdf->AddPage();

$html_terms = '
        <table>
            <tr>
                <td colspan="2"><u><b>Terms & Conditions</b></u></td>
            </tr>
            
            <tr>
                <td colspan="2" align="right">
                <ul>
                    <li>Point one</li>
                    <li>Point two</li>
                    <li>Point three</li>
                    <li>Point four</li>
                    <li>Point five</li>
                    <li>Point six</li>
                    <li>Point seven</li>
                    <li>Point eight</li>
                    <li>Point nine</li>
                    <li>Point ten</li>
                </ul>
                </td>
            </tr>

        </table>
        ';
// output the HTML content
$pdf->writeHTML($html_terms, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf_file_name = 'custom_header_footer.pdf';
$pdf->Output($pdf_file_name, 'I');

//============================================================+
// END OF FILE                                                
//============================================================+
?>