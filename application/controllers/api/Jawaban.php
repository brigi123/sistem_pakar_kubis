<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Jawaban extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jawaban_model', 'jawaban');
    }

    public function index_get()
    {
        $user = $this->get('id_user');
        $gejala = $this->get('id_gejala');

        if($user || $gejala){
            $jawaban = $this->jawaban->getJawaban($user, $gejala);
        } else{
            $jawaban = $this->jawaban->getJawaban();
        }
        
        if($jawaban){
            $this->response([
                'status' => true,
                'data' => $jawaban
            ], REST_Controller::HTTP_OK);
        } else{
            $this->response([
                'status' => false,
                'message' => 'data tidak ditemukan'
            ], REST_Controller::HTTP_OK);
        }
    }

    public function index_post()
    {
        $data = [
            'id_user' => $this->post('id_user'),
            'id_gejala' => $this->post('id_gejala'),
            'jawaban' => $this->post('jawaban')
        ];
        
        if($this->jawaban->tambahJawaban($data) > 0){
            $this->response([
                'status' => true,
                'message' => 'jawaban berhasil ditambahkan'
            ], REST_Controller::HTTP_CREATED);
        } else{
            $this->response([
                'status' => false,
                'message' => 'tambah jawaban gagal!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id_user = $this->put('id_user');
        $id_gejala = $this->put('id_gejala');
        $data = [
            'jawaban' => $this->put('jawaban')
        ];

        if($this->jawaban->updateJawaban($data, $id_user, $id_gejala) > 0){
            $this->response([
                'status' => true,
                'message' => 'jawaban berhasil diperbarui.'
            ], REST_Controller::HTTP_OK);
        } else{
            $this->response([
                'status' => false,
                'message' => 'pembaruan jawaban gagal!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}