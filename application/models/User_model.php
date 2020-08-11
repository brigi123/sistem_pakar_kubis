<?php

class User_model extends CI_Model
{
    public function getUser($id = null, $telepon = null)
    {
        if($id != null && $telepon == null){
            return $this->db->get_where('user', ['id_user' => $id])->result_array();
        } elseif($telepon != null && $id == null){
            return $this->db->get_where('user', ['telepon' => $telepon])->result_array();
        } else{
            return $this->db->get('user')->result_array();
        }
    }

    public function tambahUser($data)
    {
        $this->db->insert('user', $data);
        return $this->db->affected_rows();
    }

    public function updateUser($data, $id)
    {
        $this->db->update('user', $data, ['id_user' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteUser($id)
    {
        $this->db->delete('user', ['id_user' => $id]);
        return $this->db->affected_rows();
    }
}