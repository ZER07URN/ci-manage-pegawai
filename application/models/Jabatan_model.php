<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan_model extends CI_Model {
	public function lihat()
	{
		$this->db->order_by('nama_jabatan', 'ASC');
		return $this->db->get('jabatan');
	}
	public function tambah($nama, $keterangan, $status)

	{
		$data = array(
			'nama_jabatan' => $nama,
			'keterangan' => $keterangan,
			'status' => $status
		);
		$this->db->insert('jabatan', $data);
	}
	function aktivasi($id) //function untuk mengambil id dari login
	{
		$this->db->select('status'); 
		$this->db->where('id_jabatan', $id); 
		$query = $this->db->get('jabatan');

		foreach ($query->result() as $q) { // query diubah ke object lalu pindahkan ke variable $q
			if ($q->status === null) {
				return 0;
			}else{
				if ($q->status == 0) {
					//$this->db->update('jabatan', ['status' => 1]);
					$this->db->set('status', 1);
					$this->db->where('id_jabatan', $id);
					$this->db->update('jabatan');
					return 1;
				}else{
					$this->db->set('status', 0);
					$this->db->where('id_jabatan', $id);
					$this->db->update('jabatan');
					return 1;
				}
			}
		}
		
	}
	public function ambilJabatanById($id){
		return $this->db->get_where('jabatan',array('id_jabatan'=>$id));
	}
}

/* End of file Jabatan_model.php */
/* Location: ./application/models/Jabatan_model.php */