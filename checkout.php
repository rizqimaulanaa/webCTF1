<?php
session_start();

// Mencegah akses langsung tanpa melalui keranjang
if($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['total_bayar'])) {
    header("Location: index.php");
    exit;
}

// BUG LOGIKA: Server menerima harga mentah dari user tanpa divalidasi ulang ke database
$total_bayar = intval($_POST['total_bayar']);

// Setelah checkout, kosongkan keranjang
unset($_SESSION['keranjang']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice - TarunaGear</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; padding: 50px; text-align: center; }
        .invoice-box { background: white; max-width: 500px; margin: auto; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border-top: 5px solid #2980b9; }
        .success-icon { font-size: 60px; color: #27ae60; margin-bottom: 10px; }
        h2 { color: #2c3e50; margin-top: 0; }
        .tagihan { font-size: 24px; font-weight: bold; color: #e74c3c; margin: 20px 0; padding: 15px; background: #fadbd8; border-radius: 4px; border: 1px dashed #c0392b;}
        .btn { padding: 10px 20px; background-color: #34495e; color: white; text-decoration: none; border-radius: 4px; display: inline-block; margin-top: 20px;}
        
        .alert-hack { background: #f1c40f; color: #d35400; padding: 15px; margin-top: 20px; border-radius: 4px; font-weight: bold; border: 2px solid #e67e22; animation: blink 1s infinite alternate;}
        @keyframes blink { from { opacity: 1; } to { opacity: 0.6; } }
    </style>
</head>
<body>

    <div class="invoice-box">
        <div class="success-icon">✔️</div>
        <h2>Pesanan Berhasil Diproses!</h2>
        <p>Terima kasih telah berbelanja di TarunaGear. Tagihan Anda telah dicetak dan diteruskan ke sistem pembayaran.</p>
        
        <div class="tagihan">
            TOTAL: Rp <?php echo number_format($total_bayar, 0, ',', '.'); ?>
        </div>

        <!-- Indikator Keberhasilan Exploit untuk Taruna -->
        <?php if($total_bayar <= 1000): ?>
            <div class="alert-hack">
                🚨 ANOMALI SISTEM TERDETEKSI 🚨<br>
                Validasi harga gagal. Anda berhasil melakukan Parameter Tampering!
            </div>
        <?php else: ?>
            <p style="color: #7f8c8d; font-size: 0.9em;">(Sistem akan memotong saldo dari rekening yang terdaftar)</p>
        <?php endif; ?>

        <a href="index.php" class="btn">Kembali ke Beranda</a>
    </div>

</body>
</html>
