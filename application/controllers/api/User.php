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

    public function index_get()
    {
        $id = $this->get('id_user');
        $telepon = $this->get('telepon');

        if($id || $telepon){
            $user = $this->user->getUser($id, $telepon);
        } else{
            $user = $this->user->getUser();
        }
        
        if($user){
            $this->response($user, REST_Controller::HTTP_OK);
        } else{
            $this->response('data tidak ditemukan', REST_Controller::HTTP_OK);
        }
    }

    public function index_post()
    {
        $data = [
            'nama' => $this->post('nama'),
            'alamat' => $this->post('alamat'),
            'telepon' => $this->post('telepon')
        ];
        
        if($this->user->tambahUser($data) > 0){
            $this->response('pengguna berhasil ditambahkan', REST_Controller::HTTP_CREATED);
        } else{
            $this->response('tambah pengguna gagal!', REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id = $this->put('id_user');
        $data = [
            'nama' => $this->put('nama'),
            'alamat' => $this->put('alamat'),
            'telepon' => $this->put('telepon')
        ];

        if($this->user->updateUser($data, $id) > 0){
            $this->response('data pengguna berhasil diperbarui.', REST_Controller::HTTP_OK);
        } else{
            $this->response('pembaruan data pengguna gagal!', REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id_user');

        if($id == null){
            $this->response('dibutuhkan id user untuk delete', REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if($this->user->deleteUser($id) > 0){
                $this->response('User berhasil dihapus.', REST_Controller::HTTP_OK);
            } else{
                $this->response('user tidak ditemukan', REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }
}