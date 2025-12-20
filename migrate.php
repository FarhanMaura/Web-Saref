<?php
/**
 * Migrate Script for InfinityFree
 * Upload ke htdocs/, akses via browser, lalu HAPUS file ini!
 */

echo "<!DOCTYPE html><html><head><title>Run Migrations</title></head><body>";
echo "<h1>Run Migrations - InfinityFree</h1>";

$basePath = __DIR__ . '/../private_html';

// Load Laravel
require $basePath . '/vendor/autoload.php';
$app = require_once $basePath . '/bootstrap/app.php';

try {
    // Run migrations
    echo "<p>Running migrations...</p>";
    
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $status = $kernel->call('migrate', ['--force' => true]);
    
    if ($status === 0) {
        echo "<p style='color:green;'><strong>✓ Migrations berhasil!</strong></p>";
    } else {
        echo "<p style='color:red;'><strong>✗ Migrations gagal!</strong></p>";
    }
    
    // Show migrations
    echo "<h2>Migration Status:</h2>";
    ob_start();
    $kernel->call('migrate:status');
    $output = ob_get_clean();
    echo "<pre>$output</pre>";
    
} catch (Exception $e) {
    echo "<p style='color:red;'><strong>Error:</strong> " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<p style='color:red;'><strong>PENTING: Hapus file migrate.php ini setelah selesai!</strong></p>";
echo "</body></html>";
