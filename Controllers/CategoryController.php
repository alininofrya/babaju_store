<?php
// File: babaju/Controllers/CategoryController.php

require_once 'Models/Category.php';

class CategoryController {
    protected $categoryModel;

    public function __construct() {
        $this->categoryModel = new Category();
    }

    public function index() {
        $categories = $this->categoryModel->getAllCategories(); // Ini sudah mengembalikan array

        // Hapus baris di bawah ini karena $categories sudah merupakan array
        // $categoriesData = $categories->fetchAll(PDO::FETCH_ASSOC);

        $data['categories'] = $categories; // Langsung gunakan $categories
        $data['title'] = 'Daftar Kategori - Babaju';

        // Pastikan Anda memiliki method view() di sini jika ini bukan kelas dasar Controller
        // Jika Anda memiliki Base Controller, pastikan CategoryController meng-extend-nya
        $this->view('templates/header', $data);
        $this->view('categories/index', $data);
        $this->view('templates/footer');
    }

    // Pastikan method view ini ada jika CategoryController tidak meng-extend Base Controller
    public function view($view, $data = []) {
        extract($data);
        require_once 'Views/' . $view . '.php';
    }
}