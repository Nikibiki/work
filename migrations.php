<?
use app\core\App;
use app\controllers\SiteController;
use app\controllers\AuthController;

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
// 2:01:30


$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ],
];


$app = new App( __DIR__, $config );

$app->db->applyMigrations();
