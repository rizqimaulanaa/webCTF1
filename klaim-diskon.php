<?php
// Celah: Token diskon hanya berdasarkan waktu, sangat mudah ditebak polanya
$token_diskon = md5(time() . "promo-taruna"); 
setcookie("PROMO_SESSION", $token_diskon);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Klaim Diskon - TarunaGear</title>
    <style>body { font-family: Arial; padding: 50px; background: #f4f4f9; text-align: center; }</style>
</head>
<body>
    <div style="background: white; padding: 30px; border-radius: 8px; max-width: 500px; margin: auto;">
        <h2>🎉 Selamat! Anda Mendapatkan Promo Spesial</h2>
        <p>Sesi promo Anda telah aktif. Sistem telah menanamkan cookie <b>PROMO_SESSION</b> di browser Anda.</p>
        <p style="color: #7f8c8d; font-size: 0.9em;">(Diskon 20% akan otomatis diterapkan saat checkout)</p>
        
        <br><br>
        <a href="index.php" style="padding: 10px 15px; background: #1c2833; color: white; text-decoration: none; border-radius: 4px;">Kembali Belanja</a>
    </div>
</body>
</html>
