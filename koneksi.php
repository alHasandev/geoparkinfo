<?php

$HOST = getenv('HOST') ?: 'localhost';
$USERNAME = getenv('USERNAME') ?: 'root';
$PASSWORD = getenv('PASSWORD') ?: 'root';
$DBNAME = getenv('DBNAME') ?: 'geopark';

$koneksi = new mysqli($HOST, $USERNAME, $PASSWORD, $DBNAME);

// Handle connection error
if ($koneksi->connect_error) {
  die("Connection failed: " . $koneksi->connect_error);
}
