<?php

// Import koneksi
$filename = uploadFile($_FILES['gltf'], 'files/', 'gltf', 10000, $_POST['title']);

die;
if (!$filename) {
}

$query = "INSERT INTO gltf (title, file, description) VALUE ('$_POST[title]', '$filename', '$_POST[description]')";

$koneksi->query($query);

header('location: /geoparkinfo?page=gltf&file=form');
