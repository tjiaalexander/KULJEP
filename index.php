<?php
$success = false;

$hargaMenu = [
  // Makanan
  "Horog-horog"     => 12000,
  "Bongko Mento"    => 10000,
  "Singit"          => 20000,
  "Sop Udang"       => 25000,
  "Kuluban"         => 8000,
  "Lontong Krubyuk" => 15000,

  // Minuman
  "Gempol Pleret"   => 7000,
  "Adon Adon Coro"  => 7000,
  "Es Rumput Laut"  => 8000,
  "Kopi Tempur"     => 6000,
  "Wedang Blung"    => 9000,

  // Jajanan
  "Serta Kicak"     => 5000,
  "Rondho Royal"    => 6000,
  "Turuk Bintul"    => 7000,
  "Bontosan"        => 5000,
  "Moto Belong"     => 6000,
  "Carang Madu"     => 4000
];

$totalHarga = 0;
$pesanan = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nama    = htmlspecialchars($_POST['nama']);
  $wa      = htmlspecialchars($_POST['wa']);
  $alamat  = htmlspecialchars($_POST['alamat']);
  $catatan = htmlspecialchars($_POST['catatan']);

  foreach ($_POST['menu'] as $i => $menu) {
    $jumlah   = (int) $_POST['jumlah'][$i];
    $harga    = $hargaMenu[$menu] ?? 0;
    $subtotal = $harga * $jumlah;

    $totalHarga += $subtotal;

    $pesanan[] = [
      'menu'     => $menu,
      'jumlah'   => $jumlah,
      'subtotal' => $subtotal
    ];
  }

  $success = true;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KULJEP</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

<!-- ================= HEADER ================= -->
<header>
  <h1 class="logo">Kuliner Jepara</h1>
  <nav class="navbar a">
    <a href="#home">Beranda</a>
    <a href="#makanan">Makanan</a>
    <a href="#minuman">Minuman</a>
    <a href="#jajanan">Jajanan</a>
    <a href="#pesan">Pemesanan</a>
    <a href="#tentang">Tentang</a>
  </nav>
</header>

<!-- ================= HERO ================= -->
<section id="home" class="hero">
  <h1>Selamat datang di Jepara</h1>
  <p>Jelajahi kelezatan kuliner khas Jepara yang menggugah selera</p>
</section>

<!-- ================= MAKANAN ================= -->
<section id="makanan" class="container">
  <h2>Makanan Khas Jepara</h2>
  <p class="section-desc">
    Makanan khas Jepara terkenal dengan cita rasa gurih, tradisional,
    dan kaya rempah yang diwariskan secara turun-temurun.
  </p>
  <a href="makanan.php" class="btn-menu">Lihat Menu Makanan</a>
</section>

<!-- ================= MINUMAN ================= -->
<section id="minuman" class="container">
  <h2>Minuman Khas Jepara</h2>
  <p class="section-desc">
    Minuman khas Jepara cocok dinikmati hangat maupun dingin,
    dipercaya memiliki khasiat untuk kesehatan.
  </p>
  <a href="minuman.php" class="btn-menu">Lihat Menu Minuman</a>
</section>

<!-- ================= JAJANAN ================= -->
<section id="jajanan" class="container">
  <h2>Jajanan Khas Jepara</h2>
  <p class="section-desc">
    Aneka jajanan tradisional Jepara dengan rasa manis dan gurih,
    cocok untuk teman santai.
  </p>
  <a href="jajanan.php" class="btn-menu">Lihat Menu Jajanan</a>
</section>

