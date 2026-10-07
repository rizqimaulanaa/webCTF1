<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>TarunaGear - Toko Perlengkapan Taktis</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; }
        .navbar { background-color: #1c2833; color: white; padding: 15px 20px; display: flex; justify-content: space-between; }
        .navbar a { color: white; text-decoration: none; margin-left: 20px; font-weight: bold; }
        .container { max-width: 1000px; margin: 20px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .search-box { padding: 10px; width: 300px; border: 1px solid #ccc; border-radius: 4px; }
        .btn { padding: 10px 15px; background-color: #27ae60; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .products { display: flex; gap: 20px; margin-top: 30px; }
        .product-card { border: 1px solid #ddd; padding: 15px; border-radius: 5px; text-align: center; width: 30%; }
        .product-card img { max-width: 100%; height: 150px; background: #eee; margin-bottom: 10px; }
        #search-result { margin-top: 20px; padding: 15px; background-color: #e8f8f5; border-left: 4px solid #1abc9c; display: none; }
    </style>
</head>
<body>

<div class="navbar">
    <div style="font-size: 1.2em; font-weight: bold;">🎯 TarunaGear Store</div>
    <div>
        <a href="index.php">Home</a>
        <a href="klaim-diskon.php">Klaim Promo</a>
        <a href="lacak-resi.php">Lacak Resi</a>
    </div>
</div>

<div class="container">
    <h2>Katalog Produk</h2>
    
    <!-- Fitur Search (Target DOM Invader) -->
    <form method="GET" action="index.php">
        <input type="text" name="q" id="keyword" class="search-box" placeholder="Cari perlengkapan...">
        <button type="submit" class="btn">Cari</button>
    </form>

    <div id="search-result"></div>

    <div class="products">
        <div class="product-card">
            <div style="font-size: 50px;">🥾</div>
            <h3>Sepatu PDL Taktis</h3>
            <p>Rp 450.000</p>
            <button class="btn">Beli</button>
        </div>
        <div class="product-card">
            <div style="font-size: 50px;">🎒</div>
            <h3>Ransel Tempur 45L</h3>
            <p>Rp 320.000</p>
            <button class="btn">Beli</button>
        </div>
        <div class="product-card">
            <div style="font-size: 50px;">🔦</div>
            <h3>Senter LED Militer</h3>
            <p>Rp 150.000</p>
            <button class="btn">Beli</button>
        </div>
    </div>
</div>

<!-- Script Rentan DOM XSS -->
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const query = urlParams.get('q');
    if(query) {
        let resultDiv = document.getElementById('search-result');
        resultDiv.style.display = 'block';
        // Celah: Memasukkan input user langsung ke HTML tanpa sanitasi
        resultDiv.innerHTML = "Menampilkan hasil pencarian untuk barang: <b>" + query + "</b>";
    }
</script>

</body>
</html>
