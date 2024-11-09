<?php
include "koneksi.php";

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil daftar tabel dari database
$tables = [];
$sql = "SHOW TABLES";
$result = $koneksi->query($sql);
if ($result) {
    while ($row = $result->fetch_array()) {
        $tables[] = $row[0]; // Menyimpan nama tabel dalam array
    }
}

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['table'])) {
    $selectedTable = $_POST['table'];

    // Ambil data dari tabel yang dipilih
    $sql = "SELECT * FROM $selectedTable"; // Ambil semua data dari tabel yang dipilih
    $dataResult = $koneksi->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD App</title>
</head>
<body>
    <h1>Pilih Tabel untuk Ditampilkan</h1>
    <form method="post" action="tambahTabel.php">
        <label for="table">Pilih Tabel:</label>
        <select name="table" id="table" required>
            <option value="">--Pilih Tabel--</option>
            <?php foreach ($tables as $table): ?>
                <option value="<?php echo $table; ?>"><?php echo $table; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Tampilkan Data">
    </form>

    <?php if (isset($dataResult)): ?>
        <h2>Data dari Tabel: <?php echo htmlspecialchars($selectedTable); ?></h2>
        <table border="1">
            <tr>
                <?php
                // Tampilkan header tabel
                $fields = $dataResult->fetch_fields();
                foreach ($fields as $field) {
                    echo "<th>" . htmlspecialchars($field->name) . "</th>";
                }
                ?>
            </tr>
            <?php
            // Tampilkan data dari tabel
            if ($dataResult->num_rows > 0) {
                while ($row = $dataResult->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>" . htmlspecialchars($value) . "</td>";
                    }
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='" . count($fields) . "'>Tidak ada data</td></tr>";
            }
            ?>
        </table>
    <?php endif; ?>

</body>
</html>

<?php
// Tutup koneksi
$koneksi->close();
?>
