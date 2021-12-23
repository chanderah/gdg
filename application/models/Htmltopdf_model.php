<?php
class Htmltopdf_model extends CI_Model
{
 function fetch()
 {
  $this->db->order_by('id_transaksi', 'lokasi');
  return $this->db->get('tb_site_id');
 }
 function fetch_single_details($site_id)
 {
  $this->db->where('id_transaksi', $site_id);
  $data = $this->db->get('tb_site_id');
  $output = '<table width="100%" cellspacing="5" cellpadding="5">';
  foreach($data->result() as $row)
  {
   $output .= '
   <tr>
    <td width="25%"><img src="'.base_url().'images/'.$row->satuan.'" /></td>
    <td width="75%">
     <p><b>Name : </b>'.$row->kode_barang.'</p>
     <p><b>Address : </b>'.$row->lokasi.'</p>
     <p><b>City : </b>'.$row->nama_barang.'</p>
     <p><b>Postal Code : </b>'.$row->lokasi.'</p>
     <p><b>Country : </b> '.$row->lokasi.' </p>
    </td>
   </tr>
   ';
  }
  $output .= '
  <tr>
   <td colspan="2" align="center"><a href="'.base_url().'htmltopdf" class="btn btn-primary">Back</a></td>
  </tr>
  ';
  $output .= '</table>';
  return $output;
 }
}

?>
