<?php
Class Peg extends CI_Controller{
    
    var $API ="";
    
    function __construct() {
        parent::__construct();
        $this->API="http://localhost/ujici/index.php/api";
    }
    
    function index(){
        $username = $this->session->userdata('username');
        $data['username']=$username;
            if(isset($data['username'])){
                $json_string = 'http://localhost/ujici/index.php/api/pegawai';
                $jsondata = file_get_contents($json_string);
                $obj = json_decode($jsondata,true);
                $data['pegawai'] = $obj['data'];
                // foreach ($obj['data'] as $g){
                //     echo $g['nama_lengkap'];
                // }
                //print_r($data['pegawai']);
                $this->load->view('lihat_pegawai', $data);
        }else{
            redirect('auth/login','refresh');
        }
    }
    
    // insert data mahasiswa
    function create(){
        if(isset($_POST['submit'])){
            $data = array(
                'nim'       =>  $this->input->post('nim'),
                'nama'      =>  $this->input->post('nama'),
                'prodi'    =>  $this->input->post('prodi'),
                'alamat'    =>  $this->input->post('alamat'));
            $insert =  $this->curl->simple_post($this->API.'/mahasiswa', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($insert)
            {
                $this->session->set_flashdata('hasil','Insert Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Insert Data Gagal');
            }
            redirect('mahasiswa');
        }else{
            $data['jurusan'] = json_decode($this->curl->simple_get($this->API.'/jurusan'));
            $this->load->view('mahasiswa/create',$data);
        }
    }
    
    // edit data mahasiswa
    function edit(){
        if(isset($_POST['submit'])){
            $data = array(
                'nim'       =>  $this->input->post('nim'),
                'nama'      =>  $this->input->post('nama'),
                'prodi'    =>  $this->input->post('prodi'),
                'alamat'    =>  $this->input->post('alamat'));
            $update =  $this->curl->simple_put($this->API.'/mahasiswa', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($update)
            {
                $this->session->set_flashdata('hasil','Update Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Update Data Gagal');
            }
            redirect('mahasiswa');
        }else{
            $data['jurusan'] = json_decode($this->curl->simple_get($this->API.'/jurusan'));
            $params = array('nim'=>  $this->uri->segment(3));
            $data['mahasiswa'] = json_decode($this->curl->simple_get($this->API.'/mahasiswa',$params));
            $this->load->view('mahasiswa/edit',$data);
        }
    }
    
    // delete data mahasiswa
    function delete($nim){
        if(empty($nim)){
            redirect('mahasiswa');
        }else{
            $delete =  $this->curl->simple_delete($this->API.'/mahasiswa', array('nim'=>$nim), array(CURLOPT_BUFFERSIZE => 10)); 
            if($delete)
            {
                $this->session->set_flashdata('hasil','Delete Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Delete Data Gagal');
            }
            redirect('mahasiswa');
        }
    }
}