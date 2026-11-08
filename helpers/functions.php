<?php
function badgePrioritas(string $prioritas): string
{
    return match($prioritas) {
        'tinggi' => '<span class="badge badge-danger">Tinggi</span>',
        'sedang' => '<span class="badge badge-warning">Sedang</span>',
        'rendah' => '<span class="badge badge-success">Rendah</span>',
        default  => ''
    };
}

function isTerlambat(?string $deadline, string $status): bool
{
    if (!$deadline || $status === 'selesai') return false;
    return strtotime($deadline) < strtotime(date('Y-m-d'));
}

function formatTanggal(?string $tanggal): string
{
    if (!$tanggal) return '-';
    return date('d M Y', strtotime($tanggal));
}

function e(?string $str): string
{
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}