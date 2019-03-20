<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Jabatan extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Jabatan_api_model','jam');
	}
	public function index_get(){
		$id= $this->get('id');
		if($id === null){
			$jabatan = $this->jam->ambilJabatan();
		}else{
			$jabatan = $this->jam->ambilJabatan($id);
		}

		if($jabatan){
			$this->response([
                'status' => TRUE,
                'data' => $jabatan
            ], REST_Controller::HTTP_OK);
		}else{
			$this->response([
                'status' => FALSE,
                'message' => 'Tidak ada data Jabatan'
            ], REST_Controller::HTTP_NOT_FOUND);
		}
	}

}