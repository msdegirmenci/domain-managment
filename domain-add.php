<!DOCTYPE html>
<html>
<head>
    <title>Domain Management</title>
</head>
<body>
    <table border="2"><tr>
        <td><a href="<?=$base_url?>index.php">Home Page</a></td>
        <td><a href="<?=$base_url?>domain-add.php">Domain Management</a></td>
        <td><a href="<?=$base_url?>kategori.php">Category Management</a></td>
        </tr></table>
    <hr>
    <h1>Domain Management</h1>

    <?php
    require_once 'config.php';

    // Alan Adı Ekleme İşlemi
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $alanAdi = $_POST["alanAdi"];
        $kategoriID = $_POST["kategoriID"];

        $insertSql = "INSERT INTO AlanAdlari (AlanAdi, KategoriID) VALUES ('$alanAdi', $kategoriID)";

        if ($conn->query($insertSql) === TRUE) {
            echo "The new domain has been successfully added.";
        } else {
            echo "Hata: " . $conn->error;
        }
    }
    // Kategori Silme İşlemi
    if (isset($_GET['delete'])) {
        $domainID = $_GET['delete'];

        $deleteSql = "DELETE FROM AlanAdlari WHERE AlanAdiID = $domainID";

        if ($conn->query($deleteSql) === TRUE) {
            echo "The domain has been successfully deleted.";
        } else {
            echo "Hata: " . $conn->error;
        }
    }

    // Alan Adlarını Listeleme
    $listSql = "SELECT AlanAdlari.AlanAdi, Kategoriler.KategoriAdi, AlanAdlari.AlanAdiID 
                FROM AlanAdlari
                INNER JOIN Kategoriler ON AlanAdlari.KategoriID = Kategoriler.KategoriID";
    $result = $conn->query($listSql);
    ?>

    <h2>Domain Name List</h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Domain Name</th>
                    <th>Category</th>
                    <th></th>
                </tr>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["AlanAdi"]."</td>
                    <td>".$row["KategoriAdi"]."</td>
                    <td><a href='?delete=".$row["AlanAdiID"]."'>Delete</a></td>
                </tr>";
        }
        
        echo "</table>";
    } else {
        echo "Existing domain name not found.";
    }
    ?>

    <h2>New Domain Name Add</h2>
    <form method="POST" action="">
        Domain Name: <input type="text" name="alanAdi" required><br><br>
        Category: 
        <select name="kategoriID">
            <?php
            $kategoriSql = "SELECT * FROM Kategoriler";
            $kategoriResult = $conn->query($kategoriSql);

            if ($kategoriResult->num_rows > 0) {
                while ($row = $kategoriResult->fetch_assoc()) {
                    echo "<option value='".$row["KategoriID"]."'>".$row["KategoriAdi"]."</option>";
                }
            }
            ?>
        </select><br><br>
        <input type="submit" value="Domain ADD">
    </form>
</body>
</html>
