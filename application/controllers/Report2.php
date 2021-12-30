<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report2 extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('Pdf');
    $this->load->model('M_admin');
  }

  public function barangKeluar()
  {
    $id = $this->uri->segment(3);
    $tgl1 = $this->uri->segment(4);
    $tgl2 = $this->uri->segment(5);
    $tgl3 = $this->uri->segment(6);
    $ls   = array('id_transaksi' => $id ,'tanggal_keluar' => $tgl1.'/'.$tgl2.'/'.$tgl3);
    $data = $this->M_admin->get_data('tb_site_id',$ls);
    $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

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
    //$pdf->SetFont('times', '', 15); 
    // *** Very IMP: Please use times font, so that if you send this pdf file in gmail as attachment and if user
    //opens it in google document, then all the text within the pdf would be visible properly.

    // add a page
    $pdf->AddPage();

    // create some HTML content    
    $now = date("F jS, Y");
    //$data = 'ABC Company';

    $user_name = 'Mr. Lorel Ispum';
    $invoice_ref_id = '2013/12/03/0001';
    $namaPerusahaan = 'PT. ASURANSI MAXIMUS GRAHA PERSADA, Tbk';

    $nosertifHeader =  '<font face="narrowi">
                            <table cellpadding="5">
                                <tr>
                                    <td align="center"><font size="13" font face="monotype">No.</font> <font size="11" font face="narrowi">{id}</font></td>
                                </tr>
                            </table></font>';
                            
    $nopolisHeader =  '<font face="lucida" font size="10">
                            <table cellpadding="5">
                                <tr>
                                    <td colspan="1" align="left">THIS TO CERTIFY that insurance has been effected as per Open Policy No. <i>0608032100001</i></td>
                                </tr>
                            </table></font>';

    // *** IMP: The value of $html and $html_terms can come from db
    // But, If these values contain, other language special characters, then
    // PDF is not getting generated. in that case should find such invalid charactes and 
    // make use of its html entity substitute 
    // for ex. If copyright is invalid character then use &copy; in html content

        // set font
    $pdf->SetFont('lucida', '', 9.5); 
    $html .= $nosertifHeader;
    $style = array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));

    $pdf->Line(185.5, 51, 21, 51, $style);
    // (panjang,bawah kiri,marginkiri,bawah kanan,)
    $html .= $nopolisHeader;

    $pdf->setListIndentWidth(4.75);
    $html .= '
            <table border="" cellpadding="2">
                <tr>    <br>
                    <td colspan="2"><b>The Insured</b></td>
                    <td colspan="1" align="right">:</td>
                    <td colspan="8"align="justify"><b>PT. Fiberhome Technologies Indonesia and/or 
                    BAKTI (Badan Aksesibilitas Telekomunikasi dan Informasi)</b> and/or subsidiary and/or affiliated companies including those required 
                    or incorporated during the period of insurance for their respective rights and interest.
                    </td>   
                </tr>
                <tr>
                    <td colspan="2">Address</td>
                    <td colspan="1" align="right">:</td>
                    <td colspan="8"align="justify">Lorem</td>
                </tr>
                <tr>
                    <td colspan="2">Interest Insured</td>
                    <td colspan="1" align="right">:</td>
                    <td colspan="8"align="justify">
                    
                    <ol>
                        <li><b>Point 1</b></li>
                        <li><i>Point 2</i></li>
                    </ol>
                    
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Mark/Numbers</td>
                    <td colspan="1" align="right">:</td>
                    <td colspan="8"align="justify">Lorem</td>
                </tr>
                <tr>
                    <td colspan="2">Amount Insured</td>
                    <td colspan="1" align="right">:</td>
                    <td colspan="8"align="justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</td>
                </tr>
                <tr>
                    <td colspan="2">L/C</td>
                    <td colspan="1" align="right">:</td>
                    <td colspan="8"align="justify">Lorem</td>
                </tr>
                <tr>
                    <td colspan="2">B/L</td>
                    <td colspan="1" align="right">:</td>
                    <td colspan="8"align="justify">Lorem</td>
                </tr>
                <tr>
                    <td colspan="2">Invoice Number</td>
                    <td colspan="1" align="right">:</td>
                    <td colspan="8"align="justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</td>
                </tr>
                <tr>
                    <td colspan="2">Scope of Cover</td>
                    <td colspan="1" align="right">:</td>
                    <td colspan="8"align="justify">Lorem</td>
                </tr>
                <tr>
                    <td colspan="2">Date of Sailing</td>
                    <td colspan="1" align="right">:</td>
                    <td colspan="8"align="justify">Lorem</td>
                </tr>
                <tr>
                    <td colspan="2">Conveyance</td>
                    <td colspan="1" align="right">:</td>
                    <td colspan="8"align="justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</td>
                </tr>
                <tr>
                    <td colspan="2">Destination</td>
                    <td colspan="1" align="right">:</td>
                    <td colspan="8"align="justify">Lorem</td>
                </tr>
                <tr>
                    <td colspan="2">Consignee</td>
                    <td colspan="1" align="right">:</td>
                    <td colspan="8"align="justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                     consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                     Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</td>
                </tr>
            </table>'
            ;

    $html .= '<table cellpadding="5">
                <tr><br><br>
                    <td align="right">Issued {now}</td>
                </tr>
                <tr>
                    <td align="right">Signed On Behalf</td>
                </tr>
                <tr><br><br><br><br><br>
                    <td align="right">{namaPerusahaan}</td>
                </tr>
            </table>';

    $html = str_replace('{id}',$id, $html);
    $html = str_replace('{namaPerusahaan}',$namaPerusahaan, $html);
    $html = str_replace('{now}',$now, $html);
    $html = str_replace('{user_name}',$user_name, $html);
    $html = str_replace('{invoice_ref_id}',$invoice_ref_id, $html);

    // output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');

    // reset pointer to the last page
    $pdf->lastPage();

    // ---------------------------------------------------------

    //Close and output PDF document
    $pdf_file_name = 'Certificate of Insurance.pdf';
    $pdf->IncludeJS("print();");
    ob_end_clean();
    $pdf->Output($pdf_file_name, 'I');

  }
}
?>
