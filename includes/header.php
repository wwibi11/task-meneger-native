<?php
// Pastikan helpers sudah di-load (biasanya sudah di file pemanggil)
// Kalau belum, aktifkan baris di bawah:
// require_once __DIR__ . '/../helpers/functions.php';

$pageTitle = $pageTitle ?? 'Task Manager';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?> — Task Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="app-header">
    <h1><a href="index.php">📝 Task Manager</a></h1>
    <nav>
        <a href="index.php">Daftar Tugas</a>
        <a href="create.php">Tambah Tugas</a>
    </nav>
</header>

<main class="app-main">