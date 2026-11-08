<?php
require 'config/database.php';
require 'helpers/functions.php';

$id = $_GET['id'] ?? null;
if (!$id) { header("Location: index.php"); exit; }

$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if (!$data) { header("Location: index.php"); exit; }

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data['judul']     = trim($_POST['judul'] ?? '');
    $data['deskripsi'] = trim($_POST['deskripsi'] ?? '');
    $data['prioritas'] = $_POST['prioritas'] ?? 'sedang';
    $data['deadline']  = $_POST['deadline'] ?: null;

    if ($data['judul'] === '') $errors['judul'] = 'Judul wajib diisi.';

    if (empty($errors)) {
        $stmt = $pdo->prepare("
            UPDATE tasks SET judul=?, deskripsi=?, prioritas=?, deadline=?
            WHERE id=?
        ");
        $stmt->execute([$data['judul'], $data['deskripsi'],
                        $data['prioritas'], $data['deadline'], $id]);
        header("Location: index.php");
        exit;
    }
}

$pageTitle = 'Edit Tugas';
require 'includes/header.php';
?>
<!-- form sama persis dengan create.php, tinggal action-nya ke edit.php?id=... -->
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
  <button class="btn-primary">Update</button>
  <a href="index.php">Batal</a>
</form>
<?php require 'includes/footer.php'; ?>