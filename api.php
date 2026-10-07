<?php
// Set header agar dikenali sebagai API betulan
header('Content-Type: application/json');

if(isset($_GET['resi'])) {
    $resi = $_GET['resi'];
    
    // Logika Pintar: Jika resi diawali dengan teks "TRN-", maka anggap valid
    if(strpos($resi, 'TRN-') === 0) {
        echo json_encode([
            "status" => "success", 
            "kurir" => "Taruna Express",
            "posisi" => "Paket sedang dikemas di Gudang Logistik (Jakarta).",
            "update_terakhir" => date("Y-m-d H:i:s")
        ]);
    } else {
        echo json_encode([
            "status" => "error", 
            "pesan" => "Nomor resi tidak valid atau tidak ditemukan di database kami."
        ]);
    }
} else {
    echo json_encode(["status" => "error", "pesan" => "Parameter resi kosong."]);
}
?>
