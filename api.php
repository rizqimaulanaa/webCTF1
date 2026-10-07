<?php
// Set header agar dikenali sebagai API betulan
header('Content-Type: application/json');

if(isset($_GET['resi'])) {
    $resi = $_GET['resi'];
    
    // Mengecek apakah resi valid
    if($resi === 'TRN-123') {
        echo json_encode([
            "status" => "success", 
            "kurir" => "Taruna Express",
            "posisi" => "Paket sedang transit di Gudang Pusat (Jakarta)",
            "update_terakhir" => date("Y-m-d H:i:s")
        ]);
    } else {
        echo json_encode([
            "status" => "error", 
            "pesan" => "Nomor resi tidak ditemukan di database kami."
        ]);
    }
} else {
    echo json_encode(["status" => "error", "pesan" => "Parameter resi kosong."]);
}
?>
