<?php

// MariaDB
$mysql = new mysqli("localhost", "root", "", "galeria");

// PostgreSQL
$pg = new PDO(
    "pgsql:host=localhost;dbname=galeria_pg",
    "postgres",
    "Vilchis2004"
);
?>