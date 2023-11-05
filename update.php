<?php

include "config.php";
if($_GET["id"]){
    $domain_id=$_GET["id"];
    $command="Select * from AlanAdlari where AlanAdiID = $domain_id ";

    $result = $conn->query($command);
    $row = $result->fetch_assoc();
    //print_r($result->fetch_assoc());
    $domain= $row["AlanAdi"];
    //$domain="avcibicak.net";
    $getir= whoiss($domain);
    $getir = json_decode($getir);
    print_r($getir);
    $skt = $getir->result->expiration_date;
    $command2="Select * from AlanAdiDetaylari where AlanAdiID = $domain_id";
    $result = $conn->query($command2);
    print_r($skt);
    if ($result->num_rows > 0) {
        echo " result 1";
        $sql = "UPDATE AlanAdiDetaylari SET SonKullanmaTarihi = '$skt' Where AlanAdiID = $domain_id"; 
    }else{
        echo "result 2";
        $sql = "INSERT INTO AlanAdiDetaylari (AlanAdiID,SonKullanmaTarihi) VALUES ($domain_id,'$skt')";

    }
   
    if ($conn->query($sql) === TRUE) {
        echo "Güncelleme Yapıldı.";
    } else {
        echo "Hata: " . $conn->error;
    }

    ?>
    <TABle>
        <tr>
            <th>Son Kullanma</th>
            <th>KalanSure</th>
        </tr>
        <tr><td><?=$getir->result->expiration_date?></td>
        <td><?=$daysDifference?></td>    
    </tr>
    </TABle>

<?php  header("refresh: 1; url=index.php"); } ?>

 