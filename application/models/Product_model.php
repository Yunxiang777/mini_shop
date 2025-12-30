<?php
class Product_model extends CI_Model
{
    public function get_products()
    {
        return $this->db->get('products')->result();
    }

    public function get_product($id)
    {
        return $this->db->get_where('products', ['id' => $id])->row();
    }
}
