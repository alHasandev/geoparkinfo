<?php

require_once 'app/koneksi.php';

// Reset database tables
$query = "SELECT table_name FROM information_schema.tables WHERE table_schema = 'db_simpeg'";
$tables = $conn->query($query);
while ($data = $tables->fetch_assoc()) {
  echo "Deleting... " . $data['table_name'];
  $conn->query("DROP TABLE $data[table_name]");
  echo "\n";
}
echo "Successfully... All tables is deleted!";
echo "\n";

// Import database
// $query = file_get_contents('database/db_simpeg.sql');
echo "Importing... db_simpeg.sql";
echo "\n";

$templine = "";
$lines = file('database/db_simpeg.sql');
foreach ($lines as $line) {
  if (substr($line, 0, 2) == '--' || $line == '') continue;

  $templine .= $line;
  if (substr(trim($line), -1, 1) == ';') {
    $conn->query($templine);
    $templine = "";
  }
}

echo "Successfuly... database is imported!";
