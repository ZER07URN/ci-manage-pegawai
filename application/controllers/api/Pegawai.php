<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Pegawai extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pegawai_model','p');
	}
	public function index_get(){
		$nip= $this->get('nip');
		if($nip === null){
			$pegawai = $this->p->ambilPegawai();
		}else{
			$pegawai = $this->p->ambilPegawai($nip);
		}

		if($pegawai){
			$this->response([
                'status' => TRUE,
                'data' => $pegawai
            ], REST_Controller::HTTP_OK);
		}else{
			$this->response([
                'status' => FALSE,
                'message' => 'Tidak ada data Pegawai'
            ], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function index_delete(){
		$nip = $this->delete('id');
		if ($nip === null) {
			$this->response([
                'status' => FALSE,
                'message' => 'NIP Null'
            ], REST_Controller::HTTP_BAD_REQUEST);
		}else{
			if ($this->p->updatePegawai($nip) > 0) {
				$this->response([
	                'status' => TRUE,
	                'nip' => $nip,
	                'message' => 'Data terhapus'
	            ], REST_Controller::HTTP_NO_CONTENT);
			}else{
				$this->response([
	                'status' => FALSE,
	                'message' => 'NIP Not Found'
	            ], REST_Controller::HTTP_BAD_REQUEST);
			}
		}
	}

	public function index_post(){
		$data = [
					'nip' => $this->post('nip'),
					'nama_lengkap' => $this->post('nama_lengkap'),
					'id_jabatan' => $this->post('id_jabatan'),
					'status' => $this->post('status')
		];

		if ($this->p->tambahPegawai($data) > 0) {
			$this->response([
                'status' => TRUE,
                'message' => 'Data tersimpan.'
            ], REST_Controller::HTTP_CREATED);

		}else{
			$this->response([
                'status' => FALSE,
                'message' => 'Gagal menyimpan data.'
            ], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function index_put(){
		$nip = $this->put('nip');
		$data = [
					'nip' => $this->post('nip'),
					'nama_lengkap' => $this->post('nama_lengkap'),
					'id_jabatan' => $this->post('id_jabatan'),
					'status' => $this->post('status')
		];
		if ($this->p->editPegawai($data, $nip) > 0) {
			$this->response([
                'status' => TRUE,
                'message' => 'Data berhasil diedit.'
            ], REST_Controller::HTTP_NO_CONTENT);

		}else{
			$this->response([
                'status' => FALSE,
                'message' => 'Gagal edit data.'
            ], REST_Controller::HTTP_BAD_REQUEST);
		}
	}
}