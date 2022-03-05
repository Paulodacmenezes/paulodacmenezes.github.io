<?php
$host = 'localhost';
$dbname = 'horario';
$user = 'root';
$password = '';
$dns = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES => false
];
try {
  $pdo = new PDO($dns, $user, $password, $options);
  return $pdo;
} catch (PDOException $e) {
  die($e->getMessage());
}