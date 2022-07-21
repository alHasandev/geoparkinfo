<?php

const NAMA_APLIKASI = "inv_bansos";
const HALAMAN_UTAMA = "home";
const NAMA_TTD      = "Nama TDD";
const NAMA_KOTA     = "Kuala Kapuas";

// list bulan
$list_bulan = [
  'Januari',
  'Februari',
  'Maret',
  'April',
  'Mei',
  'Juni',
  'Juli',
  'Agustus',
  'September',
  'Oktober',
  'November',
  'Desember'
];

function base_url($param = '')
{
  $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'] .  '/';
  $baseurl = $protocol . $domainName . NAMA_APLIKASI;

  return $baseurl . '/' . $param;
}

function page($page = 'home', $aksi = false, $id = null)
{
  $halaman = '?page=' . $page;

  if ($aksi) {
    $halaman .= '&aksi=' . $aksi;

    if ($id !== null) {
      $halaman .= '&id=' . $id;
    }
  }

  return base_url($halaman);
}

function redirect($page = false)
{
  if (!$page) {
    $page = HALAMAN_UTAMA;
  }

  header('Location: ' . page($page));
}

// buat fungsi untuk menghandle link active
function activeLink($page)
{
  // $endurl = $_GET['page'];
  $endurl = getPagename();

  $output = FALSE;
  if (!is_array($page)) {
    if ($page === $endurl) $output = TRUE;
  } else {
    foreach ($page as $pg) {
      if ($pg === $endurl) $output = TRUE;
    }
  }

  return $output;
}

// buat fungsi untuk mengambil nama halaman sekarang dari url
function getPagename()
{
  $endurl = explode('/', $_SERVER['REQUEST_URI']);

  $pagename = end($endurl);

  return str_replace('.php', '', $pagename);
}

// buat fungsi untuk mendapatkan list tahun 
function getYears($from = 0, $to = 0, $interval = 10)
{
  // buat nilai default untuk range tahun
  if ($from <= 0) $from = date('Y') + $from;
  if ($to <= 0) $to = date('Y') + $to + $interval;

  // buat batas perulangan
  // $max = $from - $to;

  // init data list tahun
  $years = [];

  // isi data list tahun
  for ($from; $from <= $to; $from++) {
    $years[] = $from;
  }

  return $years;
}

// buat fungsi untuk menkonversi urutan hari (angka) menjadi nama hari
function dayName($d)
{
  $days = [
    'Minggu',
    'Senin',
    'Selasa',
    'Rabu',
    'Kamis',
    'Jum\'at',
    'Sabtu'
  ];

  return $days[$d];
}

// buat fungsi untuk menampilkan angka dalam bentuk rupiah
function rupiah($angka, $n = 0)
{
  $hasil_rupiah = "Rp. " . number_format($angka, $n, ',', '.');
  return $hasil_rupiah;
}

// buat fungsi untuk memformat tanggal dari database
function tanggal($date, $format = 'd/m/Y')
{
  $date = date_create($date);
  return date_format($date, $format);
}

// khusus untuk keterangan pelunasan mutasi barang
function keterangan_mutasi($total_harga, $pembayaran)
{
  $sisa = $total_harga - $pembayaran;
  if ($sisa === 0) {
    $keterangan = 'Lunas';
  } else {
    $keterangan = 'Belum Lunas';
  }

  return $keterangan;
}

// Upload foto
function uploadFoto($file, $target_dir, $default_name = false)
{
  $default_file = $target_dir . "default.png";

  if (@$file['tmp_name']) {
    $name = $default_name ? $default_name : date('Y-m-d H-i-s');
    $target_file = $target_dir . basename($file["name"]);
    $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // atur nama file
    if (!!$default_name && $default_name !== $default_file) {
      $filename = $target_dir . $default_name . "." . $filetype;
    } else {
      $filename = $target_dir . $name . "." . $filetype;
    }

    $uploadOk = 1;

    // Check if image file is a actual image or fake image
    $check = getimagesize($file["tmp_name"]);
    if ($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }

    // Check if file already exists
    // if (file_exists($target_file)) {
    //   echo "Sorry, file already exists.";
    //   $uploadOk = 0;
    // }

    // Check file size
    if ($file["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if (
      $filetype != "jpg" && $filetype != "png" && $filetype != "jpeg"
      && $filetype != "gif"
    ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
      $filename = $default_file;
      // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($file["tmp_name"], "$filename")) {
        echo "The file " . htmlspecialchars(basename($name . "")) . " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
  } else {
    $filename = $default_file;
  }

  return $filename;
}

// Upload File
function uploadFile($file, $target_dir, $type, $max_size = 2000, $default_name = false)
{
  $default_file = $target_dir . "default." . $type;

  if (@$file['tmp_name']) {
    $name = $default_name ? $default_name : date('Y-m-d H-i-s');
    $target_file = $target_dir . basename($file["name"]);
    $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $uploadOk = 1;

    // check file type
    if ($type === $filetype) {
      $uploadOk = 1;
    } else {
      echo "File is extension is not .$type";
      echo "<br />";
      $uploadOk = 0;
    }

    echo "$type === $filetype";
    echo "<br />";

    // Check if file already exists
    // if (file_exists($target_file)) {
    //   echo "Sorry, file already exists.";
    //   $uploadOk = 0;
    // }

    // Check file size (kb)
    if ($file["size"] > ($max_size * 1024)) {
      echo "Sorry, your file is too large. " . $file['size'] / 1024 . "Kb";
      echo "<br />";
      $uploadOk = 0;
      return false;
    }

    // atur nama file
    if (!!$default_name && $default_name !== $default_file) {
      $filename = $target_dir . $default_name . "." . $type;
    } else {
      $filename = $target_dir . $name . "." . $type;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
      echo "<br />";
      $filename = $default_file;
      // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($file["tmp_name"], "$filename")) {
        echo "The file " . htmlspecialchars(basename($name . "")) . " has been uploaded.";
        echo "<br />";
      } else {
        echo "Sorry, there was an error uploading your file.";
        echo "<br />";
      }
    }
  } else {
    $filename = $default_file;
  }

  return $filename;
}

function selected($compare, $value)
{
  return  $compare == $value ? 'selected' : '';
}
