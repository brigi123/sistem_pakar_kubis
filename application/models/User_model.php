<?php

class User_model extends CI_Model
{
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
}