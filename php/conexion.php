<?php

// MariaDB
$mysql = new mysqli("localhost", "galeria_user", "12345678", "galeria");

// PostgreSQL
$pg = new PDO(
    "pgsql:host=localhost;dbname=galeria_pg",
    "postgres",
    "Vilchis2004"
);
?>