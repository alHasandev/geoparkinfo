<?php

$HOST = getenv('HOST') ?: 'localhost';
$USERNAME = getenv('USERNAME') ?: 'root';
$PASSWORD = getenv('PASSWORD') ?: 'root';
$DBNAME = getenv('DBNAME') ?: 'geopark';

$koneksi = new mysqli($HOST, $USERNAME, $PASSWORD, $DBNAME);
