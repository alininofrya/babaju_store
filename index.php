<?php
// File: babaju/index.php

session_start(); // Pastikan ini ada di baris paling atas!

ini_set('display_errors', 1); // Aktifkan ini untuk debugging
ini_set('display_startup_errors', 1); // Aktifkan ini untuk debugging
error_reporting(E_ALL); // Aktifkan ini untuk debugging

// Definisi BASEURL (SESUAIKAN DENGAN PATH SERVER ANDA)
define('BASEURL', '/babaju'); // <-- SESUAIKAN INI SESUAI LOKASI PROYEK ANDA!

// Autoloading: Hanya untuk Models dan Controllers
spl_autoload_register(function ($class_name) {
    if (file_exists('Models/' . $class_name . '.php')) {
        require_once 'Models/' . $class_name . '.php';
    } elseif (file_exists('Controllers/' . $class_name . '.php')) {
        require_once 'Controllers/' . $class_name . '.php';
    }
});

// Memuat ProductController dan CategoryController secara eksplisit
require_once 'Controllers/ProductController.php';
require_once 'Controllers/CategoryController.php';

if (!isset($_GET['page'])) {
 
    $controller = new ProductController();
    $controller->index();
}elseif (isset($_GET['page']) && $_GET['page'] == "login") {
    $controller = new AuthController();
    $controller->index();
}elseif (isset($_GET['page']) && $_GET['page'] == "logout") {
    $controller = new AuthController();
    $controller->logout();
}elseif (isset($_GET['page']) && $_GET['page'] == "login_proses") {
 
    $controller = new AuthController();
    $controller->login();
} elseif (isset($_GET['page']) && $_GET['page'] == "detailProduk") {
    // Menampilkan detail produk
    $controller = new ProductController();
    $id = $_GET['id'] ?? null;
    $controller->detail($id);
} elseif (isset($_GET['page']) && $_GET['page'] == "tambahProdukForm" ) {
    if(isset($_SESSION['user_id'])){
        // Menampilkan form tambah produk
        $controller = new ProductController();
        $controller->create();
    }else {
        $controller = new AuthController();
        $controller->index();
    }
} elseif (isset($_GET['page']) && $_GET['page'] == "simpanProduk") {
    // Memproses data dari form tambah produk
    $controller = new ProductController();
    $controller->store();
} elseif (isset($_GET['page']) && $_GET['page'] == "hapusProduk") {
    // Hapus data produk
    $controller = new ProductController();
    $id = $_GET['id'] ?? null;
    $controller->hapus($id);
} elseif (isset($_GET['page']) && $_GET['page'] == "kategori") {
    // Menampilkan daftar kategori
    $controller = new CategoryController();
    $controller->index();
} elseif (isset($_GET['page']) && $_GET['page'] == "produkByKategori") { 
    $controller = new ProductController();
    $categoryId = $_GET['id'] ?? null;
    $controller->getProductsByCategory($categoryId);
} elseif (isset($_GET['page']) && $_GET['page'] == "kontak") {
    // Menampilkan halaman kontak
    $controller = new ProductController();
    $controller->kontak();
} elseif (isset($_GET['page']) && $_GET['page'] == "keranjang") {
    // Menampilkan halaman keranjang belanja
    $controller = new ProductController();
    $controller->keranjang();
} elseif (isset($_GET['page']) && $_GET['page'] == "tambahKeranjang") {
    // Menambahkan produk ke keranjang (simulasi)
    $controller = new ProductController();
    $productId = $_GET['id'] ?? null;
    $controller->tambahKeKeranjang($productId);
} elseif (isset($_GET['page']) && $_GET['page'] == "hapusDariKeranjang") {
    // Menghapus produk dari keranjang
    $controller = new ProductController();
    $productId = $_GET['id'] ?? null;
    $controller->hapusDariKeranjang($productId);
} elseif (isset($_GET['page']) && $_GET['page'] == "pilihUntukPembayaran") {
    // Memproses produk yang dipilih untuk pembayaran
    $controller = new ProductController();
    $controller->pilihUntukPembayaran();
} elseif (isset($_GET['page']) && $_GET['page'] == "pembayaran") {
    // Menuju halaman pembayaran
    if(isset($_SESSION['user_id'])){
        // Menampilkan form tambah produk
        $controller = new ProductController();
        $controller->pembayaran();
    }else {
        $controller = new AuthController();
        $controller->index();
    }
} elseif (isset($_GET['page']) && $_GET['page'] == "editProduk") {
    $controller = new ProductController();
    $id = $_GET['id'] ?? null; // Pastikan ini menangkap ID dari URL
    // Panggil method edit() dari ProductController
    $controller->edit($id);

} elseif (isset($_GET['page']) && $_GET['page'] == "updateProduk") {
    $controller = new ProductController();
    $controller->update();    
} elseif (isset($_GET['page']) && $_GET['page'] == "prosesPembayaran") {
    // Memproses konfirmasi pembayaran
    $controller = new ProductController();
    $controller->prosesPembayaran();
} elseif (isset($_GET['page']) && $_GET['page'] == "orderSuccess") {
    // Menampilkan halaman sukses pembayaran
    $controller = new ProductController();
    $controller->view('pages/order_success', ['title' => 'Pembayaran Berhasil']);
}
else {
    echo "Halaman tidak ditemukan!";
}
?>