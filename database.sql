CREATE DATABASE IF NOT EXISTS task_manager;
USE task_manager;

CREATE TABLE IF NOT EXISTS tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  judul VARCHAR(150) NOT NULL,
  deskripsi TEXT,
  prioritas ENUM('rendah','sedang','tinggi') DEFAULT 'sedang',
  status ENUM('belum','selesai') DEFAULT 'belum',
  deadline DATE NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);