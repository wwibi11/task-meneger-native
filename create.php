<?php
require 'config/database.php';
require 'helpers/functions.php';

$errors = [];
$data = ['judul'=>'', 'deskripsi'=>'', 'prioritas'=>'sedang', 'deadline'=>''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data['judul']     = trim($_POST['judul'] ?? '');
    $data['deskripsi'] = trim($_POST['deskripsi'] ?? '');
    $data['prioritas'] = $_POST['prioritas'] ?? 'sedang';
    $data['deadline']  = $_POST['deadline'] ?: null;

    // Validasi manual — nanti di Laravel jadi $request->validate()
    if ($data['judul'] === '') {
        $errors['judul'] = 'Judul wajib diisi.';
    }
    if (!in_array($data['prioritas'], ['rendah','sedang','tinggi'])) {
        $errors['prioritas'] = 'Prioritas tidak valid.';
    }
    if ($data['deadline'] && strtotime($data['deadline']) === false) {
        $errors['deadline'] = 'Format tanggal tidak valid.';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("
            INSERT INTO tasks (judul, deskripsi, prioritas, deadline)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$data['judul'], $data['deskripsi'],
                        $data['prioritas'], $data['deadline']]);
        header("Location: index.php");
        exit;
    }
}

$pageTitle = 'Tambah Tugas';
require 'includes/header.php';
?>

<form method="POST" class="form">
  <label>Judul *
    <input type="text" name="judul" value="<?= e($data['judul']) ?>">
    <?php if (isset($errors['judul'])): ?>
      <small class="text-danger"><?= e($errors['judul']) ?></small>
    <?php endif; ?>
  </label>

  <label>Deskripsi
    <textarea name="deskripsi" rows="4"><?= e($data['deskripsi']) ?></textarea>
  </label>

  <label>Prioritas
    <select name="prioritas">
      <?php foreach (['rendah','sedang','tinggi'] as $p): ?>
        <option value="<?= $p ?>" <?= $data['prioritas']===$p?'selected':'' ?>>
          <?= ucfirst($p) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </label>

  <label>Deadline
    <input type="date" name="deadline" value="<?= e($data['deadline'] ?? '') ?>">
  </label>

  <button class="btn-primary">Simpan</button>
  <a href="index.php">Batal</a>
</form>

<?php require 'includes/footer.php'; ?>