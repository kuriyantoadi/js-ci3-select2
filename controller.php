public function barang_v2()
    {
        $this->load->view('admin/barang_v2');
    }

    public function getCategoriesByBrand($brandId) {
        // Mengambil data kategori dari model berdasarkan brand
        $categories = $this->M_admin->get_categories_by_brand($brandId);
        
        // Mengirim data dalam format JSON
        echo json_encode(array('success' => true, 'categories' => $categories));
    }

    public function getBrands() {
        // Panggil fungsi dalam model untuk mengambil daftar brand
        $brands = $this->M_admin->get_all_brands();

        // Jika data brand berhasil diambil
        if (!empty($brands)) {
            // Kembalikan daftar brand dalam format JSON
            echo json_encode(array('success' => true, 'brands' => $brands));
        } else {
            // Jika tidak ada data brand yang ditemukan
            echo json_encode(array('success' => false, 'message' => 'Tidak ada data brand yang ditemukan.'));
        }
    }
