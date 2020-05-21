<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Gejala extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Gejala_model', 'gejala');
    }

    public function index_get()
    {
        $id = $this->get('id');
        $id_penyakit = $this->get('id_penyakit');

        if($id || $id_penyakit){
            $gejala = $this->gejala->getGejala($id, $id_penyakit);
        } else {
            $gejala = $this->gejala->getGejala();
        }
        
        if($gejala){
            $this->response([
                'status' => true,
                'data' => $gejala
            ], REST_Controller::HTTP_OK);
        } else{
            $this->response([
                'status' => false,
                'message' => 'id tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}