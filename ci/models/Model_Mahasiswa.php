<?php

class Model_Mahasiswa extends CI_model
{

    public function getAllMahasiswa()
    {

        //   return  $query = $this->db->get('mahasiswa')->result_aray();
        $query = $this->db->get('mahasiswa');
        return $query->result_array();
    }

    public function tambahDataMhs()
    {

        $data = [
            "nama" => $this->input->post('nama', true),
            // untuk mengamanin dari karakter aneh, TRUE
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan')
        ];

        $this->db->insert('mahasiswa', $data);
    }

    public function hapusDataMhs($id)
    {

        $this->db->where('id', $id);
        $this->db->delete('mahasiswa');
    }

    public function getMhsById($id) {

        return $this->db->get_where('mahasiswa', ['id' => $id])->row_array();
    }

    public function ubahDataMhs()
    {

        $data = [
            "nama" => $this->input->post('nama', true),
            // untuk mengamanin dari karakter aneh, TRUE
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan')
        ];

        $this->db->where('id', $this->input->post('id') );
        $this->db->update('mahasiswa', $data);
    }

    public function cariDataMhs()  {
        $keyword = $this->input->post('keyword', true);
        // TRUE Kalo Datanya diinsert ke DB biar yakin aja
        $this->db->like('nama', $keyword);
        $this->db->or_like('jurusan', $keyword);
        $this->db->or_like('nrp', $keyword);
        return $this->db->get('mahasiswa')->result_array();
    }
}
