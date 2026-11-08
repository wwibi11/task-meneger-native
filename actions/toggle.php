<?php
require '../config/database.php';

$id     = $_GET['id'] ?? null;
$filter = $_GET['filter'] ?? 'semua';
$sort   = $_GET['sort']   ?? 'terbaru';

if ($id) {
    $pdo->prepare("
        UPDATE tasks
        SET status = IF(status='selesai','belum','selesai')
        WHERE id = ?
    ")->execute([$id]);
}

header("Location: ../index.php?filter=$filter&sort=$sort");