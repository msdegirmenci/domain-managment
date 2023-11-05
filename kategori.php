<!DOCTYPE html>
<html>
<head>
    <title>Category Management</title>
</head>
<body>
<table border="2"><tr>
        <td><a href="<?=$base_url?>index.php">Home Page</a></td>
        <td><a href="<?=$base_url?>domain-add.php">Domain Management</a></td>
        <td><a href="<?=$base_url?>kategori.php">Category Management</a></td>
        </tr></table>
    <hr>
    <h1>Category Management</h1>

    <?php
    require_once 'config.php';

    // Kategori Ekleme İşlemi
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $kategoriAdi = $_POST["kategoriAdi"];

        $insertSql = "INSERT INTO Kategoriler (KategoriAdi) VALUES ('$kategoriAdi')";

        if ($conn->query($insertSql) === TRUE) {
            echo "The new category has been successfully added.";
        } else {
            echo "Hata: " . $conn->error;
        }
    }

    // Kategori Silme İşlemi
    if (isset($_GET['delete'])) {
        $kategoriID = $_GET['delete'];

        $deleteSql = "DELETE FROM Kategoriler WHERE KategoriID = $kategoriID";

        if ($conn->query($deleteSql) === TRUE) {
            echo "The category has been successfully deleted.";
        } else {
            echo "Hata: " . $conn->error;
        }
    }

    // Mevcut Kategorileri Listeleme
    $listSql = "SELECT * FROM Kategoriler";
    $result = $conn->query($listSql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Category ID</th>
                    <th>Category Adı</th>
                    <th></th>
                </tr>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["KategoriID"]."</td>
                    <td>".$row["KategoriAdi"]."</td>
                    <td><a href='?delete=".$row["KategoriID"]."'>Delete</a></td>
                </tr>";
        }
        
        echo "</table>";
    } else {
        echo "The current category could not be found.";
    }
    ?>

    <h2>New Category Add</h2>
    <form method="POST" action="">
        Category Name: <input type="text" name="kategoriAdi" required><br><br>
        <input type="submit" value="Add">
    </form>
</body>
</html>
