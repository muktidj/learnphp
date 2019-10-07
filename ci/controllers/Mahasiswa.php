<?php

class Mahasiswa extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        // $this->load->database();
        // $this->load->model("Model_Mahasiswa");
        $this->load->library('form_validation');
    }


    public function index()
    {

        // $this->load->database();
        $data['title'] = "Mahasiswa Page";
        $this->load->model("Model_Mahasiswa");
        $data['mahasiswa'] = $this->Model_Mahasiswa->getAllMahasiswa();
        if ($this->input->post('keyword')) {
            $data['mahasiswa'] = $this->Model_Mahasiswa->cariDataMhs();
        }
        $this->load->view("templates/header", $data);
        $this->load->view("mahasiswa/view_mahasiswa", $data);
        $this->load->view("templates/footer");
    }

    public function tambah()
    {

        $data['title'] = "Form Tambah Data MHS";
        $this->load->model("Model_Mahasiswa");

        $this->form_validation->set_rules('nama', "Name", "required");
        $this->form_validation->set_rules('nrp', "NRP", "required|numeric");
        $this->form_validation->set_rules('email', "Email", "required|valid_email");
        if ($this->form_validation->run() == FALSE) {

            $this->load->view("templates/header", $data);
            $this->load->view("mahasiswa/view_tambah_data_mhs");
            $this->load->view("templates/footer");
        } else {
            $this->Model_Mahasiswa->tambahDataMhs();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('mahasiswa');
        }
    }

    public function hapus($id)
    {
        $this->load->model('Model_Mahasiswa');
        $this->Model_Mahasiswa->hapusDataMhs($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('mahasiswa');
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Data Mahasiswa';

        $this->load->model('Model_Mahasiswa');
        $data['mhs'] = $this->Model_Mahasiswa->getMhsById($id);
        $this->load->view("templates/header", $data);
        $this->load->view("mahasiswa/view_mahasiswa_detail", $data);
        $this->load->view("templates/footer");
    }

    public function ubah($id)
    {

        $data['title'] = "Form Ubah Data MHS";
        $this->load->model("Model_Mahasiswa");
        $data['mhs'] = $this->Model_Mahasiswa->getMhsById($id);
        $data['jurusan'] = ["Teknik Informatika", "Sistem Komputer", "Sistem Informasi"];

        $this->form_validation->set_rules('nama', "Name", "required");
        $this->form_validation->set_rules('nrp', "NRP", "required|numeric");
        $this->form_validation->set_rules('email', "Email", "required|valid_email");
        if ($this->form_validation->run() == FALSE) {

            $this->load->view("templates/header", $data);
            $this->load->view("mahasiswa/view_mahasiswa_ubah_mhs", $data);
            $this->load->view("templates/footer");
        } else {
            $this->Model_Mahasiswa->ubahDataMhs();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('mahasiswa');
        }
    }
}
