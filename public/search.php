<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Alexandre\Gesuas\Database;
use Alexandre\Gesuas\Model\CitizenRepository;

$db = Database::getInstance()->getConnection();
$repository = new CitizenRepository($db);

$nis = $_GET['nis'] ?? '';

// Validação do NIS (11 dígitos numéricos)
if (!preg_match('/^\d{11}$/', $nis)) {
    $error = "NIS inválido: deve conter 11 dígitos";
    include __DIR__ . '/../templates/result.html';
    exit;
}

$citizen = $repository->findByNis($nis);
include __DIR__ . '/../templates/result.html';