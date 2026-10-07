<?php
session_start();

if($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['total_bayar'])) {
    header("Location: index.php");
    exit;
}

// BUG LOGIKA: Server menerima harga dari browser tanpa divalidasi
$total_bayar = intval($_POST['total_bayar']);

// Generate Nomor Resi Acak
$nomor_resi = "TRN-" . rand(1000, 9999);

// Kosongkan keranjang setelah checkout
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
        .resi-box { font-size: 18px; color: #2980b9; margin: 20px 0; padding: 15px; background: #ebf5fb; border-radius: 4px; border: 1px solid #a9cce3;}
        
        .btn { padding: 10px 20px; background-color: #34495e; color: white; text-decoration: none; border-radius: 4px; display: inline-block; margin-top: 10px;}
        .btn-track { background-color: #27ae60; margin-right: 10px;}
        
        .alert-hack { background: #f1c40f; color: #d35400; padding: 15px; margin-top: 20px; border-radius: 4px; font-weight: bold; border: 2px solid #e67e22; animation: blink 1s infinite alternate;}
        @keyframes blink { from { opacity: 1; } to { opacity: 0.6; } }
    </style>
</head>
<body>

    <div class="invoice-box">
        <div class="success-icon">✔️</div>
        <h2>Pesanan Berhasil Diproses!</h2>
        <p>Terima kasih telah berbelanja di TarunaGear. Tagihan Anda telah dicetak dan diteruskan ke sistem logistik.</p>
        
        <div class="tagihan">
            TOTAL BAYAR: Rp <?php echo number_format($total_bayar, 0, ',', '.'); ?>
        </div>

        <div class="resi-box">
            Nomor Resi Anda:<br>
            <strong style="font-size: 24px; letter-spacing: 2px;"><?php echo $nomor_resi; ?></strong>
        </div>

        <!-- Indikator Keberhasilan Exploit Manipulasi Harga -->
        <?php if($total_bayar <= 1000): ?>
            <div class="alert-hack">
                🚨 ANOMALI SISTEM TERDETEKSI 🚨<br>
                Validasi harga gagal. Anda berhasil melakukan Parameter Tampering!
            </div>
        <?php endif; ?>

        <div style="margin-top: 30px;">
            <a href="lacak-resi.php?resi=<?php echo $nomor_resi; ?>" class="btn btn-track">Lacak Paket Ini</a>
            <a href="index.php" class="btn">Beranda</a>
        </div>
    </div>

</body>
</html>
