<?php

class Penyakit_model extends CI_Model
{
    public function getPenyakit($id = null)
    {
        if($id == null){
            return $this->db->get('penyakit')->result_array();
        } else{
            return $this->db->get_where('penyakit', ['id_penyakit' => $id])->result_array();
        }
    }
}