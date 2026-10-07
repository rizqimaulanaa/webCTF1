<?php
session_start();

// Database dummy produk (Harus sama dengan index)
$katalog = [
    1 => ["nama" => "Sepatu PDL Taktis", "harga" => 450000, "icon" => "🥾"],
    2 => ["nama" => "Ransel Tempur 45L", "harga" => 320000, "icon" => "🎒"],
    3 => ["nama" => "Senter LED Militer", "harga" => 150000, "icon" => "🔦"]
];

// Fitur Kosongkan Keranjang
if(isset($_GET['clear'])) {
    unset($_SESSION['keranjang']);
    header("Location: keranjang.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja - TarunaGear</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; }
        .navbar { background-color: #1c2833; color: white; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center;}
        .navbar-brand { font-size: 1.2em; font-weight: bold; }
        .navbar-links a { color: white; text-decoration: none; margin-left: 20px; font-weight: bold; padding: 8px 12px; border-radius: 4px;}
        
        .container { max-width: 800px; margin: 40px auto; padding: 30px; background: white; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; }
        .total-row { font-weight: bold; font-size: 1.1em; }
        
        .btn { padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; color: white;}
        .btn-green { background-color: #27ae60; }
        .btn-red { background-color: #e74c3c; }
        .btn-gray { background-color: #7f8c8d; }
        
        .promo-alert { background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-top: 20px; border-left: 5px solid #28a745; }
    </style>
</head>
<body>

<div class="navbar">
    <div class="navbar-brand">🎯 TarunaGear Store</div>
    <div class="navbar-links">
        <a href="index.php">Kembali ke Toko</a>
    </div>
</div>

<div class="container">
    <h2>🛒 Keranjang Belanja Anda</h2>

    <?php if(empty($_SESSION['keranjang'])): ?>
        <p style="color: #7f8c8d; text-align: center; padding: 40px 0;">Keranjang belanja Anda masih kosong.</p>
        <div style="text-align: center;">
            <a href="index.php" class="btn btn-green">Mulai Belanja</a>
        </div>
    <?php else: ?>
        <table>
            <tr>
                <th>Produk</th>
                <th>Harga Satuan</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
            <?php 
            $subtotal_semua = 0;
            foreach($_SESSION['keranjang'] as $id => $jumlah): 
                $item = $katalog[$id];
                $subtotal_item = $item['harga'] * $jumlah;
                $subtotal_semua += $subtotal_item;
            ?>
            <tr>
                <td><?php echo $item['icon'] . " " . $item['nama']; ?></td>
                <td>Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
                <td><?php echo $jumlah; ?></td>
                <td>Rp <?php echo number_format($subtotal_item, 0, ',', '.'); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

        <!-- Deteksi Cookie Promo dari tantangan Sequencer -->
        <?php 
        $diskon = 0;
        if(isset($_COOKIE['PROMO_SESSION'])): 
            $diskon = $subtotal_semua * 0.20; // Diskon 20%
        ?>
            <div class="promo-alert">
                <strong>✅ Token Promo Aktif Terdeteksi!</strong> (Cookie: <code>PROMO_SESSION</code>)<br>
                Anda berhak mendapatkan potongan diskon sebesar 20%.
            </div>
        <?php endif; ?>

        <table style="width: 50%; float: right; margin-top: 20px;">
            <tr>
                <td>Subtotal</td>
                <td style="text-align: right;">Rp <?php echo number_format($subtotal_semua, 0, ',', '.'); ?></td>
            </tr>
            <?php if($diskon > 0): ?>
            <tr>
                <td style="color: #e74c3c;">Diskon Promo (20%)</td>
                <td style="text-align: right; color: #e74c3c;">- Rp <?php echo number_format($diskon, 0, ',', '.'); ?></td>
            </tr>
            <?php endif; ?>
            <tr class="total-row">
                <td>TOTAL BAYAR</td>
                <td style="text-align: right; color: #27ae60;">Rp <?php echo number_format($subtotal_semua - $diskon, 0, ',', '.'); ?></td>
            </tr>
        </table>
        <div style="clear: both;"></div>

        <div style="margin-top: 30px; display: flex; justify-content: space-between;">
            <a href="keranjang.php?clear=1" class="btn btn-red">Kosongkan Keranjang</a>
            <div>
                <a href="index.php" class="btn btn-gray">Belanja Lagi</a>
                <a href="#" class="btn btn-green" onclick="alert('Ini adalah lingkungan lab. Fitur pembayaran dinonaktifkan.');">Checkout Sekarang</a>
            </div>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
