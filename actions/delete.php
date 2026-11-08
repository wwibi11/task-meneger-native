<?php
require '../config/database.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $pdo->prepare("DELETE FROM tasks WHERE id = ?")->execute([$id]);
}
header("Location: ../index.php");