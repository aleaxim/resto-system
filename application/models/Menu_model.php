<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Menu_model extends CI_Model {
    
    public function create($formArray) {
        $this->db->insert('dishes', $formArray);
    }

    public function getMenu() {
        $result = $this->db->get('dishes')->result_array();
        return $result;
    }

    public function getSingleDish($id) {
        $this->db->where('d_id', $id);
        $dish = $this->db->get('dishes')->row_array();
        return $dish;
    }

    public function update($id, $formArray) {
        $this->db->where('d_id', $id);
        $this->db->update('dishes', $formArray);
    } 

    public function delete($id) {
        $this->db->where('d_id',$id);
        $this->db->delete('dishes');
    }

    public function countDish() {
        $query = $this->db->get('dishes');
        return $query->num_rows();
    }

    public function getdishes($id) {
        $this->db->where('r_id', $id);
        $dish = $this->db->get('dishes')->result_array();
        return $dish;
    }
}
