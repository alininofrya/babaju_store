<section class="product-list">
    <h2>Koleksi Pakaian Terbaru</h2>
    <?php if (empty($products)): ?>
        <p>Belum ada produk saat ini.</p>
    <?php else: ?>
        <div class="product-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <a href="<?= BASEURL ?>/?page=detailProduk&id=<?= $product['id'] ?>">
                        <img src="<?= BASEURL ?>/public/images/<?= $product['image_url'] ?>" alt="<?= $product['name'] ?>">
                        <h3><?= $product['name'] ?></h3>
                        <p class="category"><?= $product['category_name'] ?></p>
                        <p class="price">Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
                    </a>
                    <div class="product-actions">

                            <a href="<?= BASEURL ?>/?page=tambahKeranjang&id=<?= $product['id'] ?>" class="add-to-cart-btn">Tambah
                                ke Keranjang</a>

                        <?php
                        if (isset($_SESSION['user_id']) && $_SESSION['role'] == "admin") { ?>
                            <a href="<?= BASEURL ?>/?page=editProduk&id=<?= $product['id'] ?>" class="action-btn edit-btn">Edit</a>
                            <a href="<?= BASEURL ?>/?page=hapusProduk&id=<?= $product['id'] ?>"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"
                                class="action-btn delete-btn">Hapus</a>
                        <?php } ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<style>
    /* Gaya untuk tombol aksi di product-card */
    .product-actions {
        display: flex;
        justify-content: center;
        gap: 10px;
        /* Jarak antar tombol */
        margin-top: 10px;
        padding: 0 15px;
        /* Sesuaikan padding */
    }

    .product-actions .add-to-cart-btn {
        flex-grow: 1;
        /* Biar tombol keranjang lebih lebar */
        padding: 8px 15px;
        /* Ukuran tombol sedikit lebih kecil */
        font-size: 0.95rem;
        background: var(--accent-color);
        /* Pastikan ini didefinisikan di style.css */
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        transition: background 0.3s ease;
    }

    .product-actions .add-to-cart-btn:hover {
        background: #4caa50ff;
        /* Warna hover untuk tombol tambah keranjang */
    }

    .product-actions .action-btn {
        /* Gaya umum untuk tombol aksi */
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 0.95rem;
        transition: background-color 0.3s ease;
        text-align: center;
        text-decoration: none;
        flex-shrink: 0;
    }

    .product-actions .action-btn.edit-btn {
        /* Gaya khusus untuk tombol Edit */
        background-color: orange;
        /* Atau warna lain yang Anda inginkan */
    }

    .product-actions .action-btn.edit-btn:hover {
        background-color: darkorange;
    }

    .product-actions .action-btn.delete-btn {
        background-color: var(--delete-color);
        /* Ambil dari style.css, atau definisikan */
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 0.95rem;
        transition: background-color 0.3s ease;
        text-align: center;
        text-decoration: none;
        /* Pastikan tidak ada underline */
        flex-shrink: 0;
        /* Jangan menyusut */
    }

    .product-actions .action-btn.delete-btn:hover {
        background-color: #c82333;
    }
</style>