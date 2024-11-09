<?php 
include "koneksi.php";

// Cek apakah form untuk menambah data disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_data'])) {
    $selectedTable = $_POST['table'];
    
    // Persiapkan query untuk memasukkan data
    $columns = array_keys($_POST);
    $values = array_values($_POST);
    array_pop($values); // Hapus nilai 'table' dari array values

    $columnsList = implode(", ", $columns);
    $placeholders = implode(", ", array_fill(0, count($values), '?'));

    $stmt = $koneksi->prepare("INSERT INTO $selectedTable ($columnsList) VALUES ($placeholders)");

    // Bind parameters
    $stmt->bind_param(str_repeat('s', count($values)), ...$values); // Asumsikan semua input adalah string

    if ($stmt->execute()) {
        echo "Data berhasil ditambahkan!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>






<?php if (isset($dataResult)): ?>
    <h2>Data dari Tabel: <?php echo htmlspecialchars($selectedTable); ?></h2>
    <table border="1">
        <!-- Tampilkan header tabel dan data seperti sebelumnya -->
    </table>

    <!-- Form untuk menambah data -->
    <h2>Tambah Data ke Tabel: <?php echo htmlspecialchars($selectedTable); ?></h2>
    <form method="post" action="tambahTabel.php">
        <?php
        // Ambil field dari tabel untuk membuat input
        $fields = $dataResult->fetch_fields();
        foreach ($fields as $field): ?>
            <label for="<?php echo $field->name; ?>"><?php echo htmlspecialchars($field->name); ?>:</label>
            <input type="text" name="<?php echo $field->name; ?>" required>
            <br>
        <?php endforeach; ?>
        <input type="hidden" name="table" value="<?php echo htmlspecialchars($selectedTable); ?>">
        <input type="submit" name="add_data" value="Tambah Data">
    </form>
<?php endif; ?><?php if (isset($dataResult)): ?>
    <h2>Data dari Tabel: <?php echo htmlspecialchars($selectedTable); ?></h2>
    <table border="1">
        <!-- Tampilkan header tabel dan data seperti sebelumnya -->
    </table>

    <!-- Form untuk menambah data -->
    <h2>Tambah Data ke Tabel: <?php echo htmlspecialchars($selectedTable); ?></h2>
    <form method="post" action="tambahTabel.php">
        <?php
        // Ambil field dari tabel untuk membuat input
        $fields = $dataResult->fetch_fields();
        foreach ($fields as $field): ?>
            <label for="<?php echo $field->name; ?>"><?php echo htmlspecialchars($field->name); ?>:</label>
            <input type="text" name="<?php echo $field->name; ?>" required>
            <br>
        <?php endforeach; ?>
        <input type="hidden" name="table" value="<?php echo htmlspecialchars($selectedTable); ?>">
        <input type="submit" name="add_data" value="Tambah Data">
    </form>
<?php endif; ?>