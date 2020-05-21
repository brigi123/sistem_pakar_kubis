<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class User extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
    }

    public function index_post()
    {
        $data = [
            'nama' => $this->post('nama'),
            'alamat' => $this->post('alamat'),
            'telepon' => $this->post('telepon')
        ];
        
        if($this->user->tambahUser($data) > 0){
            $this->response([
                'status' => true,
                'message' => 'pengguna berhasil ditambahkan'
            ], REST_Controller::HTTP_CREATED);
        } else{
            $this->response([
                'status' => false,
                'message' => 'tambah pengguna gagal!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'nama' => $this->put('nama'),
            'alamat' => $this->put('alamat'),
            'telepon' => $this->put('telepon')
        ];

        if($this->user->updateUser($data, $id) > 0){
            $this->response([
                'status' => true,
                'message' => 'data pengguna berhasil diperbarui.'
            ], REST_Controller::HTTP_OK);
        } else{
            $this->response([
                'status' => false,
                'message' => 'pembaruan data pengguna gagal!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}