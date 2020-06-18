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
                $row = $this->db->query('Select GROUP_CONCAT(p.simbol_penyakit) as simbol, g.point as point from jawaban j left join gejala g on j.id_gejala = g.id_gejala left join penyakit p on g.id_penyakit = p.id_penyakit where g.id_gejala=' . $jawaban[$i]['id_gejala'] . ' GROUP BY j.id_gejala')->row_array();
                
                $evidence=array();
                $evidence[] = $row;

                //--- menentukan environement
                $sp = $this->db->query("SELECT GROUP_CONCAT(simbol_penyakit) as simbol FROM penyakit")->result_array();
                $fod=$sp[0];
    
                //--- menentukan nilai densitas
                $densitas_baru = array();
                while(!empty($evidence)){
                    $densitas1[0]=array_shift($evidence);
                    $densitas1[1]=array($fod,1-$densitas1[0]['point']);
                    $densitas2=array();
                    if(empty($densitas_baru)){
                        $densitas2[0]=array_shift($densitas1);
                    }else{
                        foreach($densitas_baru as $k=>$r){
                            if($k!="&theta;"){
                                $densitas2[]=array($k,$r);
                            }
                        }
                    }
                    
                    $theta=1;
                    foreach($densitas2 as $d){
                        $theta -= $d['point'];
                    }   
                    $densitas2[]=array($fod,$theta);
                    $m=count($densitas2);
                    $densitas_baru=array();
                    for($y=0;$y<$m;$y++){
                        for($x=0;$x<2;$x++){
                            if(!($y==$m-1 && $x==1)){
                                $v = explode(',', $densitas1[$x][0]);
                                $w = explode(',', $densitas2[$y][0]);
                                sort($v);
                                sort($w);
                                $vw=array_intersect($v,$w);
                                if(empty($vw)){
                                    $k="&theta;";
                                }else{
                                    $k=implode(',',$vw);
                                }
                                if(!isset($densitas_baru[$k])){
                                    $densitas_baru[$k]=$densitas1[$x][1]*$densitas2[$y][1];
                                }else{
                                    $densitas_baru[$k]+=$densitas1[$x][1]*$densitas2[$y][1];
                                }
                            }
                        }
                    }
                    foreach($densitas_baru as $k=>$d){
                        if($k!="&theta;"){
                            $densitas_baru[$k]=$d/(1-(isset($densitas_baru["&theta;"])?$densitas_baru["&theta;"]:0));
                        }
                    }
                    print_r($densitas_baru);
                }
    
                //--- perangkingan
                unset($densitas_baru["&theta;"]);
                arsort($densitas_baru);
                print_r($densitas_baru);
    
                //--- menampilkan hasil akhir
                $codes=array_keys($densitas_baru);
                $row=$this->db->query("SELECT GROUP_CONCAT(nama_penyakit) FROM penyakit WHERE simbol_penyakit IN('{$codes[0]}')")->result_array();
                echo "Terdeteksi penyakit <b>{$row[0]}</b> dengan derajat kepercayaan ".round($densitas_baru[$codes[0]]*100,2)."%";
            }
        } else{
            $this->response('id tidak ditemukan', REST_Controller::HTTP_NOT_FOUND);
        }
    }
}