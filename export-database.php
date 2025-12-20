<?php
/**
 * Export Database Script
 * Jalankan di local: http://localhost/export-database.php
 */

// Database config dari .env
$host = '127.0.0.1';
$user = 'root';
$pass = '';
$dbname = 'main'; // Database name dari .env Anda

$filename = 'database_import.sql';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get all tables
    $tables = [];
    $result = $pdo->query("SHOW TABLES");
    while ($row = $result->fetch(PDO::FETCH_NUM)) {
        $tables[] = $row[0];
    }
    
    // Start export
    $output = "-- Database Export for InfinityFree\n";
    $output .= "-- Generated: " . date('Y-m-d H:i:s') . "\n\n";
    $output .= "SET FOREIGN_KEY_CHECKS=0;\n";
    $output .= "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n";
    $output .= "SET time_zone = \"+00:00\";\n\n";
    
    foreach ($tables as $table) {
        // Drop table
        $output .= "DROP TABLE IF EXISTS `$table`;\n";
        
        // Create table
        $result = $pdo->query("SHOW CREATE TABLE `$table`");
        $row = $result->fetch(PDO::FETCH_NUM);
        $output .= $row[1] . ";\n\n";
        
        // Insert data
        $result = $pdo->query("SELECT * FROM `$table`");
        $rowCount = 0;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $output .= "INSERT INTO `$table` VALUES (";
            $values = [];
            foreach ($row as $value) {
                if ($value === null) {
                    $values[] = 'NULL';
                } else {
                    $values[] = $pdo->quote($value);
                }
            }
            $output .= implode(', ', $values) . ");\n";
            $rowCount++;
        }
        if ($rowCount > 0) {
            $output .= "\n";
        }
    }
    
    $output .= "SET FOREIGN_KEY_CHECKS=1;\n";
    
    // Save file
    file_put_contents($filename, $output);
    
    echo "<!DOCTYPE html><html><head><title>Export Database</title></head><body>";
    echo "<h1>✓ Database Export Berhasil!</h1>";
    echo "<p><strong>File:</strong> $filename</p>";
    echo "<p><strong>Size:</strong> " . number_format(filesize($filename)) . " bytes</p>";
    echo "<p><strong>Tables:</strong> " . count($tables) . "</p>";
    echo "<p><a href='$filename' download style='background:#4CAF50;color:white;padding:10px 20px;text-decoration:none;border-radius:5px;'>Download File</a></p>";
    echo "<hr><p><em>Upload file ini ke InfinityFree via phpMyAdmin</em></p>";
    echo "</body></html>";
    
} catch (PDOException $e) {
    echo "<!DOCTYPE html><html><head><title>Export Failed</title></head><body>";
    echo "<h1>✗ Export Gagal</h1>";
    echo "<p style='color:red;'><strong>Error:</strong> " . $e->getMessage() . "</p>";
    echo "<p>Pastikan database config benar di file ini (line 8-11).</p>";
    echo "</body></html>";
}
