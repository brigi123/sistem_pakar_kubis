<?php

class Jawaban_model extends CI_Model
{
    public function getJawaban($user = null, $gejala = null)
    {
        if($user != null && $gejala == null){
            return $this->db->get_where('jawaban', ['id_user' => $user])->result_array();
        } elseif($gejala != null && $user == null){
            return $this->db->get_where('jawaban', ['id_gejala' => $gejala])->result_array();
        } elseif($user != null && $gejala != null){
            return $this->db->get_where('jawaban', [
                'id_user' => $user,    
                'id_gejala' => $gejala
            ])->result_array();
        } else{
            return $this->db->get('jawaban')->result_array();
        }
    }

    public function tambahJawaban($data)
    {
        $this->db->insert('jawaban', $data);
        return $this->db->affected_rows();
    }

    public function updateJawaban($data, $id_user, $id_gejala)
    {
        $this->db->update('jawaban', $data, [
            'id_user' => $id_user,
            'id_gejala' => $id_gejala
        ]);
        return $this->db->affected_rows();
    }

    public function getJawabanBenarByIdUser($id_user)
    {
        return $this->db->get_where('jawaban', [
            'id_user' => $id_user,
            'jawaban' => 'a'
            ])->result_array();
    }
}