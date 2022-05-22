<h2>Test Koneksi</h2>

<?php include "koneksi.php" ?>

<?php

echo json_encode([
  "HOST" => $HOST,
  "USERNAME" => $USERNAME,
  "PASSWORD" => $PASSWORD,
  "DBNAME" => $DBNAME
]);

?>

<!-- Test koneksi -->