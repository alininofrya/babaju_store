<section class="static-page checkout-page">
    <h2>Lanjutkan ke Pembayaran</h2>
    <p>Terima kasih telah berbelanja di Babaju!</p>

    <?php
    // Ambil pesan dari sesi jika ada (misal dari proses pembayaran gagal)
    if (isset($_SESSION['message'])) {
        echo '<div class="notification-message" style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; margin-bottom: 20px; border-radius: 5px;">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']); // Hapus pesan setelah ditampilkan
    }
    ?>

    <?php if (empty($cart_items)): ?>
        <p>Keranjang Anda kosong atau tidak ada produk yang dipilih untuk pembayaran.</p>
        <div class="empty-cart-message">
            <a href="<?= BASEURL ?>" class="submit-btn" style="width: auto; padding: 10px 25px; margin-top: 20px;">Jelajahi Produk</a>
        </div>
    <?php else: ?>
        <div class="checkout-summary">
            <h3>Ringkasan Pesanan Anda:</h3>
            <ul class="order-list">
                <?php foreach ($cart_items as $item): ?>
                    <li>
                        <?= htmlspecialchars($item['name']) ?> (<?= htmlspecialchars($item['quantity']) ?>x) - Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <h3 class="total-checkout">Total yang Harus Dibayar: Rp <?= number_format($total_harga, 0, ',', '.') ?></h3>
        </div>

        <div class="payment-form">
            <h3>Informasi Pembayaran:</h3>
            <form action="<?= BASEURL ?>/?page=prosesPembayaran" method="POST"> <div class="form-group">
                    <label for="name">Nama Lengkap:</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="address">Alamat Pengiriman:</label>
                    <textarea id="address" name="address" rows="4" required><?= htmlspecialchars($_POST['address'] ?? '') ?></textarea>
                </div>
                <div class="form-group">
                    <label for="payment_method">Metode Pembayaran:</label>
                    <select id="payment_method" name="payment_method" required>
                        <option value="">Pilih Metode</option>
                        <option value="transfer" <?= (isset($_POST['payment_method']) && $_POST['payment_method'] == 'transfer') ? 'selected' : '' ?>>Transfer Bank</option>
                        <option value="ewallet" <?= (isset($_POST['payment_method']) && $_POST['payment_method'] == 'ewallet') ? 'selected' : '' ?>>E-Wallet</option>
                        <option value="cod" <?= (isset($_POST['payment_method']) && $_POST['payment_method'] == 'cod') ? 'selected' : '' ?>>Cash On Delivery (COD)</option>
                    </select>
                </div>
                <button type="submit" class="submit-btn">Konfirmasi Pembayaran</button>
            </form>
        </div>
    <?php endif; ?>

    <div style="margin-top: 30px;">
        <a href="<?= BASEURL ?>/?page=keranjang" class="back-link">Kembali ke Keranjang</a>
    </div>
</section>

<style>
    /* Gaya spesifik untuk halaman checkout */
    .checkout-page {
        text-align: center;
    }
    .checkout-page h2 {
        margin-bottom: 1.5rem;
    }
    .checkout-page p {
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }
    .checkout-summary {
        margin-top: 30px;
        text-align: left;
        background-color: #f0f0f0;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 30px;
    }
    .checkout-summary h3 {
        color: var(--secondary-color);
        margin-bottom: 15px;
    }
    .order-list {
        list-style: none;
        padding: 0;
        margin-bottom: 20px;
    }
    .order-list li {
        padding: 8px 0;
        border-bottom: 1px dashed #e0e0e0;
        font-size: 1.05rem;
        color: var(--text-dark);
    }
    .order-list li:last-child {
        border-bottom: none;
    }
    .total-checkout {
        text-align: right;
        color: var(--primary-color) !important;
        font-size: 2.2rem !important;
        margin-top: 20px;
    }
    .payment-form {
        text-align: left;
    }
    .payment-form h3 {
        color: var(--secondary-color);
        margin-bottom: 15px;
    }
    /* Menambahkan gaya untuk form group */
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }
    .form-group input[type="text"],
    .form-group textarea,
    .form-group select {
        width: calc(100% - 20px); /* Kurangi padding */
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1rem;
    }
    .form-group textarea {
        resize: vertical;
    }
    .notification-message {
        text-align: center;
        font-weight: bold;
    }
</style>