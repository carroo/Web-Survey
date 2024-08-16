-- Tabel untuk menyimpan informasi pengguna (user)
CREATE TABLE Pengguna (
  id_pengguna INT PRIMARY KEY AUTO_INCREMENT,
  nama_pengguna VARCHAR(100) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role INT DEFAULT 1
);

-- Tabel untuk menyimpan survei
CREATE TABLE Survei (
  id_survei INT PRIMARY KEY AUTO_INCREMENT,
  id_pengguna INT,
  judul VARCHAR(255) NOT NULL,
  deskripsi TEXT,
  tanggal_mulai DATETIME,
  tanggal_selesai DATETIME,
  FOREIGN KEY (id_pengguna) REFERENCES Pengguna(id_pengguna) ON DELETE CASCADE
);

-- Tabel untuk menyimpan pertanyaan pada setiap survei
CREATE TABLE Pertanyaan (
  id_pertanyaan INT PRIMARY KEY AUTO_INCREMENT,
  id_survei INT,
  teks_pertanyaan TEXT,
  gambar_pertanyaan VARCHAR(255),
  tipe_pertanyaan VARCHAR(50),
  FOREIGN KEY (id_survei) REFERENCES Survei(id_survei) ON DELETE CASCADE
);

-- Tabel untuk menyimpan opsi pilihan pada pertanyaan pilihan ganda atau checkbox
CREATE TABLE Opsi (
  id_opsi INT PRIMARY KEY AUTO_INCREMENT,
  id_pertanyaan INT,
  teks_opsi TEXT,
  FOREIGN KEY (id_pertanyaan) REFERENCES Pertanyaan(id_pertanyaan) ON DELETE CASCADE
);

-- Tabel untuk menyimpan respons setiap pengguna terhadap survei
CREATE TABLE Respons (
  id_respons INT PRIMARY KEY AUTO_INCREMENT,
  id_pengguna INT,
  id_survei INT,
  waktu_pengiriman DATETIME,
  FOREIGN KEY (id_pengguna) REFERENCES Pengguna(id_pengguna) ON DELETE CASCADE,
  FOREIGN KEY (id_survei) REFERENCES Survei(id_survei) ON DELETE CASCADE
);

-- Tabel untuk menyimpan jawaban pada setiap pertanyaan dalam survei
CREATE TABLE Jawaban (
  id_jawaban INT PRIMARY KEY AUTO_INCREMENT,
  id_respons INT,
  id_pertanyaan INT,
  id_opsi_terpilih INT, -- Hanya untuk pertanyaan pilihan ganda atau checkbox
  teks_jawaban TEXT,
  path_unggahan_file VARCHAR(255), -- Kolom untuk menyimpan path file yang diunggah
  FOREIGN KEY (id_respons) REFERENCES Respons(id_respons) ON DELETE CASCADE,
  FOREIGN KEY (id_pertanyaan) REFERENCES Pertanyaan(id_pertanyaan) ON DELETE CASCADE,
  FOREIGN KEY (id_opsi_terpilih) REFERENCES Opsi(id_opsi) ON DELETE CASCADE
);

-- Dummy data untuk pengguna
INSERT INTO Pengguna (nama_pengguna, email, password, role) VALUES
('Adi', 'user1@gmail.com', '$2y$10$HgsekS/meVqiXioa9N42M.3GAQ618z.6gjSqfaJh14bszQkzVGIyq', 1),
('Budi', 'user2@gmail.com', '$2y$10$HgsekS/meVqiXioa9N42M.3GAQ618z.6gjSqfaJh14bszQkzVGIyq', 1),
('Caca', 'user3@gmail.com', '$2y$10$HgsekS/meVqiXioa9N42M.3GAQ618z.6gjSqfaJh14bszQkzVGIyq', 1),
('Admin', 'admin@gmail.com', '$2y$10$HgsekS/meVqiXioa9N42M.3GAQ618z.6gjSqfaJh14bszQkzVGIyq', 0);

-- Dummy data untuk survei
INSERT INTO Survei (id_pengguna, judul, deskripsi, tanggal_mulai, tanggal_selesai) VALUES
(1, 'Survei Kepuasan Pelanggan', 'Survei tentang kepuasan pelanggan terhadap produk kami.', '2023-07-21 10:00:00', '2023-07-28 18:00:00'),
(2, 'Survei Kegiatan Olahraga', 'Survei tentang preferensi kegiatan olahraga di masyarakat.', '2023-08-05 09:00:00', '2023-08-12 23:59:59');

-- Dummy data untuk pertanyaan
INSERT INTO Pertanyaan (id_survei, teks_pertanyaan, tipe_pertanyaan) VALUES
(1, 'Bagaimana pendapat Anda tentang kualitas produk kami?', 'pilihan_ganda'),
(1, 'Tuliskan komentar atau saran untuk perbaikan produk kami.', 'essai'),
(2, 'Pilih kegiatan olahraga favorit Anda (boleh pilih lebih dari satu).', 'checkbox'),
(2, 'Apakah Anda berpartisipasi dalam lomba lari sebelumnya?', 'pilihan_ganda');

-- Dummy data untuk opsi (opsional - untuk pertanyaan pilihan_ganda atau checkbox)
INSERT INTO Opsi (id_pertanyaan, teks_opsi) VALUES
(1, 'Sangat Puas'),
(1, 'Puas'),
(1, 'Cukup Puas'),
(2, ''),
(4, 'Ya'),
(4, 'Tidak');

-- Dummy data untuk respons
INSERT INTO Respons (id_pengguna, id_survei, waktu_pengiriman) VALUES
(1, 1, '2023-07-25 15:30:00'),
(2, 1, '2023-07-28 09:45:00'),
(3, 2, '2023-08-10 11:00:00');

-- Dummy data untuk pertanyaan tipe checkbox
-- Opsi terkait dengan pertanyaan ID_pertanyaan 3
INSERT INTO Pertanyaan (id_survei, teks_pertanyaan, tipe_pertanyaan) VALUES
(2, 'Pilih kegiatan olahraga favorit Anda (boleh pilih lebih dari satu).', 'checkbox');

-- Dummy data untuk opsi pertanyaan tipe checkbox
INSERT INTO Opsi (id_pertanyaan, teks_opsi) VALUES
(5, 'Sepak Bola'),
(5, 'Berenang'),
(5, 'Basket'),
(5, 'Bulu Tangkis');

-- Dummy data untuk jawaban pada pertanyaan tipe checkbox
-- Jawaban responden 1 memilih opsi 1 dan 3
-- Jawaban responden 2 memilih opsi 1, 2, dan 3
-- Jawaban responden 3 memilih opsi 1, 2, 3, dan 4
INSERT INTO Jawaban (id_respons, id_pertanyaan, id_opsi_terpilih) VALUES
(1, 5, 7),
(1, 5, 9),
(2, 5, 7),
(2, 5, 8),
(2, 5, 9),
(3, 5, 7),
(3, 5, 8),
(3, 5, 9),
(3, 5, 10);

-- Dummy data untuk jawaban pada pertanyaan lainnya
INSERT INTO Jawaban (id_respons, id_pertanyaan, id_opsi_terpilih, teks_jawaban) VALUES
(1, 1, 1, NULL),
(1, 2, NULL, 'Terima kasih atas produk yang bagus.'),
(2, 1, 2, NULL),
(2, 2, NULL, 'Produknya sangat memuaskan.'),
(2, 4, 2, NULL),
(3, 3, 1, NULL);
