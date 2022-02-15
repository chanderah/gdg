if ($d->linked_with == true )
            {
                $explodeLink = explode(', ', $d->linked_with);
                $totalLink = count($explodeLink);

                if ($totalLink < 10){
                    $html .= '<table border="" cellpadding="1">
                                <tr>
                             ';
                                             
                //view             
                <?php foreach($data_barang_info as $d){ ?>

                            $where = array('dummy_id' => $dd);
                            $data['data_barang_info'] = $this->M_admin->get_data('tb_site_in',$where);

                                $no = 1;
                                foreach($explodeLink as $dd){
                                    $html .= '  <tr>
                                                    <td colspan="2"></td>
                                                    <td colspan="1"></td>
                                                    <td colspan="8"> '.$no.'. SITE ID : '.$d2.'</td>
                                                </tr>
                                            ';
                                    $no++;
                                    $pdf->Ln();     
                                }
                }
                else {
                    $html .= '<table border="" cellpadding="1">
                                <tr>
                                <td colspan="2"></td>
                                <td colspan="1"></td>
                                <td colspan="8"> SITE ID : As Attached</td>
                                </tr>
                             ';
                }
            }
            $html .= '</table>';