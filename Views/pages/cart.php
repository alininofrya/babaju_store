<section class="static-page cart-page">
    <h2>Keranjang Belanja Anda</h2>

    <?php
    if (isset($_SESSION['message'])) {
        echo '<div class="notification-message" style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; margin-bottom: 20px; border-radius: 5px;">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']);
    }
    ?>

    <?php if (empty($cart_items)): ?>
        <p class="empty-cart-message-text">Belum ada item di keranjang belanja Anda saat ini.</p>
        <div class="empty-cart-message">
            <p>Ayo mulai belanja! Temukan pakaian favorit Anda di koleksi kami.</p>
            <a href="<?= BASEURL ?>" class="submit-btn" style="width: auto; padding: 10px 25px; margin-top: 20px;">Jelajahi Produk</a>
        </div>
    <?php else: ?>
        <form action="<?= BASEURL ?>/?page=pilihUntukPembayaran" method="POST">
            <div class="cart-items-container">
                <?php foreach ($cart_items as $item): ?>
                    <div class="cart-item">
                        <input type="checkbox" name="selected_products[]" value="<?= $item['id'] ?>" checked class="item-checkbox">
                        <img src="<?= BASEURL ?>/public/images/<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                        <div class="item-details">
                            <h4><?= htmlspecialchars($item['name']) ?></h4>
                            <p>Harga: Rp <?= number_format($item['price'], 0, ',', '.') ?></p>
                            <p>Jumlah: <?= htmlspecialchars($item['quantity']) ?></p>
                            <p>Subtotal: Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></p>
                        </div>
                        <a href="<?= BASEURL ?>/?page=hapusDariKeranjang&id=<?= $item['id'] ?>"
                           onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang?')"
                           class="remove-item-btn">Hapus</a>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="cart-summary">
                <h3>Total Harga: Rp <?= number_format($total_harga, 0, ',', '.') ?></h3>
                <button type="submit" class="submit-btn" style="width: auto; padding: 12px 30px; margin-top: 20px; display: inline-block;">Lanjutkan ke Pembayaran</button>
                <a href="<?= BASEURL ?>" class="back-link" style="display: block; margin-top: 15px;">Lanjutkan Belanja</a>
            </div>
        </form>
    <?php endif; ?>
</section>

<style>
    /* Gaya tambahan untuk tampilan item keranjang */
    .empty-cart-message-text {
        text-align: center;
        margin-bottom: 20px;
        font-size: 1.1em;
        color: #666;
    }
    .cart-items-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin-top: 30px;
    }
    .cart-item {
        display: flex;
        align-items: center;
        background-color: #f9f9f9;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        position: relative; /* Untuk posisi tombol hapus */
    }
    .cart-item img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 5px;
        margin-right: 20px;
    }
    .cart-item .item-details {
        flex-grow: 1;
    }
    .cart-item .item-details h4 {
        margin: 0 0 5px 0;
        color: var(--primary-color);
        font-size: 1.4rem;
    }
    .cart-item .item-details p {
        margin: 5px 0;
        font-size: 1rem;
        color: #555;
    }
    .cart-item .item-details p:last-of-type {
        font-weight: bold;
        color: var(--text-dark);
    }
    .cart-summary {
        text-align: right;
        margin-top: 40px;
        border-top: 1px solid var(--border-color);
        padding-top: 20px;
    }
    .cart-summary h3 {
        color: var(--primary-color);
        font-size: 2rem;
        margin-bottom: 15px;
    }
    /* Gaya untuk tombol Hapus */
    .remove-item-btn {
        background-color: #dc3545; /* Merah */
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 0.9em;
        text-decoration: none;
        transition: background-color 0.3s ease;
        margin-left: 15px; /* Jarak dari detail item */
    }
    .remove-item-btn:hover {
        background-color: #c82333;
    }
    /* Gaya untuk checkbox */
    .item-checkbox {
        margin-right: 15px;
        width: 20px;
        height: 20px;
        cursor: pointer;
    }
</style>