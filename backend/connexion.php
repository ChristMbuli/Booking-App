<?php

try {
    $conn = new PDO('mysql:host=localhost;dbname=immoapp;charset=utf8;', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die ('Erreur de connexion : ' . $e->getMessage());
}