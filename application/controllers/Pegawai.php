<?php
Class Pegawai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->API="http://localhost/ujici/api";
        // //$this->load->library('session');
        $this->load->library('curl');
        // $this->load->helper('form');
        // $this->load->helper('url');
	}

	public function index()
	{
		redirect('pegawai/lihat','refresh');
	}
	public function lihat()
	{
		$username         = $this->session->userdata('username');
		$data['username'] = $username;
		if (isset($data['username'])) {
			$json_string     = 'http://localhost/ujici/index.php/api/pegawai';
			$jsondata        = file_get_contents($json_string);
			$obj             = json_decode($jsondata, true);
			$data['pegawai'] = $obj['data'];
			// foreach ($obj['data'] as $g){
			//     echo $g['nama_lengkap'];
			// }
			//print_r($data['pegawai']);
			$this->load->view('lihat_pegawai', $data);
		} else {
			redirect('auth/login', 'refresh');
		}
	}
	public function tambah()
	{
		$username = $this->session->userdata('username');
		$data['username']=$username;
		if(isset($data['username'])){
			if(isset($_POST['submit'])){
	            $data = array(
	                'nip'       =>  $this->input->post('nip'),
	                'nama_lengkap'      =>  $this->input->post('nama_lengkap'),
	                'id_jabatan'=>  $this->input->post('id_jabatan'),
	                'status'=>  $this->input->post('status')
	            );
	            $insert =  $this->curl->simple_post('http://localhost/ujici/index.php/api/pegawai', $data, array(CURLOPT_BUFFERSIZE => 10)); 
	            if($insert)
	            {
	                $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert"><center> Pegawai berhasil ditambahkan! </center></div>');
	            }else
	            {
	               $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert"><center> Pegawai gagal ditambahkan! </center></div>');
	            }
	            redirect('pegawai/lihat');
	        }else{
	            $this->load->view('input_pegawai', $data);
	        }

            
        }else{
            redirect('auth/login','refresh');
        }
	}
	public function edit()
	{
		# code...
	}
	function aktivasi($id){
        if(empty($id)){
            redirect('pegawai');
        }else{
            $delete =  $this->curl->simple_delete('http://localhost/ujici/index.php/api/pegawai', array('id'=>$id), array(CURLOPT_BUFFERSIZE => 10)); 
            if($delete)
            {
                $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert"><center> Status berhasil di ganti! </center></div>');
            }else
            {
               $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert"><center> Status gagal di ganti! </center></div>');
            }
            redirect('kontak');
        }
    }

}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */