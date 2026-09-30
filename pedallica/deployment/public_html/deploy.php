<?php
echo "<h1>Pedallica Deployment Script</h1>";
echo "<pre>";

chdir('/home/pedallica/laravel-app');
echo "Changed directory to laravel-app\n\n";

echo "=== Generating Application Key ===\n";
system('php artisan key:generate 2>&1');
echo "\n";

echo "=== Running Migrations ===\n";
system('php artisan migrate --force 2>&1');
echo "\n";

echo "=== Creating Storage Link ===\n";
system('php artisan storage:link 2>&1');
echo "\n";

echo "=== Setting Permissions ===\n";
system('chmod -R 755 storage bootstrap/cache 2>&1');
echo "\n";

echo "=== DONE! ===\n";
echo "Please delete this file (deploy.php) for security!\n";
echo "</pre>";
?>
