<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('error_reporting', 0);
class Main extends CI_Controller {

    public function __construct() {		
		parent::__construct();
		$this->load->model("m_admin");
    }

    public function index() {
		$this->add();
    }
    public function add() {
		$this->load->view('admin/add_bill');
    }
    
    public function add_to_cart() {
        
        $name =$this->input->post("site_id");
        $total =$this->input->post("txtGrandTotal");
        $site_id =$this->input->post("site_id");
        $sha1 = random_string('alpha', 10);
        $sha2 = random_string('sha1');

        $dummy_id = $sha1.$sha2;
        $the_insured =$this->input->post("the_insured");
        $address_ =$this->input->post("address_");
        $conveyance =$this->input->post("conveyance");
        $destination_from =$this->input->post("destination_from");
        $destination_to =$this->input->post("destination_to");
        $sailing_date =$this->input->post("sailing_date");
        $amount_insured =$this->input->post("amount_insured");
        $lampiran_BL =$this->input->post("lampiran_BL");
        $lampiran_LC =$this->input->post("lampiran_LC");
        $lampiran_invoice =$this->input->post("lampiran_invoice");
        $lampiran_packinglist =$this->input->post("lampiran_packinglist");
        $lampiran_DO =$this->input->post("lampiran_DO");
        
        $id = $max_id=$this->m_admin->get_max_id('id','tb_site_in');

        $list = array();
        $title =$this->input->post("txtTitle");
        for($i=0; $i<count($title); $i++) {
            $data = [
                //tb_site_desc
                //'site_id2' => $site_id,
                'dummy_id' => $dummy_id,
                'bill_id' => $id,
                'title' => $this->input->post("txtTitle")[$i],
				'description' => $this->input->post("txtDescription")[$i]
            ];
            array_push($list,$data);
        }
        $data = [
            //tb_site_in
            'dummy_id' => $dummy_id,
            'the_insured' => $the_insured,
            'address_' => $address_,
            'conveyance' => $conveyance,
            'destination_from' => $destination_from,
            'destination_to' => $destination_to,
            'sailing_date' => $sailing_date,
            'amount_insured' => $amount_insured,
            'lampiran_BL' => $lampiran_BL,
            'lampiran_LC' => $lampiran_LC,
            'lampiran_invoice' => $lampiran_invoice,
            'lampiran_packinglist' => $lampiran_packinglist,
            'lampiran_DO' => $lampiran_DO,
            
            //'site_id' => $site_id,
            'id' => $id,
            'name' => $name,
            'status' => "1",
        ];

        if( $this->m_admin->insert_into_table("tb_site_in", $data) and 
            $this->m_admin->insert_batch_into_table("tb_site_desc", $list)) {
                
                echo '<div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> Bill is created successfully.
                    </div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> Something went wrong.
                </div>';
        }
    }
}
?>