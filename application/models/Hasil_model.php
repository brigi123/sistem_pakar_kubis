<?php

class Hasil_model extends CI_Model
{
    public function gethasil($id_user = null)
    {
        if($id_user != null){
            return $this->db->get_where('hasil', ['id_user' => $id_user])->result_array();
        }
    }

    public function deleteHasilUser($id)
    {
        $this->db->delete('hasil', ['id_user' => $id]);
        return $this->db->affected_rows();
    }
}