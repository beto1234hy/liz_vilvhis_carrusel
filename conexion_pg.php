<?php

try {

    $pg = new PDO(
        "pgsql:host=localhost;port=5432;dbname=galeria_pg",
        "postgres",
        "Vilchis2004"
    );

    $pg->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (Exception $e) {
    die("Error conexión PostgreSQL: " . $e->getMessage());
}

?>