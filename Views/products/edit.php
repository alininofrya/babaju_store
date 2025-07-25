<div class="babaju-edit-container mt-4">
    <style>
        .babaju-edit-container {
            max-width: 800px; /* Batasi lebar container agar form tidak terlalu melebar di layar besar */
            margin: 40px auto; /* Memberikan jarak atas/bawah dan posisi tengah */
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Tambah bayangan agar terlihat lebih 'mengambang' */
        }

        .babaju-edit-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 2em;
            font-weight: 600;
        }

        /* Gaya untuk setiap grup form (label + input) */
        .babaju-form-group { /* Mengganti .mb-3 */
            margin-bottom: 1.5rem; /* Jarak antara setiap elemen form */
        }

        .babaju-form-label { /* Mengganti .form-label */
            display: block; /* Membuat label berada di atas input */
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #555;
        }

        .babaju-form-control { /* Mengganti .form-control dan .form-select */
            width: 100%; /* Memastikan input dan select memenuhi lebar parent */
            padding: 10px 15px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 1rem;
            box-sizing: border-box; /* Pastikan padding dan border termasuk dalam lebar total */
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .babaju-form-control:focus {
            border-color: #80bdff; /* Warna border saat fokus (contoh warna biru Bootstrap) */
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Bayangan saat fokus */
            outline: none; /* Hapus outline default browser */
        }

        textarea.babaju-form-control {
            resize: vertical; /* Izinkan user mengubah ukuran tinggi textarea */
            min-height: 80px; /* Tinggi minimum untuk textarea */
        }

        /* Gaya untuk tombol */
        .babaju-btn { /* Mengganti .btn */
            display: inline-block; /* Agar tombol bisa berdampingan */
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: 500;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
            margin-right: 10px; /* Jarak antar tombol */
        }

        .babaju-btn-primary { /* Mengganti .btn-primary */
            background-color: #007bff; /* Warna biru untuk tombol utama */
            color: white;
            border: 1px solid #007bff;
        }

        .babaju-btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .babaju-btn-secondary { /* Mengganti .btn-secondary */
            background-color: #6c757d; /* Warna abu-abu untuk tombol sekunder */
            color: white;
            border: 1px solid #6c757d;
        }

        .babaju-btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        /* Gaya untuk alert/pesan (jika ada) */
        .babaju-alert { /* Mengganti .alert */
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
            text-align: center;
        }

        .babaju-alert-info { /* Mengganti .alert-info */
            color: #0c5460;
            background-color: #d1ecf1;
            border-color: #bee5eb;
        }

        /* Responsiveness dasar */
        @media (max-width: 768px) {
            .babaju-edit-container {
                margin: 20px auto;
                padding: 15px;
            }
            .babaju-btn {
                display: block; /* Tombol menjadi satu kolom di layar kecil */
                width: 100%;
                margin-bottom: 10px;
                margin-right: 0;
            }
        }
    </style>

    <h2>Edit Produk: <?= htmlspecialchars($product['name']) ?></h2>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="babaju-alert babaju-alert-info mt-3" role="alert">
            <?= $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <form action="<?= BASEURL ?>/?page=updateProduk" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">

        <div class="babaju-form-group">
            <label for="name" class="babaju-form-label">Nama Produk</label>
            <input type="text" class="babaju-form-control" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>
        <div class="babaju-form-group">
            <label for="description" class="babaju-form-label">Deskripsi</label>
            <textarea class="babaju-form-control" id="description" name="description" rows="3"><?= htmlspecialchars($product['description']) ?></textarea>
        </div>
        <div class="babaju-form-group">
            <label for="price" class="babaju-form-label">Harga</label>
            <input type="number" step="0.01" class="babaju-form-control" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>
        </div>
        <div class="babaju-form-group">
            <label for="image_url" class="babaju-form-label">URL Gambar</label>
            <input type="text" class="babaju-form-control" id="image_url" name="image_url" value="<?= htmlspecialchars($product['image_url']) ?>">
        </div>
        <div class="babaju-form-group">
            <label for="category_id" class="babaju-form-label">Kategori</label>
            <select class="babaju-form-control" id="category_id" name="category_id" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= htmlspecialchars($category['id']) ?>" <?= ($category['id'] == $product['category_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="babaju-form-group">
            <label for="stock_quantity" class="babaju-form-label">Jumlah Stok</label>
            <input type="number" class="babaju-form-control" id="stock_quantity" name="stock_quantity" value="<?= htmlspecialchars($product['stock_quantity']) ?>" required>
        </div>
        <button type="submit" class="babaju-btn babaju-btn-primary">Perbarui Produk</button>
    </form>
</div>