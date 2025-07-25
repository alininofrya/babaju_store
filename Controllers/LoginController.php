<?php
require_once 'Models/Category.php';

class LoginController {
    protected $categoryModel;

    public function __construct() {
        $this->categoryModel = new Category();
    }

    public function index() {
        $categories = $this->categoryModel->getAllCategories();
        $categoriesData = $categories->fetchAll(PDO::FETCH_ASSOC);

        $data['categories'] = $categoriesData;
        $data['title'] = 'Daftar Kategori - Babaju';

        $this->view('templates/header', $data);
        $this->view('categories/index', $data); 
        $this->view('templates/footer');
    }

    // Metode helper untuk memuat file View
    public function view($view, $data = []) {
        extract($data);
        require_once 'Views/' . $view . '.php';
    }
}