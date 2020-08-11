<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Hasil extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Hasil_model', 'hasil');
    }

    public function index_get()
    {
        $id_user = $this->get('id_user');

        if($id_user){
            $gejala = $this->hasil->getHasil($id_user);
        }
        
        if($gejala){
            $this->response($gejala, REST_Controller::HTTP_OK);
        } else{
            $this->response('id tidak ditemukan', REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id_user');

        if($id == null){
            $this->response('dibutuhkan id user untuk delete', REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if($this->hasil->deleteHasilUser($id) > 0){
                $this->response('Hasil user berhasil dihapus.', REST_Controller::HTTP_OK);
            } else{
                $this->response('user tidak ditemukan', REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }
}