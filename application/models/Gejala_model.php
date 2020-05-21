<?php

class Gejala_model extends CI_Model
{
    public function getGejala($id = null, $id_penyakit = null)
    {
        if($id != null && $id_penyakit == null){
            return $this->db->get_where('gejala', ['id_gejala' => $id])->result_array();
        } elseif($id_penyakit != null && $id == null){
            return $this->db->get_where('gejala', ['id_penyakit' => $id_penyakit])->result_array();
        } else{
            return $this->db->get('gejala')->result_array();
        }
    }
}