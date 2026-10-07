<!DOCTYPE html>
<html lang="id">
<head>
    <title>Lacak Resi - TarunaGear</title>
    <style>body { font-family: Arial; padding: 50px; background: #f4f4f9; }</style>
</head>
<body>
    <div style="background: white; padding: 30px; border-radius: 8px; max-width: 600px; margin: auto;">
        <h2>Lacak Pengiriman</h2>
        <p>Sistem kami akan menghubungi server ekspedisi (API) untuk melacak paket Anda.</p>
        
        <form method="POST">
            <!-- Developer sengaja naruh URL API di form hidden (Kecerobohan dev) -->
            <input type="hidden" name="api_ekspedisi" value="http://api.ekspedisi-lokal.com/cek">
            
            <label>Masukkan Nomor Resi:</label><br><br>
            <input type="text" name="resi" value="TRN-00123" style="padding: 10px; width: 80%;"><br><br>
            <button type="submit" style="padding: 10px 15px; background: #27ae60; color: white; border: none;">Cek Status</button>
        </form>

        <?php
        if(isset($_POST['api_ekspedisi'])) {
            echo "<hr>";
            $url_target = $_POST['api_ekspedisi'];
            echo "<p>Menghubungi server ekspedisi di: <i>$url_target</i> ...</p>";
            
            // Celah SSRF / OAST: Server langsung mengakses URL yang bisa diganti attacker via Burp Proxy
            $response = @file_get_contents($url_target); 
            
            if($response === FALSE) {
                echo "<p style='color:red;'>Gagal terhubung ke server ekspedisi.</p>";
            } else {
                echo "<p style='color:green;'>Paket sedang dalam perjalanan menuju tujuan.</p>";
            }
        }
        ?>
        <br><a href="index.php">Kembali ke Toko</a>
    </div>
</body>
</html>
