<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/models/Database.php';

$db = new Database();
$pdo = $db->getConnection();