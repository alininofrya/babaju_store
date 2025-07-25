<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Babaju Store' ?></title>
    <link rel="stylesheet" href="<?= BASEURL ?>/public/css/style.css">
</head>

<body>
    <header class="main-header">
        <div class="container">
            <div class="logo">
                <a href="<?= BASEURL ?>">
                    <h1>Babaju</h1>
                </a>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="<?= BASEURL ?>">Produk</a></li>

                    <?php
                    if (isset($_SESSION['user_id']) && $_SESSION['role'] == "admin") { ?>
                        <li><a href="<?= BASEURL ?>/?page=tambahProdukForm">Tambah Produk</a></li>
                    <?php } ?>

                    <li><a href="<?= BASEURL ?>/?page=kategori">Kategori</a></li>

                    <li><a href="<?= BASEURL ?>/?page=kontak">Kontak</a></li>

                    <?php
                    if (isset($_SESSION['user_id']) && $_SESSION['role'] == "user") { ?>
                        <li><a href="<?= BASEURL ?>/?page=keranjang">Keranjang</a></li>
                    <?php } ?>


                    <?php
                    if (isset($_SESSION['user_id'])) { ?>
                        <li>
                            <p
                                style="font-weight:bold; font-size:14px;background:#fff; color:red; padding:3px; border-radius:4px;">
                                <?= $_SESSION['username']; ?></p>
                            <a href="<?= BASEURL ?>/?page=logout">Logout</a>
                        </li>
                    <?php } ?>

                </ul>
            </nav>
        </div>
    </header>
    <main class="container">