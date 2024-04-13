<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Kategori</title>
    <!-- Sertakan jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<!-- Pemilihan Brand -->
<label for="brandSelect">Pilih Brand:</label>
<select id="brandSelect">
    <!-- Opsi akan ditambahkan secara dinamis melalui JavaScript -->
</select>

<!-- Pemilihan Kategori -->
<label for="categorySelect">Pilih Kategori:</label>
<select id="categorySelect">
    <!-- Opsi akan ditambahkan secara dinamis melalui JavaScript -->
</select>

<!-- Sertakan file JavaScript untuk mengambil dan menampilkan data kategori -->
<script>
// Fungsi untuk mengambil data brand dari controller CodeIgniter menggunakan AJAX
function getBrands() {
    $.ajax({
        url: '<?php echo base_url('admin/getBrands'); ?>',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Jika pengambilan data berhasil
            if (response.success) {
                // Menampilkan data brand dalam dropdown select
                displayBrands(response.brands);
            } else {
                console.error('Gagal mengambil data brand.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Terjadi kesalahan saat mengambil data brand:', error);
        }
    });
}

// Fungsi untuk menampilkan data brand dalam dropdown select
function displayBrands(brands) {
    var brandSelect = document.getElementById('brandSelect');
    brandSelect.innerHTML = ''; // Menghapus opsi sebelumnya

    brands.forEach(function(brand) {
        var option = document.createElement('option');
        option.value = brand.id_brand;
        option.textContent = brand.nama_brand;
        brandSelect.appendChild(option);
    });
}

// Event listener untuk memanggil fungsi getBrands saat dokumen selesai dimuat
document.addEventListener('DOMContentLoaded', function() {
    getBrands();
});

// Fungsi untuk mengambil data kategori barang dari controller CodeIgniter menggunakan AJAX
function getCategoriesByBrand(brandId) {
    $.ajax({
        url: '<?php echo base_url('admin/getCategoriesByBrand/'); ?>' + brandId,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Jika pengambilan data berhasil
            if (response.success) {
                // Menampilkan data kategori dalam dropdown select
                displayCategories(response.categories);
            } else {
                console.error('Gagal mengambil data kategori.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Terjadi kesalahan saat mengambil data kategori:', error);
        }
    });
}

// Fungsi untuk menampilkan data kategori dalam dropdown select
function displayCategories(categories) {
    var categorySelect = document.getElementById('categorySelect');
    categorySelect.innerHTML = ''; // Menghapus opsi sebelumnya

    categories.forEach(function(category) {
        var option = document.createElement('option');
        option.value = category.id_kategori_barang;
        option.textContent = category.nama_kategori_barang;
        categorySelect.appendChild(option);
    });
}

// Event listener untuk memanggil fungsi getCategoriesByBrand saat pemilihan brand berubah
document.getElementById('brandSelect').addEventListener('change', function() {
    var selectedBrandId = this.value;
    if (selectedBrandId) {
        getCategoriesByBrand(selectedBrandId);
    } else {
        // Jika tidak ada brand yang dipilih, kosongkan dropdown kategori
        var categorySelect = document.getElementById('categorySelect');
        categorySelect.innerHTML = '';
    }
});
</script>

</body>
</html>
