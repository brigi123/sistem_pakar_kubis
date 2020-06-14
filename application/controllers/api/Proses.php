<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Proses extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jawaban_model', 'jawaban');
    }

    public function index_get()
    {
        $id_user = $this->get('id_user');

        if($id_user){
            $jawaban = $this->jawaban->getJawabanBenarByIdUser($id_user);
        }
        
        if($jawaban){
            for($i = 0; $i < count($jawaban); $i++){
                $jawaban[$i] = $this->db->query('Select * from jawaban j left join gejala g on j.id_gejala = g.id_gejala left join penyakit p on g.id_penyakit = p.id_penyakit where g.id_gejala=' . $jawaban[$i]['id_gejala'])->row_array();

                $m[$i] = $jawaban[$i]['point'];
                $t[$i] = 1 - $jawaban[$i]['point'];
                $m_simbol[$i] = $jawaban[$i]['simbol_penyakit'];
                $mt_simbol[$i] = null;
                $tm_simbol[$i] = null;
                $m_proses[$i] = null;
                $mt_proses[$i] = null;
                $tm_proses[$i] = null;
                $teta[$i] = null;

                if($i == 1){
                    if($jawaban[$i-1]['id_penyakit'] == $jawaban[$i]['id_penyakit']){
                        $m_simbol[$i] = $m_simbol[$i-1];
                        $m_proses[$i] = $m[$i-1] * $m[$i];
                    } else{
                        $m_simbol[$i] = null;
                        $m_proses[$i] = $m[$i-1] * $m[$i];
                    }

                    $mt_simbol[$i] = $jawaban[$i-1]['simbol_penyakit'];
                    $mt_proses[$i] = $m[$i-1] * $t[$i];
                    $tm_simbol[$i] = $jawaban[$i]['simbol_penyakit'];
                    $tm_proses[$i] = $t[$i-1] * $m[$i];
                    $teta[$i] = $t[$i-1] * $t[$i];
                }

                if($i >= 2){
                    if($m_simbol[$i-1] != null){
                        $a[$i] = $m_proses[$i-1]/(1-0);
                        $b[$i] = $mt_proses[$i-1]/(1-0);
                        $c[$i] = $tm_proses[$i-1]/(1-0);
                        $d[$i] = $teta[$i]/(1-0);
                    } else{
                        $a[$i] = $m_proses[$i-1]/(1-$m_proses[$i-1]);
                        $b[$i] = $mt_proses[$i-1]/(1-$m_proses[$i-1]);
                        $c[$i] = $tm_proses[$i-1]/(1-$m_proses[$i-1]);
                        $d[$i] = $teta[$i]/(1-$m_proses[$i-1]);
                    }

                    if($jawaban[$i-1]['id_penyakit'] == $jawaban[$i]['id_penyakit']){
                        $m_simbol[$i] = $m_simbol[$i-1];
                        $m_proses[$i] = $a[$i] * $m[$i];
                    } else{
                        $m_simbol[$i] = null;
                        $m_proses[$i] = $a[$i] * $m[$i];
                    }

                    $mt_simbol[$i] = $jawaban[$i-1]['simbol_penyakit'];
                    $mt_proses[$i] = $a[$i] * $t[$i];
                    $tm_simbol[$i] = $jawaban[$i]['simbol_penyakit'];
                    $tm_proses[$i] = $t[$i-1] * $m[$i];
                }

                echo $m[$i];
                echo ',';
                echo $t[$i];
                echo ',';
                echo $m_simbol[$i];
                echo ' ';
                echo $m_proses[$i];
                echo ',';
                echo $mt_simbol[$i];
                echo ' ';
                echo $mt_proses[$i];
                echo ',';
                echo $tm_simbol[$i];
                echo ' ';
                echo $tm_proses[$i];
                echo ' ; ';
            }
        } else{
            $this->response('id tidak ditemukan', REST_Controller::HTTP_NOT_FOUND);
        }
    }
}