<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lacak Resi - TarunaGear</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 50px; background: #f4f4f9; }
        .box { background: white; padding: 30px; border-radius: 8px; max-width: 600px; margin: auto; box-shadow: 0 4px 10px rgba(0,0,0,0.1);}
        .btn { padding: 10px 15px; background: #27ae60; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;}
        .result-box { margin-top: 20px; padding: 15px; border-radius: 4px; background: #2c3e50; color: #ecf0f1; font-family: monospace; overflow-x: auto;}
    </style>
</head>
<body>
    <div class="box">
        <h2>📦 Lacak Pengiriman</h2>
        <p>Sistem kami akan menghubungi Internal API ekspedisi untuk mengecek paket Anda secara <i>real-time</i>.</p>
        
        <form method="POST">
            <!-- Developer sengaja menaruh endpoint API di hidden input -->
            <input type="hidden" name="api_ekspedisi" value="http://127.0.0.1/api.php">
            
            <label>Masukkan Nomor Resi:</label><br><br>
            
            <!-- Menangkap resi dari URL (GET) jika ada, jika tidak default ke TRN-123 -->
            <?php $resi_default = isset($_GET['resi']) ? $_GET['resi'] : 'TRN-123'; ?>
            <input type="text" name="resi" value="<?php echo htmlspecialchars($resi_default); ?>" style="padding: 10px; width: 80%; border: 1px solid #ccc; border-radius: 4px; font-size: 16px;"><br><br>
            
            <button type="submit" class="btn">Cek Status Paket</button>
        </form>

        <?php
        if(isset($_POST['api_ekspedisi']) && isset($_POST['resi'])) {
            echo "<hr style='border: 1px solid #eee; margin: 25px 0;'>";
            
            // MENGGABUNGKAN URL API dengan RESI (Ini penyebab kerentanan SSRF)
            $url_target = $_POST['api_ekspedisi'] . "?resi=" . urlencode($_POST['resi']);
            
            echo "<p style='color: #7f8c8d; font-size: 0.9em; background: #e8f8f5; padding: 10px; border-left: 3px solid #1abc9c;'>[System Log] Meminta data ke: <br><i>" . htmlspecialchars($url_target) . "</i></p>";
            
            // Celah SSRF: File_get_contents mengambil data dari URL (atau file lokal) tanpa divalidasi
            $response = @file_get_contents($url_target); 
            
            if($response === FALSE) {
                echo "<p style='color:red;'><strong>Error:</strong> Gagal terhubung ke server ekspedisi atau URL ditolak oleh sistem pengamanan jaringan.</p>";
            } else {
                // Mencoba mem-parsing respon sebagai JSON (skenario normal dari api.php)
                $data = json_decode($response, true);
                
                if(is_array($data) && isset($data['status'])) {
                    // Jika sukses format JSON
                    if($data['status'] === 'success') {
                        echo "<div style='color:green; font-size: 1.1em; font-weight:bold; margin-bottom: 10px;'>✅ " . htmlspecialchars($data['posisi']) . "</div>";
                        echo "<div style='background: #f9f9f9; padding: 15px; border-radius: 4px; border: 1px solid #ddd;'>";
                        echo "<strong>Kurir:</strong> " . htmlspecialchars($data['kurir']) . " <br><br>";
                        echo "<strong>Update Terakhir:</strong> " . htmlspecialchars($data['update_terakhir']);
                        echo "</div>";
                    } else {
                        // Jika gagal format JSON (resi salah)
                        echo "<div style='color:red; font-weight:bold;'>❌ " . htmlspecialchars($data['pesan']) . "</div>";
                    }
                } else {
                    // JIKA HASILNYA BUKAN JSON 
                    // (Ini akan terpicu jika taruna berhasil membaca file sistem seperti file:///etc/passwd)
                    echo "<p><strong>Respon Server (Raw Data / Anomaly):</strong></p>";
                    echo "<div class='result-box'>" . nl2br(htmlspecialchars($response)) . "</div>";
                }
            }
        }
        ?>
        <div style="margin-top: 30px;">
            <a href="index.php" style="color: #3498db; text-decoration: none; font-weight: bold;">&larr; Kembali ke Beranda Toko</a>
        </div>
    </div>
</body>
</html>
