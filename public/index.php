<?php
require_once __DIR__ . '/../vendor/autoload.php';

session_start();

use Alexandre\Gesuas\Database;
use Alexandre\Gesuas\Model\Citizen;
use Alexandre\Gesuas\Model\NISGenerator;
use Alexandre\Gesuas\Model\CitizenRepository;

$db = Database::getInstance()->getConnection();
$repository = new CitizenRepository($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['name'])) {
    try {
        $name = trim($_POST['name']);

        if (empty($name)) {
            throw new \InvalidArgumentException("Nome não pode ser vazio");
        }

        if (strlen($name) > 100 || preg_match('/[0-9]/', $name)) {
            throw new \InvalidArgumentException("Dados inválidos no nome");
        }

        $nis = NISGenerator::generate();
        
        $citizen = new Citizen(null, $name, $nis);
        $repository->save($citizen);
        
        $_SESSION['success'] = "Cadastrado com sucesso! NIS: {$citizen->nis}";
    } catch (\Exception $e) {
        $_SESSION['error'] = "Erro: " . $e->getMessage();
    }
    
    header('Location: /');
    exit;
}

include __DIR__ . '/../templates/index.html';