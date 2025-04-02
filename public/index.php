<?php 

require __DIR__ . '../../vendor/autoload.php';

include_once '../app/Core/Rota.php';

use app\Core\Env;
$env = Env::load();

// use app\Core\Rota;

// $rota = new Rota();

use app\Core\Database;

$conn = Database::getConexao();