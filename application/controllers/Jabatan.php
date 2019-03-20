<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('jabatan_model', 'j');
	}


	public function index()
	{
		redirect('jabatan/lihat','refresh');
	}

	public function lihat()
	{
		$username = $this->session->userdata('username');
		$data['username']=$username;
		if(isset($data['username'])){
			$data['jabatan']=$this->j->lihat()->result();
            $this->load->view('lihat_jabatan', $data);
        }else{
            redirect('auth/login','refresh');
        }
	}
	public function tambah()
	{
		$username = $this->session->userdata('username');
		$data['username']=$username;
		if(isset($data['username'])){

			if(isset($_POST['submit']))
			{
				$nama = $this->input->post('nama');
				$keterangan = $this->input->post('keterangan');	
				$status = $this->input->post('status');	
				$tambah_post = $this->j->tambah($nama, $keterangan, $status);
				//notif
				$this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert"><center> Jabatan berhasil ditambahkan! </center></div>');
				redirect('jabatan/tambah','refresh');
			}
			else
			{
				$data['jabatan']=$this->j->lihat()->result();
            	$this->load->view('input_jabatan', $data);
			}
			
        }else{
            redirect('auth/login','refresh');
        }
	}
	public function edit($id = null)
	{
		$username = $this->session->userdata('username');
		$data['username']=$username;
		if(isset($data['username'])){
			//jika berhasil bikin session
			// cek status nya
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				// $nama_lengkap = $this->input->post('nama');
				// $keterangan = $this->input->post('keterangan');
				// $status = $this->input->post('status');
				$idd = $this->input->post('idz');

				$data = array(
					'nama_jabatan' 		=> $this->input->post('nama'),
					'keterangan' 		=> $this->input->post('keterangan'),
					'status' 		=> $this->input->post('status')
					);
					//update
					$this->db->where('id_jabatan', $idd);
					$this->db->update('jabatan', $data);
				//notif
				$this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert"><center> Jabatan Berhasil di Edit! </center></div>');
				redirect('jabatan/lihat','refresh');
			}
			else
			{
				if ($id === null) {
					$this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert"><center> Gagal edit, ID null! </center></div>');
					redirect('jabatan/lihat','refresh');
				}else{
					$jabatan = $this->j->ambilJabatanById($id)->result();
					$data['jabatan']=$jabatan;
					foreach ($jabatan as $j) {
						$data['idz'] = $j->id_jabatan;
						$data['nama_jabatan'] = $j->nama_jabatan;
						$data['keterangan'] = $j->keterangan;
						$data['status'] = $j->status;
					}
					$this->load->view('edit_jabatan', $data);
				}
			}
			
        }else{
            redirect('auth/login','refresh');
        }
	}
	public function aktivasi($id = null)
	{
		$username = $this->session->userdata('username');
		$data['username']=$username;
		if(isset($data['username'])){
			//jika berhasil bikin session
			// cek status nya
			if ($id === null) {
				$this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert"><center> ID tidak boleh null! </center></div>');
				redirect('jabatan/lihat','refresh');
			}else{
				$ubah = $this->j->aktivasi($id);
				if ($ubah) {
					$this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert"><center> Status Jabatan berhasil di update! </center></div>');
					redirect('jabatan/lihat','refresh');
				}else{
					$this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert"><center> ID tidak ada! </center></div>');
					redirect('jabatan/lihat','refresh');
				}
				
			}
        }else{
            redirect('auth/login','refresh');
        }
	}
	

}

/* End of file Jabatan.php */
/* Location: ./application/controllers/Jabatan.php */