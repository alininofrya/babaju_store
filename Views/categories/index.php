<section class="static-page category-page">
    <h2>Daftar Kategori Pakaian</h2>

    <?php if (empty($categories)): ?>
        <p class="empty-category-message">Belum ada kategori yang tersedia.</p>
    <?php else: ?>
        <div class="category-buttons-container">
            <?php foreach ($categories as $category): ?>
                <a href="<?= BASEURL ?>/?page=produkByKategori&id=<?= htmlspecialchars($category['id']) ?>" class="category-button">
                    <?= htmlspecialchars($category['name']) ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<style>
    .category-page {
        text-align: center;
        padding: 50px 20px;
    }
    .category-page h2 {
        font-family: 'Inter', 'Segoe UI', sans-serif;
        font-size: 2.5rem;
        color: var(--primary-color);
        margin-bottom: 40px;
    }
    .category-buttons-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 30px;
        margin-top: 30px;
    }
    .category-button {
        display: inline-flex; /* Use flexbox for vertical alignment */
        align-items: center; /* Center content vertically */
        justify-content: center; /* Center content horizontally */
        background-color: var(--button-bg-color); /* Atau warna terang lainnya */
        color: var(--text-dark); /* Warna teks agar terlihat di latar belakang terang */
        text-decoration: none;
        padding: 20px 40px;
        border-radius: 10px;
        font-size: 1.5rem;
        font-weight: bold;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        min-width: 180px; /* Lebar minimum untuk tombol */
        height: 100px; /* Tinggi tetap untuk tombol */
        text-align: center;
    }
    .category-button:hover {
        background-color: var(--primary-color); /* Warna hover lebih gelap */
        color: white;
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
    .empty-category-message {
        font-size: 1.2em;
        color: #888;
        margin-top: 50px;
    }

</style>