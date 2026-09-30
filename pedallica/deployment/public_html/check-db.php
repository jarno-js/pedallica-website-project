<?php
echo "<h1>Database Check</h1>";
echo "<pre>";

try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=pedallica_pedallica',
        'pedallica_pedallica',
        'TRTV8YcmeDuDwsv2RtMV'
    );

    echo "✅ Database connection successful!\n\n";

    // Check tables
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo "Tables in database:\n";
    foreach ($tables as $table) {
        echo "  - $table\n";
    }

    if (empty($tables)) {
        echo "\n❌ No tables found! Import your SQL file.\n";
    }

} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage();
}

echo "</pre>";
?>
