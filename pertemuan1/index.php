
<?php
$nama = "";
$email = "";
$nilai = "";
$status = "";
$pesanError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama = trim($_POST["nama"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $nilai = $_POST["nilai"] ?? "";

    if ($nama == "" || $email == "" || $nilai === "") {
        $pesanError = "Semua field wajib diisi!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $pesanError = "Format email tidak valid!";
    } elseif (!is_numeric($nilai) || $nilai < 0 || $nilai > 100) {
        $pesanError = "Nilai harus antara 0 sampai 100!";
    } else {

        // Struktur kendali IF ELSE
        if ($nilai > 70) {
            $status = "Lulus";
        } elseif ($nilai < 70) {
            $status = "Remedial";
        } else {
            $status = "Belum ditentukan";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Penilaian Mahasiswa</title>
</head>
<body>

    <h2>Form Penilaian Ujian Mahasiswa</h2>

    <form method="POST" action="">
        <label>Nama Mahasiswa:</label><br>
        <input type="text" name="nama" required>
        <br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required>
        <br><br>

        <label>Nilai Ujian:</label><br>
        <input type="number" name="nilai"
               min="0" max="100" required>
        <br><br>

        <button type="submit">Proses Nilai</button>
    </form>

    <hr>

    <?php if ($pesanError != ""): ?>
        <p style="color:red;">
            <?= htmlspecialchars($pesanError) ?>
        </p>
    <?php endif; ?>

    <?php if ($status != ""): ?>
        <h3>Hasil Penilaian</h3>

        <p>Nama:
            <?= htmlspecialchars($nama) ?>
        </p>

        <p>Email:
            <?= htmlspecialchars($email) ?>
        </p>

        <p>Nilai Ujian:
            <?= htmlspecialchars((string)$nilai) ?>
        </p>

        <p>Status:
            <strong><?= htmlspecialchars($status) ?></strong>
        </p>
    <?php endif; ?>

</body>
</html>
