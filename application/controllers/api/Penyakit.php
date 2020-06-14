<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Penyakit extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Penyakit_model', 'penyakit');
    }

    public function index_get()
    {
        $id = $this->get('id_penyakit');

        if($id == null){
            $penyakit = $this->penyakit->getPenyakit();
        } else {
            $penyakit = $this->penyakit->getPenyakit($id);
        }
        
        if($penyakit){
            $this->response($penyakit, REST_Controller::HTTP_OK);
        } else{
            $this->response('id tidak ditemukan', REST_Controller::HTTP_NOT_FOUND);
        }
    }
}