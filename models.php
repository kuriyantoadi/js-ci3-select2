public function get_categories_by_brand($brandId) {
    // Lakukan query ke database untuk mengambil data kategori berdasarkan brand
    $this->db->select('*');
    $this->db->from('tb_kategori_barang');
    $this->db->where('id_brand', $brandId);
    $query = $this->db->get();
    
    // Mengembalikan hasil query dalam bentuk array
    return $query->result_array();
  }

  public function get_all_brands() {
    return $this->db->get('tb_brand')->result_array();
  }
