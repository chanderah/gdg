<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('Pdf');
    $this->load->model('M_admin');
  }

  public function dataKeluar()
  {
    $id = $this->uri->segment(3);
    $tgl1 = $this->uri->segment(4);
    $tgl2 = $this->uri->segment(5);
    $tgl3 = $this->uri->segment(6);
    $ls = array('dummy_id' => $id);
    //$ls   = array('site_id' => $id ,'provinsi' => $tgl1.'/'.$tgl2.'/'.$tgl3);
    $data = $this->M_admin->get_data('tb_site_items',$ls);
    $data2 = $this->M_admin->get_data('tb_site_items',$ls);

    //create
    $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
    //
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Chandra SA');
    $pdf->SetTitle('Invoice');
    $pdf->SetSubject('Invoice');
    $pdf->SetKeywords('PDF, Invoice');

    // 
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    //
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    //
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    //
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    //
    // $pdf->setLanguageArray($l);

    // ---------------------------------------------------------

    // set font
    //$pdf->SetFont('times', '', 15); 

    // add a page
    $pdf->AddPage();

    // create some HTML content    
    $now = date("F jS, Y");
    //$data = 'ABC Company';

    $user_name = 'Mr. Lorel Ispum';
    $invoice_ref_id = '2013/12/03/0001';
    $namaPerusahaan = 'PT. ASURANSI MAXIMUS GRAHA PERSADA, Tbk';

    $nosertifHeader = '<font face="narrowi">
                            <table cellpadding="5">
                                <tr>
                                    <td align="center"><font size="13" font face="monotype">No. </font><font size="11" font face="narrowi">JIS22-{MOP}-{id}</font></td>
                                </tr>
                            </table>
                        </font>';
                        
    $nopolisHeader =   '<font face="lucida" font size="10">
                            <table cellpadding="5">
                                <tr>
                                    <td colspan="1" align="left">THIS TO CERTIFY that insurance has been effected as per Open Policy No. <i>0608032100001</i></td>
                                </tr>
                            </table>
                        </font>';

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
    // (length,start,marginstart,end,)
    $html .= $nopolisHeader;
    $site_id .= $d->provinsi;

    $pdf->setListIndentWidth(4.75);
    
    
    $html=
      '<div>
        <h1 align="center">Certificate of Insurance</h1><br>
        <p>No SITE ID  : '.$ls.'</p>
        <p>Ditunjukan Untuk :</p>
        <p>Tanggal          : '.$tgl1.'/'.$tgl2.'/'.$tgl3.'</p>
        <p>Po.Customer      :</p>


        <table border="1">
          <tr>
            <th style="width:40px" align="center">No</th>
            <th style="width:110px" align="center">SITE ID</th>
            <th style="width:110px" align="center">Region</th>
            <th style="width:110px" align="center">Provinsi</th>
            <th style="width:130px" align="center">Kota</th>
            <th style="width:140px" align="center">Kecamatan</th>
            <th style="width:140px" align="center">Desa</th>
            <th style="width:80px" align="center">Paket</th>
            <th style="width:80px" align="center">Batch</th>
          </tr>';


          $no = 1;
          foreach($data as $d){
            $html .= '<tr>';
            $html .= '<td align="center">'.$no.'</td>';
            $html .= '<td align="center">{site_id}</td>';
            $html .= '<td align="center">'.$d->title.'</td>';
            $html .= '<td align="center">'.$d->description.'</td>';
            $html .= '</tr>';
            $no++;
            $pdf->Ln();
          }

        $html .='
                    </table><br>
                    <h6>Mengetahui</h6><br><br><br>
                    <h6>Admin</h6> 
                    </div>';

    $html = str_replace('{id}',$id, $html);
    $html = str_replace('{site_id}',$site_id, $html);
    $html = str_replace('{MOP}',$MOP, $html);
    $html = str_replace('{namaPerusahaan}',$namaPerusahaan, $html);
    $html = str_replace('{now}',$now, $html);
    $html = str_replace('{user_name}',$user_name, $html);
    $html = str_replace('{invoice_ref_id}',$invoice_ref_id, $html);
    
    //
   // $html = str_replace('{the_insured}',$the_insured, $html);
  //  $html = str_replace('{address}',$address_, $html);
   // $html = str_replace('{interest_insured}',$interest_insured, $html);
 //   $html = str_replace('{mark_numbers}',$mark_numbers, $html);
  //  $html = str_replace('{amount_insured}',$amount_insured, $html);
  //  $html = str_replace('{lampiran_LC}',$lampiran_LC, $html);
   // $html = str_replace('{lampiran_BL}',$lampiran_BL, $html);
  //  $html = str_replace('{invoice_number}',$invoice_number, $html);
 //   $html = str_replace('{sailing_date}',$sailing_date, $html);
 //   $html = str_replace('{invoice_number}',$invoice_number, $html);
 //   $html = str_replace('{conveyance}',$conveyance, $html);
  //  $html = str_replace('{destination_to}',$destination_to, $html);

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
