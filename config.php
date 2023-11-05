<?php

$base_url="localhost/domain-managment";
$whoisapi="rDQTtVcvVkISlnFOoQrrHmTbZoSVqHoP";
// Veritabanı bilgileri
$servername = "xpanel.serdardegirmenci.com.tr"; // Sunucu adı veya IP adresi
$username = "admin_demo"; // MySQL kullanıcı adı
$password = "Demo.1234"; // MySQL kullanıcı parolası
$dbname = "admin_demo"; // Veritabanı adı
// Veritabanına bağlanma
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
}

function kalansure($tarih){
        // Hedef tarih
        $targetDate = strtotime($tarih);

        // Şu anki tarih ve saat
        $currentDate = time();
    
        // Tarih farkını hesapla
        $dateDiff = ($targetDate - $currentDate) / (60 * 60 * 24);
    
        // Pozitif veya negatif farkı al
        return $daysDifference = round($dateDiff);
}

function whoiss($url){
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.apilayer.com/whois/query?domain=$url",
    CURLOPT_HTTPHEADER => array(
        "Content-Type: text/plain",
        "apikey: rDQTtVcvVkISlnFOoQrrHmTbZoSVqHoP"
    ),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET"
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}
?>
