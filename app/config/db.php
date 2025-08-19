<?php

// Database configuration - supports SQLite for dev/CI and MySQL for production
$dbConfig = [
    'class' => 'yii\db\Connection',
    'charset' => 'utf8',
];

// Use SQLite for development/CI environment
if (getenv('YII_ENV') !== 'prod' && getenv('DATABASE_URL') === false) {
    $dbConfig['dsn'] = 'sqlite:' . __DIR__ . '/../runtime/hr_system.db';
} else {
    // Production MySQL configuration
    $dbConfig['dsn'] = getenv('DATABASE_URL') ?: 'mysql:host=localhost;dbname=hr_system';
    $dbConfig['username'] = getenv('DB_USERNAME') ?: 'root';
    $dbConfig['password'] = getenv('DB_PASSWORD') ?: '';
    
    // Schema cache options (for production environment)
    $dbConfig['enableSchemaCache'] = true;
    $dbConfig['schemaCacheDuration'] = 60;
    $dbConfig['schemaCache'] = 'cache';
}

return $dbConfig;
