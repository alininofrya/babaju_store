<?php
// File: babaju/Controllers/ProductController.php

require_once 'Models/Product.php';
require_once 'Models/Category.php';

class ProductController {
    protected $productModel;
    protected $categoryModel;

    public function __construct() {
        $this->productModel = new Product();
        $this->categoryModel = new Category();
    }

    public function index() {
        $products = $this->productModel->getAllProducts();
        $productsData = $products->fetchAll(PDO::FETCH_ASSOC);

        $data['products'] = $productsData;
        $data['title'] = 'Koleksi Babaju';

        $this->view('templates/header', $data);
        $this->view('products/index', $data);
        $this->view('templates/footer');
    }

    public function detail($id) {
        $product = $this->productModel->getProductById($id);

        if (!$product) {
            echo "Produk tidak ditemukan!";
            return;
        }

        $data['product'] = $product;
        $data['title'] = $product['name'] . ' - Babaju';

        $this->view('templates/header', $data);
        $this->view('products/detail', $data);
        $this->view('templates/footer');
    }

    public function create() {
        $categories = $this->categoryModel->getAllCategories();
        $data['categories'] = $categories;
        $data['title'] = 'Tambah Produk Baru';

        $this->view('templates/header', $data);
        $this->view('products/create', $data);
        $this->view('templates/footer');
    }


    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->productModel->name = $_POST['name'] ?? '';
            $this->productModel->description = $_POST['description'] ?? '';
            $this->productModel->price = $_POST['price'] ?? 0.00;
            $this->productModel->image_url = $_POST['image_url'] ?? '';
            $this->productModel->category_id = $_POST['category_id'] ?? null;
            $this->productModel->stock_quantity = $_POST['stock_quantity'] ?? 0;

            if ($this->productModel->createProduct()) {
                header('Location: ' . BASEURL);
                exit;
            } else {
                echo "Gagal menambahkan produk.";
            }
        } else {
            header('Location: ' . BASEURL . '/?page=tambahProdukForm');
            exit;
        }
    }
