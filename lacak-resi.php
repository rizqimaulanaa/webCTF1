<!DOCTYPE html>
<html lang="id">
<head>
    <title>Lacak Resi - TarunaGear</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 50px; background: #f4f4f9; }
        .box { background: white; padding: 30px; border-radius: 8px; max-width: 600px; margin: auto; box-shadow: 0 4px 10px rgba(0,0,0,0.1);}
        .btn { padding: 10px 15px; background: #27ae60; color: white; border: none; border-radius: 4px; cursor: pointer;}
        .result-box { margin-top: 20px; padding: 15px; border-radius: 4px; background: #2c3e50; color: #ecf0f1; font-family: monospace;}
    </style>
</head>
<body>
    <div class="box">
        <h2>Lacak Pengiriman</h2>
        <p>Sistem kami akan menghubungi Internal API ekspedisi untuk mengecek paket Anda secara *real-time*.</p>
        
        <form method="POST">
            <!-- Developer sengaja menaruh endpoint API di hidden input -->
            <input type="hidden" name="api_ekspedisi" value="http://127.0.0.1/api.php">
            
            <label>Masukkan Nomor Resi (Gunakan <b>TRN-123</b> untuk testing):</label><br><br>
            <input type="text" name="resi" value="TRN-123" style="padding: 10px; width: 80%; border: 1px solid #ccc; border-radius: 4px;"><br><br>
            <button type="submit" class="btn">Cek Status Paket</button>
        </form>

        <?php
        if(isset($_POST['api_ekspedisi']) && isset($_POST['resi'])) {
            echo "<hr>";
            // MENGGABUNGKAN URL API dengan RESI (Ini penyebab SSRF-nya)
            $url_target = $_POST['api_ekspedisi'] . "?resi=" . urlencode($_POST['resi']);
            
            echo "<p style='color: #7f8c8d; font-size: 0.9em;'>[System Log] Meminta data ke: <i>" . htmlspecialchars($url_target) . "</i></p>";
            
            // Celah SSRF: File_get_contents mengambil data dari URL tanpa divalidasi
            $response = @file_get_contents($url_target); 
            
            if($response === FALSE) {
                echo "<p style='color:red;'><strong>Error:</strong> Gagal terhubung ke server ekspedisi atau URL ditolak.</p>";
            } else {
                // Coba parsing sebagai JSON (kalau balasan dari api.php)
                $data = json_decode($response, true);
                
                if(is_array($data) && isset($data['status'])) {
                    if($data['status'] === 'success') {
                        echo "<div style='color:green; font-weight:bold;'>✅ " . $data['posisi'] . "</div>";
                        echo "<p>Kurir: " . $data['kurir'] . " <br>Update: " . $data['update_terakhir'] . "</p>";
                    } else {
                        echo "<div style='color:red;'>❌ " . $data['pesan'] . "</div>";
                    }
                } else {
                    // JIKA HASILNYA BUKAN JSON (Contoh: Taruna berhasil membaca file sistem /etc/passwd)
                    echo "<p><strong>Respon Server (Raw Data):</strong></p>";
                    echo "<div class='result-box'>" . nl2br(htmlspecialchars($response)) . "</div>";
                }
            }
        }
        ?>
        <br><br><a href="index.php" style="color: #3498db; text-decoration: none;">&larr; Kembali ke Toko</a>
    </div>
</body>
</html>
