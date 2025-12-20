<?php
/**
 * Clear Cache Script for InfinityFree
 * Upload ke htdocs/, akses via browser, lalu hapus file ini
 */

echo "<h1>Clear Cache - InfinityFree</h1>";

$basePath = __DIR__ . '/../private_html';

// Clear config cache
$configCache = $basePath . '/bootstrap/cache/config.php';
if (file_exists($configCache)) {
    unlink($configCache);
    echo "✓ Config cache cleared<br>";
} else {
    echo "- Config cache not found<br>";
}

// Clear route cache
$routeCache = $basePath . '/bootstrap/cache/routes-v7.php';
if (file_exists($routeCache)) {
    unlink($routeCache);
    echo "✓ Route cache cleared<br>";
} else {
    echo "- Route cache not found<br>";
}

// Clear view cache
$viewPath = $basePath . '/storage/framework/views';
if (is_dir($viewPath)) {
    $files = glob($viewPath . '/*');
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
    echo "✓ View cache cleared (" . count($files) . " files)<br>";
}

// Clear cache files
$cachePath = $basePath . '/storage/framework/cache/data';
if (is_dir($cachePath)) {
    $files = glob($cachePath . '/*/*');
    $count = 0;
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
            $count++;
        }
    }
    echo "✓ Cache files cleared ($count files)<br>";
}

// Clear sessions
$sessionPath = $basePath . '/storage/framework/sessions';
if (is_dir($sessionPath)) {
    $files = glob($sessionPath . '/*');
    foreach ($files as $file) {
        if (is_file($file) && basename($file) != '.gitignore') {
            unlink($file);
        }
    }
    echo "✓ Sessions cleared (" . count($files) . " files)<br>";
}

echo "<br><strong>Cache cleared successfully!</strong><br>";
echo "<br><em style='color:red;'>IMPORTANT: Delete this file (clear-cache.php) after use!</em>";