public function edit($id) {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            $_SESSION['message'] = "Anda tidak memiliki izin untuk mengedit produk.";
            header('Location: ' . BASEURL . '/?page=login');
            exit;
        }

        $product = $this->productModel->getProductById($id);
        if (!$product) {
            $_SESSION['message'] = "Produk tidak ditemukan!";
            header('Location: ' . BASEURL . '/?page=produk');
            exit;
        }

        $categories = $this->categoryModel->getAllCategories();

        $data['product'] = $product;
        $data['categories'] = $categories;
        $data['title'] = 'Edit Produk: ' . $product['name'] . ' - Babaju';

        $this->view('templates/header', $data);
        $this->view('products/edit', $data);
        $this->view('templates/footer');
    }

    public function update() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin' || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['message'] = "Anda tidak memiliki izin untuk memperbarui produk atau metode request tidak valid.";
            header('Location: ' . BASEURL . '/?page=login');
            exit;
        }

        $id = $_POST['id'] ?? null;
        $name = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $price = $_POST['price'] ?? 0;
        $image_url = trim($_POST['image_url'] ?? ''); // <--- Kembali ke image_url
        $category_id = $_POST['category_id'] ?? null;
        $stock_quantity = $_POST['stock_quantity'] ?? 0;

        if (empty($id) || empty($name) || empty($price) || empty($category_id) || !isset($stock_quantity)) {
            $_SESSION['message'] = "Semua kolom wajib diisi!";
            header('Location: ' . BASEURL . '/?page=editProduk&id=' . $id);
            exit;
        }

        $this->productModel->id = $id;
        $this->productModel->name = $name;
        $this->productModel->description = $description;
        $this->productModel->price = $price;
        $this->productModel->image_url = $image_url; // <--- Kembali ke image_url
        $this->productModel->category_id = $category_id;
        $this->productModel->stock_quantity = $stock_quantity;

        if ($this->productModel->updateProduct()) {
            $_SESSION['message'] = "Produk berhasil diperbarui!";
            header('Location: ' . BASEURL . '/?page=detailProduk&id=' . $id);
            exit;
        } else {
            $_SESSION['message'] = "Gagal memperbarui produk. Tidak ada perubahan atau terjadi kesalahan.";
            header('Location: ' . BASEURL . '/?page=editProduk&id=' . $id);
            exit;
        }
    }

    public function hapus($id) {
        if ($this->productModel->deleteProduct($id)) {
            header('Location: ' . BASEURL);
            exit;
        } else {
            echo "Gagal menghapus produk.";
        }
    }

    public function getProductsByCategory($categoryId) {
        if (!$categoryId) {
            $_SESSION['message'] = "ID Kategori tidak valid.";
            header('Location: ' . BASEURL . '/?page=kategori');
            exit;
        }

        $products = $this->productModel->getProductsByCategoryId($categoryId);
        $productsData = $products->fetchAll(PDO::FETCH_ASSOC);
        $category = $this->categoryModel->getCategoryById($categoryId);

        $data['products'] = $productsData;
        $data['category_name'] = $category['name'] ?? 'Semua Kategori';
        $data['title'] = 'Koleksi ' . $data['category_name'] . ' - Babaju';

        $this->view('templates/header', $data);
        $this->view('products/index', $data);
        $this->view('templates/footer');
    }

    public function kontak() {
        $data['title'] = 'Kontak Kami - Babaju';
        $this->view('templates/header', $data);
        $this->view('pages/contact');
        $this->view('templates/footer');
    }

    public function keranjang() {
        $data['title'] = 'Keranjang Belanja - Babaju';
        $data['cart_items'] = $_SESSION['cart'] ?? [];
        $data['total_harga'] = 0;

        foreach ($data['cart_items'] as $item) {
            $data['total_harga'] += $item['price'] * $item['quantity'];
        }

        $this->view('templates/header', $data);
        $this->view('pages/cart', $data);
        $this->view('templates/footer');
    }

    public function tambahKeKeranjang($productId) {
        if ($productId) {
            $product = $this->productModel->getProductById($productId);
            if ($product) {
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }

                $found = false;
                foreach ($_SESSION['cart'] as $key => $item) {
                    if ($item['id'] == $productId) {
                        $_SESSION['cart'][$key]['quantity']++;
                        $found = true;
                        break;
                    }
                }

                if (!$found) {
                    $_SESSION['cart'][] = [
                        'id' => $product['id'],
                        'name' => $product['name'],
                        'price' => $product['price'],
                        'image_url' => $product['image_url'],
                        'quantity' => 1
                    ];
                }

                $_SESSION['message'] = "Produk '" . htmlspecialchars($product['name']) . "' berhasil ditambahkan ke keranjang.";
            } else {
                $_SESSION['message'] = "Produk tidak ditemukan.";
            }
        } else {
            $_SESSION['message'] = "ID produk tidak valid.";
        }

        header('Location: ' . BASEURL . '/?page=keranjang');
        exit;
    }

    public function hapusDariKeranjang($productId) {
        if ($productId && isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['id'] == $productId) {
                    unset($_SESSION['cart'][$key]);
                    $_SESSION['cart'] = array_values($_SESSION['cart']);
                    $_SESSION['message'] = "Produk berhasil dihapus dari keranjang.";
                    break;
                }
            }
        } else {
            $_SESSION['message'] = "Produk tidak ditemukan di keranjang.";
        }
        header('Location: ' . BASEURL . '/?page=keranjang');
        exit;
    }

    // Method ini dipanggil ketika "Lanjutkan ke Pembayaran" diklik dari keranjang
    public function pilihUntukPembayaran() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['selected_products'])) {
            $selectedProductIds = $_POST['selected_products'];
            $selectedItems = [];

            if (isset($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $item) {
                    if (in_array($item['id'], $selectedProductIds)) {
                        $selectedItems[] = $item;
                    }
                }
            }

            // Simpan item yang dipilih ke sesi terpisah
            $_SESSION['selected_for_checkout'] = $selectedItems;
            $_SESSION['message'] = "Produk yang dipilih siap untuk pembayaran.";

            header('Location: ' . BASEURL . '/?page=pembayaran'); // Arahkan ke halaman pembayaran
            exit;

        } else {
            $_SESSION['message'] = "Tidak ada produk yang dipilih untuk pembayaran.";
            header('Location: ' . BASEURL . '/?page=keranjang');
            exit;
        }
    }

    // Method ini menampilkan halaman pembayaran
    public function pembayaran() {
        $data['title'] = 'Pembayaran - Babaju';
        // Gunakan item yang dipilih jika ada, jika tidak, gunakan semua item di keranjang
        $data['cart_items'] = $_SESSION['selected_for_checkout'] ?? $_SESSION['cart'] ?? [];
        $data['total_harga'] = 0;

        foreach ($data['cart_items'] as $item) {
            $data['total_harga'] += $item['price'] * $item['quantity'];
        }

        $this->view('templates/header', $data);
        $this->view('pages/checkout', $data); // Memuat view checkout.php
        $this->view('templates/footer');
    }

    public function prosesPembayaran() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama = $_POST['name'] ?? '';
            $alamat = $_POST['address'] ?? '';
            $metode_pembayaran = $_POST['payment_method'] ?? '';

            $items_to_checkout = $_SESSION['selected_for_checkout'] ?? [];
            $total_harga = 0;
            foreach ($items_to_checkout as $item) {
                $total_harga += $item['price'] * $item['quantity'];
            }

            if ($total_harga > 0 && !empty($nama) && !empty($alamat) && !empty($metode_pembayaran)) {
                if (isset($_SESSION['selected_for_checkout'])) {
                    $checkedOutProductIds = array_column($_SESSION['selected_for_checkout'], 'id');
                    if (isset($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $key => $item) {
                            if (in_array($item['id'], $checkedOutProductIds)) {
                                unset($_SESSION['cart'][$key]);
                            }
                        }
                        $_SESSION['cart'] = array_values($_SESSION['cart']);
                    }
                    unset($_SESSION['selected_for_checkout']);
                }

                $_SESSION['message'] = "Pembayaran sebesar Rp " . number_format($total_harga, 0, ',', '.') . " berhasil dikonfirmasi! Pesanan Anda sedang diproses.";
                header('Location: ' . BASEURL . '/?page=orderSuccess');
                exit;
            } else {
                $_SESSION['message'] = "Pembayaran gagal. Pastikan data lengkap dan keranjang tidak kosong.";
                header('Location: ' . BASEURL . '/?page=pembayaran');
                exit;
            }
        } else {
            $_SESSION['message'] = "Metode request tidak valid untuk pembayaran.";
            header('Location: ' . BASEURL . '/?page=pembayaran');
            exit;
        }
    }

    public function view($view, $data = []) {
        extract($data);
        require_once 'Views/' . $view . '.php';
    }

    
}