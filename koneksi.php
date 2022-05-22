<?php

$HOST = $_ENV['HOST'] ? $_ENV['HOST'] : 'localhost';
$USERNAME = $_ENV['USERNAME'] ? $_ENV['USERNAME'] : 'root';
$PASSWORD = $_ENV['PASSWORD'] ? $_ENV['PASSWORD'] : '';
$DBNAME = $_ENV['DBNAME'] ? $_ENV['DBNAME'] : 'geopark';

$koneksi = new mysqli($HOST, $USERNAME, $PASSWORD, $DBNAME);

// Handle connection error
if ($koneksi->connect_error) {
  die("Connection failed: " . $koneksi->connect_error);
}