<!-- ================= PEMESANAN ================= -->
<section id="pesan" class="order">
  <h2>Pemesanan</h2>

  <?php if (!$success): ?>
  <form method="POST" class="order-form">

    <div class="form-group">
      <label>Nama Lengkap</label>
      <input type="text" name="nama" placeholder="Joko Surapto" required>
    </div>

    <div class="form-group">
      <label>No. WhatsApp</label>
      <input type="tel" name="wa" placeholder="08xxxx" required>
    </div>

   <div id="menu-wrapper">
  <div class="menu-item">
    <select name="menu[]" class="menu" required>
      <option value="">Pilih Menu</option>

      <optgroup label="🍽️ Makanan">
        <option>Horog-horog</option>
        <option>Bongko Mento</option>
        <option>Singit</option>
        <option>Sop Udang</option>
        <option>Kuluban</option>
        <option>Lontong Krubyuk</option>
      </optgroup>

      <optgroup label="🥤 Minuman">
        <option>Gempol Pleret</option>
        <option>Adon Adon Coro</option>
        <option>Es Rumput Laut</option>
        <option>Kopi Tempur</option>
        <option>Wedang Blung</option>
      </optgroup>

      <optgroup label="🍩 Jajanan">
        <option>Serta Kicak</option>
        <option>Rondho Royal</option>
        <option>Turuk Bintul</option>
        <option>Bontosan</option>
        <option>Moto Belong</option>
        <option>Carang Madu</option>
      </optgroup>
    </select>

    <input type="number" name="jumlah[]" class="jumlah" min="1" value="1">

    <button type="button" class="hapus">✖</button>
  </div>

    <button type="button" id="tambahMenu">+ Tambah Menu</button>

    <div class="form-group">
      <label>Alamat</label>
      <input type="text" name="alamat" placeholder="Jl. Imam Bonjol" required>
    </div>

    <div class="form-group">
      <label>Catatan</label>
      <textarea name="catatan" placeholder="Porsinya setengah/Tidak Pedas/Es nya dikit aja"></textarea>
    </div>

    <div class="form-group">
      <label>Total Harga</label>
      <input type="text" id="totalHarga" readonly value="Rp 0">
    </div>

    <button type="submit">Pesan Sekarang</button>
  </form>
  <?php endif; ?>

  <?php if ($success): ?>
  <div class="success-card">
    <div class="badge">✔ Pesanan Berhasil</div>

    <h3>Terima kasih, <?= $nama ?> 🙌</h3>
    <p>Pesanan kamu sudah kami terima:</p>

    <ul>
      <li><strong>Alamat:</strong> <?= $alamat ?></li>
      <li><strong>WhatsApp:</strong> <?= $wa ?></li>
      <li><strong>Catatan:</strong> <?= $catatan ?: '-' ?></li>
    </ul>

    <ul>
      <?php foreach ($pesanan as $p): ?>
        <li>
          <?= $p['menu'] ?> (<?= $p['jumlah'] ?>x) -
          Rp <?= number_format($p['subtotal'], 0, ',', '.') ?>
        </li>
      <?php endforeach; ?>
    </ul>

    <strong>Total: Rp <?= number_format($totalHarga, 0, ',', '.') ?></strong>

    <br><br>
    <a href="index.php" class="btn-reset">Pesan Lagi</a>
  </div>
  <?php endif; ?>
</section>

<!-- ================= TENTANG ================= -->
<section id="tentang" class="about">
  <h2>Deskripsi</h2>
  <p>✨ Rasakan Kelezatan Khas Jepara! ✨</p>
  <p>🌿 Semua cita rasa ini adalah warisan kuliner pesisir.</p>
  <p>Dukung kuliner lokal Jepara—sekali coba, pasti ingin kembali!</p>
  <!-- ================= FOOTER ================= -->
<footer class="footer">
  <div class="footer-container">

    <!-- Info -->
    <div class="footer-info">
      <h3>Kuliner Jepara</h3>
      <img src="footer_hero.jpeg">
      <p>
        Menyajikan cita rasa khas Jepara yang autentik,  
        dari makanan tradisional hingga jajanan legendaris.
      </p>

      <label for="lokasi">📍 Pilih Rekomendasi Resto</label>
      <select id="lokasi" onchange="ubahMap()">
        <option value="jepara">Jepara Kota</option>
        <option value="alun">Sekitar Alun-Alun Jepara</option>
        <option value="pantai">Pantai Kartini</option>
        <option value="bandengan">Pantai Bandengan</option>
      </select>
    </div>

    <!-- Map -->
    <div class="footer-map">
      <iframe
        id="mapFrame"
        src="https://www.google.com/maps?q=Jepara%20Kota&output=embed"
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>

  </div>
</footer>
</section>

<!-- ================= FOOTER ================= -->
<footer>
  <p>&copy; 2025 Kuliner Jepara | @alexander</p>
</footer>

<!-- ================= SCRIPT ================= -->
<script>
const hargaMenu = {
  "Horog-horog": 12000,
  "Bongko Mento": 10000,
  "Singit": 20000,
  "Sop Udang": 25000,
  "Kuluban": 8000,
  "Lontong Krubyuk": 15000,
  "Gempol Pleret": 7000,
  "Adon Adon Coro": 7000,
  "Es Rumput Laut": 8000,
  "Kopi Tempur": 6000,
  "Wedang Blung": 9000,
  "Serta Kicak": 5000,
  "Rondho Royal": 6000,
  "Turuk Bintul": 7000,
  "Bontosan": 5000,
  "Moto Belong": 6000,
  "Carang Madu": 4000
};

const wrapper = document.getElementById("menu-wrapper");
const totalInput = document.getElementById("totalHarga");

function hitungTotal() {
  let total = 0;

  document.querySelectorAll(".menu-item").forEach(item => {
    const menu = item.querySelector(".menu").value;
    const jumlah = parseInt(item.querySelector(".jumlah").value) || 0;
    total += (hargaMenu[menu] || 0) * jumlah;
  });

  totalInput.value = "Rp " + total.toLocaleString("id-ID");
}

document.getElementById("tambahMenu").onclick = () => {
  const clone = wrapper.firstElementChild.cloneNode(true);
  clone.querySelector(".menu").value = "";
  clone.querySelector(".jumlah").value = 1;
  wrapper.appendChild(clone);
};

wrapper.addEventListener("input", hitungTotal);

wrapper.addEventListener("click", e => {
  if (e.target.classList.contains("hapus")) {
    if (wrapper.children.length > 1) {
      e.target.parentElement.remove();
      hitungTotal();
    }
  }
});
</script>

</body>

</html>
