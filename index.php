<?php
require 'config/database.php';
require 'helpers/functions.php';

// --- FILTER ---
$filter = $_GET['filter'] ?? 'semua';
$where  = '';
if ($filter === 'belum')   $where = "WHERE status = 'belum'";
if ($filter === 'selesai') $where = "WHERE status = 'selesai'";

// --- SORTING (whitelist biar aman dari SQL Injection) ---
$sortMap = [
    'deadline'  => 'deadline IS NULL, deadline ASC',
    'prioritas' => "FIELD(prioritas, 'tinggi','sedang','rendah')",
    'terbaru'   => 'created_at DESC',
];
$sortKey  = $_GET['sort'] ?? 'terbaru';
$orderBy  = $sortMap[$sortKey] ?? $sortMap['terbaru'];

$tasks = $pdo->query("SELECT * FROM tasks $where ORDER BY $orderBy")->fetchAll();

// --- STATISTIK ---
$total    = $pdo->query("SELECT COUNT(*) FROM tasks")->fetchColumn();
$selesai  = $pdo->query("SELECT COUNT(*) FROM tasks WHERE status='selesai'")->fetchColumn();
$belum    = $total - $selesai;
$terlambat= $pdo->query("
    SELECT COUNT(*) FROM tasks
    WHERE status='belum' AND deadline IS NOT NULL AND deadline < CURDATE()
")->fetchColumn();

$pageTitle = 'Daftar Tugas';
require 'includes/header.php';
?>

<div class="stats">
  <div class="stat-card">Total: <strong><?= $total ?></strong></div>
  <div class="stat-card">Selesai: <strong><?= $selesai ?></strong></div>
  <div class="stat-card">Belum: <strong><?= $belum ?></strong></div>
  <div class="stat-card danger">Terlambat: <strong><?= $terlambat ?></strong></div>
</div>

<div class="toolbar">
  <div class="filters">
    <a href="?filter=semua&sort=<?= e($sortKey) ?>"
       class="<?= $filter==='semua'?'active':'' ?>">Semua</a>
    <a href="?filter=belum&sort=<?= e($sortKey) ?>"
       class="<?= $filter==='belum'?'active':'' ?>">Belum</a>
    <a href="?filter=selesai&sort=<?= e($sortKey) ?>"
       class="<?= $filter==='selesai'?'active':'' ?>">Selesai</a>
  </div>

  <form method="GET" class="sort-form">
    <input type="hidden" name="filter" value="<?= e($filter) ?>">
    <select name="sort" onchange="this.form.submit()">
      <option value="terbaru"  <?= $sortKey==='terbaru'?'selected':'' ?>>Terbaru</option>
      <option value="deadline" <?= $sortKey==='deadline'?'selected':'' ?>>Deadline terdekat</option>
      <option value="prioritas"<?= $sortKey==='prioritas'?'selected':'' ?>>Prioritas tertinggi</option>
    </select>
  </form>
</div>

<table class="task-table">
  <thead>
    <tr>
      <th>Status</th><th>Judul</th><th>Prioritas</th>
      <th>Deadline</th><th>Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php if (empty($tasks)): ?>
    <tr><td colspan="5" class="empty">Belum ada tugas.</td></tr>
  <?php endif; ?>

  <?php foreach ($tasks as $t): ?>
    <?php $late = isTerlambat($t['deadline'], $t['status']); ?>
    <tr class="<?= $t['status']==='selesai'?'done':'' ?> <?= $late?'late':'' ?>">
      <td>
        <a href="actions/toggle.php?id=<?= $t['id'] ?>&filter=<?= e($filter) ?>&sort=<?= e($sortKey) ?>"
           class="toggle">
          <?= $t['status']==='selesai' ? '✅' : '⬜' ?>
        </a>
      </td>
      <td>
        <strong><?= e($t['judul']) ?></strong>
        <?php if ($t['deskripsi']): ?>
          <div class="desc"><?= e($t['deskripsi']) ?></div>
        <?php endif; ?>
      </td>
      <td><?= badgePrioritas($t['prioritas']) ?></td>
      <td>
        <?= formatTanggal($t['deadline']) ?>
        <?php if ($late): ?><br><small class="text-danger">Terlambat!</small><?php endif; ?>
      </td>
      <td>
        <a href="edit.php?id=<?= $t['id'] ?>">Edit</a>
        <a href="actions/delete.php?id=<?= $t['id'] ?>"
           onclick="return confirm('Hapus tugas ini?')">Hapus</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<a href="create.php" class="btn-primary">+ Tambah Tugas</a>

<?php require 'includes/footer.php'; ?>