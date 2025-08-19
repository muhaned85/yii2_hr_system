<?php
// Simple test page
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/web.php';

echo "Basic PHP test - OK\n";
echo "Checking if models work:\n";

// Test database connection
try {
    $config = require __DIR__ . '/../config/web.php';
    $app = new \yii\web\Application($config);
    
    // Test basic model
    $count = \app\modules\bank\models\Bank::find()->count();
    echo "Banks count: $count\n";
    
    echo "All tests passed!\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
?>