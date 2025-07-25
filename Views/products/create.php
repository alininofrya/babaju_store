<section class="add-product-form">
    <h2>Tambah Produk Baru</h2>
    <form action="<?= BASEURL ?>/?page=simpanProduk" method="POST">
        <div class="form-group">
            <label for="name">Nama Produk:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Deskripsi:</label>
            <textarea id="description" name="description" rows="5"></textarea>
        </div>
        <div class="form-group">
            <label for="price">Harga (Rp):</label>
            <input type="number" id="price" name="price" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="image_url">Nama File Gambar:</label>
            <input type="text" id="image_url" name="image_url" placeholder="misal: baju_kemeja.jpg">
            <small>Pastikan file gambar sudah ada di folder public/images/</small>
        </div>
        <div class="form-group">
            <label for="category_id">Kategori:</label>
            <select id="category_id" name="category_id">
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">Tidak ada kategori tersedia</option>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="stock_quantity">Stok:</label>
            <input type="number" id="stock_quantity" name="stock_quantity" required>
        </div>
        <button type="submit" class="submit-btn">Tambah Produk</button>
    </form>
    <div style="margin-top: 20px;">
        <a href="<?= BASEURL ?>" class="back-link">Kembali ke Koleksi</a>
    </div>
</section>