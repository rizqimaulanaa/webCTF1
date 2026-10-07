<?php
// Celah: Token diskon hanya berdasarkan waktu, sangat mudah ditebak polanya
$token_diskon = md5(time() . "promo-taruna"); 
setcookie("PROMO_SESSION", $token_diskon);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klaim Promo Spesial - TarunaGear</title>
    <style>
        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #e2e8f0;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .promo-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 450px;
            overflow: hidden;
            text-align: center;
            animation: slideUp 0.5s ease-out;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .promo-header {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 35px 20px 25px;
        }
        .promo-header h2 {
            margin: 0;
            font-size: 1.8em;
            letter-spacing: 0.5px;
        }
        .icon-check {
            font-size: 50px;
            margin-bottom: 10px;
            display: inline-block;
            background: rgba(255,255,255,0.2);
            width: 80px;
            height: 80px;
            line-height: 80px;
            border-radius: 50%;
        }
        .promo-body {
            padding: 35px 30px;
        }
        .promo-body p {
            color: #4b5563;
            font-size: 1.05em;
            line-height: 1.6;
            margin-bottom: 25px;
        }
        .cookie-alert {
            background-color: #f8fafc;
            border-left: 4px solid #3b82f6;
            padding: 15px;
            border-radius: 4px 6px 6px 4px;
            font-size: 0.9em;
            color: #64748b;
            margin-bottom: 30px;
            text-align: left;
            border-right: 1px solid #e2e8f0;
            border-top: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
        }
        .cookie-alert strong {
            color: #0f172a;
            display: block;
            margin-bottom: 5px;
        }
        .cookie-alert code {
            background: #e2e8f0;
            padding: 2px 6px;
            border-radius: 4px;
            color: #ef4444;
            font-weight: bold;
        }
        .btn-back {
            display: inline-block;
            background-color: #1e293b;
            color: white;
            text-decoration: none;
            padding: 14px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: background 0.3s, transform 0.1s;
            width: 85%;
            box-sizing: border-box;
        }
        .btn-back:hover {
            background-color: #0f172a;
        }
        .btn-back:active {
            transform: scale(0.98);
        }
        .system-hint {
            font-family: 'Courier New', Courier, monospace;
            color: #94a3b8;
            font-size: 0.75em;
            margin-top: 25px;
            border-top: 1px dashed #cbd5e1;
            padding-top: 15px;
        }
    </style>
</head>
<body>

    <div class="promo-card">
        <div class="promo-header">
            <div class="icon-check">🎉</div>
            <h2>Promo Telah Aktif!</h2>
        </div>
        
        <div class="promo-body">
            <p>Selamat! Diskon eksklusif perlengkapan taktis sebesar <strong>20%</strong> telah aktif untuk sesi belanja Anda saat ini.</p>
            
            <div class="cookie-alert">
                <strong><span style="font-size: 1.2em;">⚙️</span> System Notice:</strong>
                Sistem telah menanamkan token autentikasi <code>PROMO_SESSION</code> pada browser Anda. Diskon akan otomatis terpotong saat checkout.
            </div>
            
            <a href="index.php" class="btn-back">Mulai Belanja Sekarang</a>

            <div class="system-hint">
                [Debug] Auth-Token Generation Algorithm V.1
            </div>
        </div>
    </div>

</body>
</html>
