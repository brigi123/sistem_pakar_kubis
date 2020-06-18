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
        if(isset($_POST['gejala'])){
            $sql = "SELECT GROUP_CONCAT(p.simbol_penyakit), g.point 
                FROM gejala g 
                JOIN penyakit p ON g.id_penyakit=p.id_penyakit 
                WHERE g.id_gejala IN (".implode(',',$_POST['gejala']).")  
                GROUP BY g.id_gejala";
            $result= $this->db->query($sql); 
            $evidence = array(); 
            while($row = $result->row()){ 
                $evidence[]=$row; 
            } 
            //--- menentukan environement 
            $sql="SELECT GROUP_CONCAT(simbol_penyakit) FROM penyakit"; 
            $result=$this->db->query($sql); 
            $row=$result->row();
            $fod=$row[0];
                
            //--- menentukan nilai densitas 
            echo "== MENENTUKAN NILAI DENSITAS ==\n"; 
            $densitas_baru=array(); 
            while(!empty($evidence)){ 
                $densitas1[0]=array_shift($evidence); 
                $densitas1[1]=array($fod,1-$densitas1[0][1]); 
                $densitas2=array(); 
                if(empty($densitas_baru)){ 
                    $densitas2[0]=array_shift($evidence); 
                }else{ 
                    foreach($densitas_baru as $k=>$r){ 
                        if($k!="&theta;"){ 
                            $densitas2[]=array($k,$r); 
                        } 
                    } 
                } 
                $theta=1; 
                foreach($densitas2 as $d) $theta-=$d[1]; 
                $densitas2[]=array($fod,$theta); 
                $m=count($densitas2); 
                $densitas_baru=array(); 
                for($y=0;$y<$m;$y++){ 
                    for($x=0;$x<2;$x++){ 
                        if(!($y==$m-1 && $x==1)){ 
                            $v=explode(',',$densitas1[$x][0]); 
                            $w=explode(',',$densitas2[$y][0]); 
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
            echo "== PERANGKINGAN ==\n"; 
            unset($densitas_baru["&theta;"]); 
            arsort($densitas_baru); 
            print_r($densitas_baru); 
                
            //--- menampilkan hasil akhir 
            echo "== HASIL AKHIR ==\n"; 
            $codes=array_keys($densitas_baru);  
            $final_codes=explode(',',$codes[0]); 
            $sql="SELECT GROUP_CONCAT(nama_penyakit)   
            FROM penyakit   
            WHERE simbol_penyakit IN('".implode("','",$final_codes)."')";  
            $result=$this->db->query($sql);  
            $row=$result->fetch_row();  
            echo "Terdeteksi penyakit <b>{$row[0]}</b> dengan derajat kepercayaan ".round($densitas_baru[$codes[0]]*100,2)."%";
        }
    }
}