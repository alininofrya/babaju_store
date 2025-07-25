<section class="product-detail">
    <div class="detail-container">
        <div class="product-image">
            <img src="<?= BASEURL ?>/public/images/<?= $product['image_url'] ?>" alt="<?= $product['name'] ?>">
        </div>
        <div class="product-info">
            <h2><?= $product['name'] ?></h2>
            <p class="category"><?= $product['category_name'] ?></p>
            <p class="price">Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
            <div class="description">
                <h3>Deskripsi:</h3>
                <p><?= $product['description'] ?></p>
            </div>
            <p class="stock">Stok Tersedia: <?= $product['stock_quantity'] ?></p>
            <a href="<?= BASEURL ?>" class="back-link">Kembali ke Koleksi</a>
        </div>
    </div>
</section>