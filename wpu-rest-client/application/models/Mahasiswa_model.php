<?php 
use GuzzleHttp\Client;

class Mahasiswa_model extends CI_model {
    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'http://localhost:8000/api/',
            'auth' => ['ricko@gmail.com', '12345'],
            'query' => [
                'apikey' => '1uAxqBhS7iG1v6ma2FWu2MjzHNUdDkM1QZ7DgbEn9LzuVOmM46Mkdoz6IUcQ1wpiU4cgbjMRiFCqQnXq'
            ]
        ]);
    }

    public function getAllMahasiswa()
    {
        $response = $this->_client->request('GET', 'mahasiswas');

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['data'];
    }
    
    public function getMahasiswaById($id)
    {
        $response = $this->_client->request('GET', 'mahasiswas/' . $id);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result['data'];
    }

    public function tambahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true)
        ];

        $response = $this->_client->request('POST', 'mahasiswas', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;
    }

    public function hapusDataMahasiswa($id)
    {
        $response = $this->_client->request('DELETE', 'mahasiswas/'. $id);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;
    }

    public function ubahDataMahasiswa()
    {
        $mahasiswa = $this->getMahasiswaById($this->input->post('id', true));

        $data = [
            "nama" => $this->input->post('nama', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true)
        ];
        
        if($mahasiswa['nrp'] != $this->input->post('nrp', true)){
            $data['nrp'] = $this->input->post('nrp', true);
        }

        $response = $this->_client->request('PUT', 'mahasiswas/' . $this->input->post('id', true), [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);

        return $result;
    }

    public function cariDataMahasiswa()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama', $keyword);
        $this->db->or_like('jurusan', $keyword);
        $this->db->or_like('nrp', $keyword);
        $this->db->or_like('email', $keyword);
        return $this->db->get('mahasiswa')->result_array();
    }
}