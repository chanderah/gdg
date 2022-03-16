<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

  public function __construct(){
		parent::__construct();
    $this->load->model('M_admin');
    $this->load->library('upload');
	}

  public function index(){
    if($this->session->userdata('status') == 'login' && $this->session->userdata('role') == 1){
      $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
      $data['jumlahPermintaan'] = $this->M_admin->numrows('tb_site_in');
      $data['jumlahSite'] = $this->M_admin->numrows('tb_site_out');      
      $data['dataUser'] = $this->M_admin->numrows('user');
      $this->load->view('admin/index',$data);
    }else {
      $this->load->view('login/login');
    }
  }

  public function sigout(){
    session_destroy();
    redirect('login');
  }

  ####################################
              // Profile
  ####################################

  public function profile()
  {
    $data['token_generate'] = $this->token_generate();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->session->set_userdata($data);
    $this->load->view('admin/profile',$data);
  }

  public function token_generate()
  {
    return $tokens = md5(uniqid(rand(), true));
  }

  private function hash_password($password)
  {
    return password_hash($password,PASSWORD_DEFAULT);
  }

  public function proses_new_password()
  {
    $this->form_validation->set_rules('email','Email','required');
    $this->form_validation->set_rules('new_password','New Password','required');
    $this->form_validation->set_rules('confirm_new_password','Confirm New Password','required|matches[new_password]');

    if($this->form_validation->run() == TRUE)
    {
      if($this->session->userdata('token_generate') === $this->input->post('token'))
      {
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $new_password = $this->input->post('new_password');

        $data = array(
            'email'    => $email,
            'password' => $this->hash_password($new_password)
        );

        $where = array(
            'id' =>$this->session->userdata('id')
        );

        $this->M_admin->update_password('user',$where,$data);

        $this->session->set_flashdata('msg_berhasil','Password Telah Diganti');
        redirect(base_url('admin/profile'));
      }
    }else {
      $this->load->view('admin/profile');
    }
  }

  public function proses_gambar_upload()
  {
    $config =  array(
                   'upload_path'     => "./assets/upload/user/img/",
                   'allowed_types'   => "gif|jpg|png|jpeg",
                   'encrypt_name'    => False, //
                   'max_size'        => "50000",  // ukuran file gambar
                   'max_height'      => "9680",
                   'max_width'       => "9024"
                 );
      $this->load->library('upload',$config);
      $this->upload->initialize($config);

      if( ! $this->upload->do_upload('userpicture'))
      {
        $this->session->set_flashdata('msg_error_gambar', $this->upload->display_errors());
        $this->load->view('admin/profile',$data);
      }else{
        $upload_data = $this->upload->data();
        $nama_file = $upload_data['file_name'];
        $ukuran_file = $upload_data['file_size'];

        //resize img + thumb Img -- Optional
        $config['image_library']     = 'gd2';
				$config['source_image']      = $upload_data['full_path'];
				$config['create_thumb']      = FALSE;
				$config['maintain_ratio']    = TRUE;
				$config['width']             = 150;
				$config['height']            = 150;

        $this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);
				if (!$this->image_lib->resize())
        {
          $data['pesan_error'] = $this->image_lib->display_errors();
          $this->load->view('admin/profile',$data);
        }

        $where = array(
                'username_user' => $this->session->userdata('name')
        );

        $data = array(
                'nama_file' => $nama_file,
                'ukuran_file' => $ukuran_file
        );

        $this->M_admin->update('tb_upload_gambar_user',$data,$where);
        $this->session->set_flashdata('msg_berhasil_gambar','Gambar Berhasil Di Upload');
        redirect(base_url('admin/profile'));
      }
  }

  ####################################
           // End Profile
  ####################################



  ####################################
              // Users
  ####################################
  public function users()
  {
    $data['list_users'] = $this->M_admin->kecuali('user',$this->session->userdata('name'));
    $data['token_generate'] = $this->token_generate();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->session->set_userdata($data);
    $this->load->view('admin/users',$data);
  }

  public function form_user()
  {
    $data['list_satuan'] = $this->M_admin->select('tb_satuan');
    $data['token_generate'] = $this->token_generate();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->session->set_userdata($data);
    $this->load->view('admin/form_users/form_insert',$data);
  }

  public function update_user()
  {
    $id = $this->uri->segment(3);
    $where = array('id' => $id);
    $data['token_generate'] = $this->token_generate();
    $data['list_data'] = $this->M_admin->get_data('user',$where);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->session->set_userdata($data);
    $this->load->view('admin/form_users/form_update',$data);
  }

  public function proses_delete_user()
  {
    $id = $this->uri->segment(3);
    $where = array('id' => $id);
    $this->M_admin->delete('user',$where);
    $this->session->set_flashdata('msg_berhasil','User Behasil Di Delete');
    redirect(base_url('admin/users'));

  }

  public function proses_tambah_user()
  {
    $this->form_validation->set_rules('username','Username','required');
    $this->form_validation->set_rules('email','Email','required|valid_email');
    $this->form_validation->set_rules('password','Password','required');
    $this->form_validation->set_rules('confirm_password','Confirm password','required|matches[password]');

    if($this->form_validation->run() == TRUE)
    {
      if($this->session->userdata('token_generate') === $this->input->post('token'))
      {

        $username     = $this->input->post('username',TRUE);
        $email        = $this->input->post('email',TRUE);
        $password     = $this->input->post('password',TRUE);
        $role         = $this->input->post('role',TRUE);

        $data = array(
              'username'     => $username,
              'email'        => $email,
              'password'     => $this->hash_password($password),
              'role'         => $role,
        );
        $this->M_admin->insert('user',$data);

        $this->session->set_flashdata('msg_berhasil','User Berhasil Ditambahkan');
        redirect(base_url('admin/form_user'));
        }
      }else {
        $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
        $this->load->view('admin/form_users/form_insert',$data);
    }
  }

  public function proses_update_user()
  {
    $this->form_validation->set_rules('username','Username','required');
    $this->form_validation->set_rules('email','Email','required|valid_email');

    if($this->form_validation->run() == TRUE)
    {
      if($this->session->userdata('token_generate') === $this->input->post('token'))
      {
        $id           = $this->input->post('id',TRUE);        
        $username     = $this->input->post('username',TRUE);
        $email        = $this->input->post('email',TRUE);
        $role         = $this->input->post('role',TRUE);

        $where = array('id' => $id);
        $data = array(
              'username'     => $username,
              'email'        => $email,
              'role'         => $role,
        );
        $this->M_admin->update('user',$data,$where);
        $this->session->set_flashdata('msg_berhasil','Data User Berhasil Diupdate');
        redirect(base_url('admin/users'));
       }
    }else{
        $this->load->view('admin/form_users/form_update');
    }
  }

  ####################################
           // End Users
  ####################################

  ####################################
        // DATA Data Masuk
  ####################################

  public function form_barangmasuk()
  {
    $data['list_satuan'] = $this->M_admin->select('tb_satuan');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/form_barangmasuk/form_insert',$data);
  }

  public function move_data()
  {
    $uri = $this->uri->segment(3);
    $where = array('dummy_id' => $uri);
    $data['list_data'] = $this->M_admin->get_data('tb_site_in',$where);
    $data['list_data_desc'] = $this->M_admin->get_data('tb_site_out_items',$where);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/form_barangmasuk/form_move',$data);
  }

  public function tabel_barangmasuk()
  {
    $data = array(
              'list_data' => $this->M_admin->select('tb_site_in'),
              'avatar'    => $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'))
            );
    $this->load->view('admin/tabel/tabel_barangmasuk',$data);
  }

  public function tabel_permintaanmasuk()
  {
    $data = array(
              'list_data' => $this->M_admin->select('tb_request_in'),
              'avatar'    => $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'))
            );
    $this->load->view('admin/tabel/tabel_permintaanmasuk',$data);
  }

  public function update_datamasuk($dummy_id)
  {
    $where = array('dummy_id' => $dummy_id);
    $where2 = array('dummy_id' => $dummy_id);
    $data['data_barang_desc'] = $this->M_admin->get_data('tb_site_out_items',$where);
    $data['data_barang_update'] = $this->M_admin->get_data('tb_site_in',$where);
    $data['data_linked_with'] = $this->M_admin->getAllDataLinkedWith('tb_site_in');
    $data['list_satuan'] = $this->M_admin->select('tb_satuan');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/form_barangmasuk/form_update',$data);
  }

  public function info_datamasuk($dummy_id)
  {
    $where = array('dummy_id' => $dummy_id);
    $data['data_barang_info'] = $this->M_admin->get_data('tb_request_in',$where);
    $data['data_barang_desc'] = $this->M_admin->get_data('tb_site_out_items',$where);
    $data['list_satuan'] = $this->M_admin->select('tb_satuan');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/form_barangmasuk/form_info',$data);
  }

  public function delete_data($dummy_id)
  {
    $where = array('dummy_id' => $dummy_id);
    $this->M_admin->delete('tb_site_in',$where);
    $this->M_admin->delete('tb_site_out_items',$where);
    redirect(base_url('admin/tabel_barangmasuk'));
  }

  public function delete_datakeluar($dummy_id)
  {
    $where = array('dummy_id' => $dummy_id);
    $this->M_admin->delete('tb_site_out',$where);
    $this->M_admin->delete('tb_site_out_items',$where);

    $this->session->set_flashdata('msg_berhasil','Data Berhasil Dihapus');
    redirect(base_url('admin/tabel_barangkeluar'));
  }

  public function proses_datamasuk_insert()
  {
    $this->load->helper('string');
    $this->form_validation->set_rules('dummy_id','Dummy ID','required');

    if($this->form_validation->run() == TRUE)
    {
      $dummy_id = $this->input->post('dummy_id',TRUE);
      $site_id = $this->input->post('site_id',TRUE);
      $region = $this->input->post('region',TRUE);
      $provinsi = $this->input->post('provinsi',TRUE);
      $kabupaten = $this->input->post('kabupaten',TRUE);
      $kecamatan = $this->input->post('kecamatan',TRUE);
      $desa = $this->input->post('desa',TRUE);
      $paket = $this->input->post('paket',TRUE);
      $batch_ = $this->input->post('batch_',TRUE);
      $ctrm = $this->input->post('ctrm',TRUE);
      $ctsi = $this->input->post('ctsi',TRUE);
      $amount_insured = $this->input->post('amount_insured',TRUE);
      $no_sertif = $this->input->post('no_sertif',TRUE);
      $keterangan = $this->input->post('keterangan',TRUE);
      $qty = $this->input->post('qty',TRUE);

      $data = array(
        'dummy_id' => $dummy_id,
        'site_id' => $site_id,
        'region' => $region,
        'provinsi' => $provinsi,
        'kabupaten' => $kabupaten,
        'kecamatan' => $kecamatan,
        'desa' => $desa,
        'paket' => $paket,
        'batch_' => $batch_,
        'ctrm' => $ctrm,
        'ctsi' => $ctsi,
        'amount_insured' => $amount_insured,
        'no_sertif' => $no_sertif,
        'keterangan' => $keterangan
      );

      $data2 = array(
        'dummy_id' => $dummy_id,
        'site_id2' => $site_id,
        'qty' => $qty
      );
      
      $this->M_admin->insert('tb_site_in',$data);
      $this->M_admin->insert('tb_site_out_items',$data2);

      $this->session->set_flashdata('msg_berhasil','Data Barang Berhasil Ditambahkan');
      redirect(base_url('admin/form_barangmasuk'));
      
    }else {
      $data['list_satuan'] = $this->M_admin->select('tb_satuan');
      $this->load->view('admin/form_barangmasuk/form_insert',$data);
    }
  }

  public function proses_insert_datamasuk()
  {
    $this->form_validation->set_rules('site_id','site_id','required');
    //$this->form_validation->set_rules('kecamatan','Kecamatan','required');
    //$this->form_validation->set_rules('desa','Desa','required');
    //$this->form_validation->set_rules('batch_','Batch','required');

    if($this->form_validation->run() == TRUE)
    {

      $sha1 = random_string('alpha', 10);
      $sha2 = random_string('sha1');
      $dummy_id = $sha1.$sha2;

      $site_id = $this->input->post('site_id',TRUE);
      $region = $this->input->post('region',TRUE);
      $provinsi = $this->input->post('provinsi',TRUE);
      $kabupaten = $this->input->post('kabupaten',TRUE);
      $kecamatan = $this->input->post('kecamatan',TRUE);
      $desa = $this->input->post('desa',TRUE);
      $paket = $this->input->post('paket',TRUE);
      $batch_ = $this->input->post('batch_',TRUE);
      $ctrm = $this->input->post('ctrm',TRUE);
      $ctsi = $this->input->post('ctsi',TRUE);
      $amount_insured = $this->input->post('amount_insured',TRUE);
      $keterangan = $this->input->post('keterangan',TRUE);
      //$terbit = $this->input->post('terbit',TRUE);

      if ($keterangan == "300 Site") {    
            $cmop = '0608032100001';
        } elseif ($keterangan == "58 Site"){
            $cmop = '0608032100003';
        }elseif ($keterangan == "216 Site"){
            $cmop = '0608032100004';
        }elseif ($keterangan == "491 Site"){
            $cmop = '0608032100005';
        }elseif ($keterangan == "180 Site"){
            $cmop = '0608032100006';
        }elseif ($keterangan == "236 Site"){
            $cmop = '0608032100007';
        }

      $data = array(
            'dummy_id' => $dummy_id,
            'site_id' => $site_id,
            'keterangan' => $keterangan,
            'cmop' => $cmop,
            'region' => $region,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'desa' => $desa,
            'paket' => $paket,
            'batch_' => $batch_,
            'ctrm' => $ctrm,
            'ctsi' => $ctsi,
            'amount_insured' => $amount_insured,
            //'terbit' => $terbit
      );

      $this->M_admin->insert('tb_site_in',$data);
      $this->session->set_flashdata('msg_berhasil','Data Berhasil Ditambahkan');
      redirect(base_url('admin/tabel_barangmasuk'));
    }else{
      $this->load->view('admin/form_barangmasuk/form_insert');
    }
  }

  public function proses_datamasuk_move()
  {
    $this->load->helper('string');
    $this->form_validation->set_rules('dummy_id','Dummy ID','required');

    if($this->form_validation->run() == TRUE)
    {
      $dummy_id = $this->input->post('dummy_id',TRUE);
      $site_id = $this->input->post('site_id',TRUE);
      $region = $this->input->post('region',TRUE);
      $provinsi = $this->input->post('provinsi',TRUE);
      $kabupaten = $this->input->post('kabupaten',TRUE);
      $kecamatan = $this->input->post('kecamatan',TRUE);
      $desa = $this->input->post('desa',TRUE);
      $paket = $this->input->post('paket',TRUE);
      $batch_ = $this->input->post('batch_',TRUE);
      $ctrm = $this->input->post('ctrm',TRUE);
      $ctsi = $this->input->post('ctsi',TRUE);
      $amount_insured = $this->input->post('amount_insured',TRUE);
      $no_sertif = $this->input->post('no_sertif',TRUE);
      $keterangan = $this->input->post('keterangan',TRUE);
      $qty = $this->input->post('qty',TRUE);

      $data = array(
        'dummy_id' => $dummy_id,
        'site_id' => $site_id,
        'region' => $region,
        'provinsi' => $provinsi,
        'kabupaten' => $kabupaten,
        'kecamatan' => $kecamatan,
        'desa' => $desa,
        'paket' => $paket,
        'batch_' => $batch_,
        'ctrm' => $ctrm,
        'ctsi' => $ctsi,
        'amount_insured' => $amount_insured,
        'no_sertif' => $no_sertif,
        'keterangan' => $keterangan
      );

      $data2 = array(
        'dummy_id' => $dummy_id,
        'site_id2' => $site_id,
        'qty' => $qty
      );
      
      $this->M_admin->insert('tb_site_in',$data);
      $this->M_admin->insert('tb_site_out_items',$data2);

      $this->session->set_flashdata('msg_berhasil','Data Barang Berhasil Ditambahkan');
      redirect(base_url('admin/form_barangmasuk'));
      
    }else {
      $data['list_satuan'] = $this->M_admin->select('tb_satuan');
      $this->load->view('admin/form_barangmasuk/form_insert',$data);
    }
  }

  public function proses_datamasuk_update()
  {
    $this->form_validation->set_rules('dummy_id','dummy_id','required');
    //$this->form_validation->set_rules('kecamatan','Kecamatan','required');
    //$this->form_validation->set_rules('desa','Desa','required');
    //$this->form_validation->set_rules('batch_','Batch','required');

    if($this->form_validation->run() == TRUE)
    {
      $dummy_id = $this->input->post('dummy_id',TRUE);
      $site_id = $this->input->post('site_id',TRUE);
      $linked_with = $this->input->post('linked_with',TRUE);
      $region = $this->input->post('region',TRUE);
      $provinsi = $this->input->post('provinsi',TRUE);
      $kabupaten = $this->input->post('kabupaten',TRUE);
      $kecamatan = $this->input->post('kecamatan',TRUE);
      $desa = $this->input->post('desa',TRUE);
      $paket = $this->input->post('paket',TRUE);
      $batch_ = $this->input->post('batch_',TRUE);
      $ctrm = $this->input->post('ctrm',TRUE);
      $ctsi = $this->input->post('ctsi',TRUE);
      $amount_insured = $this->input->post('amount_insured',TRUE);
      $keterangan = $this->input->post('keterangan',TRUE);
      //$terbit = $this->input->post('terbit',TRUE);

      if ($keterangan == "300 Site") {    
          $cmop = '0608032100001';
      } elseif ($keterangan == "58 Site"){
          $cmop = '0608032100003';
      }elseif ($keterangan == "216 Site"){
          $cmop = '0608032100004';
      }elseif ($keterangan == "491 Site"){
          $cmop = '0608032100005';
      }elseif ($keterangan == "180 Site"){
          $cmop = '0608032100006';
      }elseif ($keterangan == "236 Site"){
          $cmop = '0608032100007';
      }

      $where = array('dummy_id' => $dummy_id);
      $data = array(
            'dummy_id' => $dummy_id,
            'site_id' => $site_id,
            'keterangan' => $keterangan,
            'cmop' => $cmop,

            'region' => $region,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'desa' => $desa,
            'paket' => $paket,
            'batch_' => $batch_,
            'ctrm' => $ctrm,
            'ctsi' => $ctsi,
            'amount_insured' => $amount_insured,
            'linked_with' => $linked_with,
            //'terbit' => $terbit
      );


      $this->M_admin->update('tb_site_in',$data,$where);
      $this->session->set_flashdata('msg_berhasil','Data Barang Berhasil Diupdate');
      redirect(base_url('admin/tabel_barangmasuk'));
    }else{
      $this->load->view('admin/form_barangmasuk/form_update');
    }
  }
  ####################################
      // END DATA Data Masuk
  ####################################

  ####################################
     // DATA MASUK KE DATA KELUAR
  ####################################

  public function proses_data_keluar()
  {
    $this->form_validation->set_rules('dummy_id','Dummy ID','trim|required');
    if($this->form_validation->run() === TRUE)
    {
      $no_sertif = $max_id=$this->M_admin->get_max_id('no_sertif','tb_site_in');

      $dummy_id = $this->input->post('dummy_id',TRUE);
      $site_id = $this->input->post('site_id',TRUE);
      $linked_with = $this->input->post('linked_with',TRUE);

      $region = $this->input->post('region',TRUE);
      $provinsi = $this->input->post('provinsi',TRUE);
      $kabupaten = $this->input->post('kabupaten',TRUE);
      $kecamatan = $this->input->post('kecamatan',TRUE);
      $desa = $this->input->post('desa',TRUE);
      $paket = $this->input->post('paket',TRUE);
      $batch_ = $this->input->post('batch_',TRUE);
      $ctrm = $this->input->post('ctrm',TRUE);
      $ctsi = $this->input->post('ctsi',TRUE);
      $amount_insured = $this->input->post('amount_insured',TRUE);

      $keterangan = $this->input->post('keterangan',TRUE);
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
      $lampiran_PL =$this->input->post("lampiran_PL");
      $lampiran_DO =$this->input->post("lampiran_DO");

      //$the_insured = $this->db->get_where('tb_site_in', array('dummy_id' => $dummy_id));
      //$terbit = $this->input->post('terbit',TRUE);

      $where = array('dummy_id' => $dummy_id);
      $data = array(
            //'the_insured' => $the_insured,
            'no_sertif' => $no_sertif,
            'dummy_id' => $dummy_id,
            'site_id' => $site_id,
            'linked_with' => $linked_with,

            'region' => $region,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'desa' => $desa,
            'paket' => $paket,
            'batch_' => $batch_,
            'ctrm' => $ctrm,
            'ctsi' => $ctsi,
            'amount_insured' => $amount_insured,
            'keterangan' => $keterangan,

            //'terbit' => $terbit

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
            'lampiran_PL' => $lampiran_PL,
            'lampiran_DO' => $lampiran_DO,
      );
        $this->M_admin->update('tb_site_in',$data,$where);  
        $this->session->set_flashdata('msg_berhasil_keluar','Data Berhasil Keluar');
        redirect(base_url('admin/tabel_barangmasuk'));
    }else {
        $this->load->view('perpindahan_data/form_update/'.$dummy_id);
    }

  }
  ####################################
    // END DATA MASUK KE DATA KELUAR
  ####################################


  ####################################
        // DATA Data Keluar
  ####################################

  public function tabel_barangkeluar()
  {
    $data['list_data'] = $this->M_admin->select('tb_site_out');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/tabel/tabel_barangkeluar',$data);
  }


}
?>
