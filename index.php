<!DOCTYPE html>
<html>
<head>
    <title>Domain Name List</title>
</head>
<body>

<table border="2"><tr>
        <td><a href="<?=$base_url?>index.php">Home Page</a></td>
        <td><a href="<?=$base_url?>domain-add.php">Domain Management</a></td>
        <td><a href="<?=$base_url?>kategori.php">Category Management</a></td>
        </tr></table>
<hr>
    <h1>Domain Name List</h1>

    <?php
    require_once 'config.php';

    $sql = "SELECT AlanAdlari.AlanAdiID, AlanAdlari.AlanAdi, Kategoriler.KategoriAdi, AlanAdiDetaylari.SonKullanmaTarihi, AlanAdiDetaylari.KalanSure
    FROM AlanAdlari
    INNER JOIN Kategoriler ON AlanAdlari.KategoriID = Kategoriler.KategoriID
    LEFT JOIN AlanAdiDetaylari ON AlanAdlari.AlanAdiID = AlanAdiDetaylari.AlanAdiID";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Domain Name</th>
                    <th>Category</th>
                    <th>Expiration Date</th>
                    <th>Days Remaining</th>
                    <th>Action</th>
                </tr>";
                
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["AlanAdi"]."</td>
                    <td>".$row["KategoriAdi"]."</td>
                    <td>".$row["SonKullanmaTarihi"]."</td>
                    <td>".kalansure($row["SonKullanmaTarihi"])."</td>
                    <td><button onclick=\"location.href='update.php?id=".$row["AlanAdiID"]."'\" type=\"button\">
                    Update</button></td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "Veri bulunamadi.";
    }

    $conn->close();
    ?>
</body>
</html>
