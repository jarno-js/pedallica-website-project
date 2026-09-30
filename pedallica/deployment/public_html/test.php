<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>PHP Test</h1>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";

echo "<h2>Testing Laravel bootstrap</h2>";
chdir('/home/pedallica/public_html');
require __DIR__ . '/../laravel-app/vendor/autoload.php';
echo "Autoload successful!<br>";

$app = require_once __DIR__ . '/../laravel-app/bootstrap/app.php';
echo "Bootstrap successful!<br>";
?>
