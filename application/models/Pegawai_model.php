<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_model extends CI_Model {
	public function ambilPegawai($nip = null){
		if ($nip === null) {
			return $this->db->get('pegawai')->result_array();
		}else{
			return $this->db->get_where('pegawai', ['nip' => $nip])->result_array();	
		}
		
	}
	public function updatePegawai($nip){
		//$this->db->delete('pegawai', ['nip' => $nip]);
		$this->db->select('status'); 
		$this->db->where('nip', $nip); 
		$query = $this->db->get('pegawai');

		foreach ($query->result() as $q) { // query diubah ke object lalu pindahkan ke variable $q
			if ($q->status === null) {
				return 0;
			}else{
				if ($q->status == 0) {
					//$this->db->update('jabatan', ['status' => 1]);
					$this->db->set('status', 1);
					$this->db->where('nip', $nip);
					$this->db->update('pegawai');
					return 1;
				}else{
					$this->db->set('status', 0);
					$this->db->where('id_jabatan', $id);
					$this->db->update('pegawai');
					return 1;
				}
			}
		}
		return $this->db->affected_rows();
	}

	public function tambahPegawai($data){
		$this->db->insert('pegawai', $data);
		return $this->db->affected_rows();
	}

	public function editPegawai($data, $nip)
	{
		$this->db->update('pegawai', $data, ['nip' => $nip]);
		return $this->db->affected_rows();
	}
}

/* End of file Pegawai_model.php */
/* Location: ./application/models/Pegawai_model.php */