<?php
session_start();

// Database dummy produk
$katalog = [
    1 => ["nama" => "Sepatu PDL Taktis", "harga" => 450000, "icon" => "🥾"],
    2 => ["nama" => "Ransel Tempur 45L", "harga" => 320000, "icon" => "🎒"],
    3 => ["nama" => "Senter LED Militer", "harga" => 150000, "icon" => "🔦"]
];

// Logika untuk menambah barang ke keranjang
if(isset($_GET['beli']) && isset($katalog[$_GET['beli']])) {
    $id = $_GET['beli'];
    if(!isset($_SESSION['keranjang'][$id])) {
        $_SESSION['keranjang'][$id] = 1; // Set jumlah 1
    } else {
        $_SESSION['keranjang'][$id]++; // Tambah jumlah
    }
    header("Location: index.php?status=sukses");
    exit;
}

// Menghitung total item di keranjang untuk icon navbar
$total_item = 0;
if(isset($_SESSION['keranjang'])) {
    foreach($_SESSION['keranjang'] as $id => $jumlah) {
        $total_item += $jumlah;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>TarunaGear - Toko Perlengkapan Taktis</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; }
        .navbar { background-color: #1c2833; color: white; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center;}
        .navbar-brand { font-size: 1.2em; font-weight: bold; }
        .navbar-links a { color: white; text-decoration: none; margin-left: 20px; font-weight: bold; padding: 8px 12px; border-radius: 4px; transition: background 0.2s;}
        .navbar-links a:hover { background-color: #34495e; }
        .cart-btn { background-color: #e74c3c !important; }
        
        .container { max-width: 1000px; margin: 20px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .search-box { padding: 10px; width: 300px; border: 1px solid #ccc; border-radius: 4px; }
        .btn { padding: 10px 15px; background-color: #27ae60; color: white; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block;}
        .products { display: flex; gap: 20px; margin-top: 30px; }
        .product-card { border: 1px solid #ddd; padding: 15px; border-radius: 5px; text-align: center; width: 30%; transition: transform 0.2s; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        
        #search-result { margin-top: 20px; padding: 15px; background-color: #e8f8f5; border-left: 4px solid #1abc9c; display: none; }
        .alert-success { background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 20px; text-align: center;}
    </style>
</head>
<body>

<div class="navbar">
    <div class="navbar-brand">🎯 TarunaGear Store</div>
    <div class="navbar-links">
        <a href="index.php">Home</a>
        <a href="klaim-diskon.php">Klaim Promo</a>
        <a href="lacak-resi.php">Lacak Resi</a>
        <a href="keranjang.php" class="cart-btn">🛒 Keranjang (<?php echo $total_item; ?>)</a>
    </div>
</div>

<div class="container">
    <?php if(isset($_GET['status']) && $_GET['status'] == 'sukses'): ?>
        <div class="alert-success">Barang berhasil ditambahkan ke keranjang!</div>
    <?php endif; ?>

    <h2>Katalog Produk</h2>
    
    <!-- Fitur Search (Target DOM Invader) -->
    <form method="GET" action="index.php">
        <input type="text" name="q" id="keyword" class="search-box" placeholder="Cari perlengkapan taktis...">
        <button type="submit" class="btn">Cari</button>
    </form>

    <div id="search-result"></div>

    <div class="products">
        <?php foreach($katalog as $id => $item): ?>
        <div class="product-card">
            <div style="font-size: 50px; margin-bottom: 15px;"><?php echo $item['icon']; ?></div>
            <h3 style="margin: 0 0 10px 0;"><?php echo $item['nama']; ?></h3>
            <p style="color: #c0392b; font-weight: bold; margin: 0 0 15px 0;">Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></p>
            <!-- Tombol Beli yang fungsional -->
            <a href="index.php?beli=<?php echo $id; ?>" class="btn">Beli Sekarang</a>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Script Rentan DOM XSS (Jangan Dihapus) -->
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const query = urlParams.get('q');
    if(query) {
        let resultDiv = document.getElementById('search-result');
        resultDiv.style.display = 'block';
        resultDiv.innerHTML = "Menampilkan hasil pencarian untuk barang: <b>" + query + "</b>";
    }
</script>

</body>
</html>
