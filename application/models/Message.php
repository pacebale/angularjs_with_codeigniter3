<?php
class Message extends CI_Model {
    public $table = 'messages';

    public function all()
    {
        return $this->db->get($this->table)->result_array();
    }

    public function create($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function find($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        $this->db->delete($this->table, ['id' => $id]); 
    }
}
