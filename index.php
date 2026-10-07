<?php
// Mengambil informasi server untuk ditampilkan (biar kelihatan seperti lab beneran)
$server_ip = $_SERVER['SERVER_ADDR'] ?? '127.0.0.1';
$php_version = phpversion();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Uji Kompetensi - Web Exploit</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #0d1117;
            color: #c9d1d9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            background-color: #161b22;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            border-top: 4px solid #2ea043;
        }
        .header {
            text-align: center;
            border-bottom: 1px solid #30363d;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #58a6ff;
            margin: 0 0 10px 0;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        .header p {
            color: #8b949e;
            font-size: 0.95em;
            margin: 0;
        }
        .sys-info {
            background-color: #0d1117;
            padding: 10px;
            border-radius: 4px;
            font-family: 'Courier New', Courier, monospace;
            font-size: 0.85em;
            color: #ff7b72;
            text-align: center;
            margin-bottom: 30px;
            border: 1px solid #30363d;
        }
        .challenge-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .challenge-card {
            background-color: #21262d;
            border: 1px solid #30363d;
            padding: 20px;
            border-radius: 6px;
            text-decoration: none;
            color: #c9d1d9;
            transition: all 0.2s ease;
            display: flex;
            flex-direction: column;
        }
        .challenge-card:hover {
            transform: translateX(10px);
            border-color: #8b949e;
            background-color: #30363d;
        }
        .card-oast { border-left: 4px solid #f0883e; }
        .card-token { border-left: 4px solid #79c0ff; }
        .card-dom { border-left: 4px solid #d2a8ff; }
        
        .challenge-title {
            font-size: 1.1em;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 5px;
        }
        .challenge-desc {
            font-size: 0.9em;
            color: #8b949e;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 0.8em;
            color: #484f58;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>Target Alpha: Linux Environment</h1>
            <p>Platform Uji Kompetensi Eksploitasi Web & Analisis Kerentanan</p>
        </div>

        <div class="sys-info">
            [ System Status ] >> IP Target: <?php echo $server_ip; ?> | Engine: PHP/<?php echo $php_version; ?> (Strict Mode)
        </div>

        <p style="text-align: center; margin-bottom: 25px; color: #8b949e;">
            Gunakan <strong style="color: #c9d1d9;">Burp Suite Professional</strong> untuk menyelesaikan artefak simulasi di bawah ini.
        </p>

        <div class="challenge-list">
            <!-- Tantangan 1 -->
            <a href="tantangan-oast.php" class="challenge-card card-oast">
                <div class="challenge-title">Mission 01: Out-of-Band Testing (OAST)</div>
                <div class="challenge-desc">Tujuan: Identifikasi celah SSRF yang tidak terlihat (Blind) menggunakan Burp Collaborator.</div>
            </a>

            <!-- Tantangan 2 -->
            <a href="tantangan-token.php" class="challenge-card card-token">
                <div class="challenge-title">Mission 02: Token Entropy Analysis</div>
                <div class="challenge-desc">Tujuan: Uji kekuatan enkripsi dan acakan token sesi (Session Cookie) menggunakan Burp Sequencer.</div>
            </a>

            <!-- Tantangan 3 -->
            <a href="tantangan-dom.html" class="challenge-card card-dom">
                <div class="challenge-title">Mission 03: DOM-based Vulnerability</div>
                <div class="challenge-desc">Tujuan: Lakukan auto-scanning dan manipulasi Document Object Model menggunakan DOM Invader.</div>
            </a>
        </div>

        <div class="footer">
            &copy; 2026 Lab Praktikum Taruna | Strictly For Educational Purposes
        </div>
    </div>

</body>
</html>
