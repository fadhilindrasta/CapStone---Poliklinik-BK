<?php

$database = new mysqli("localhost", "root", "", "poliklinik_db");
if ($database->connect_error) {
    die("Connection failed:  " . $database->connect_error);
}
