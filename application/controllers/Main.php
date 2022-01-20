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
        
        $name =$this->input->post("txtName");
        $total =$this->input->post("txtGrandTotal");
        $site_id =$this->input->post("site_id");
        
        $id = $max_id=$this->m_admin->get_max_id('id','tb_site_in');

        $list = array();
        $title =$this->input->post("txtTitle");
        for($i=0; $i<count($title); $i++) {
            $data = [
                //tb_site_desc
                'site_id2' => $site_id,
                'bill_id' => $id,
                'title' => $this->input->post("txtTitle")[$i],
				'description' => $this->input->post("txtDescription")[$i]
            ];
            array_push($list,$data);
        }
        $data = [
            //tb_site_in
            'site_id' => $site_id,
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