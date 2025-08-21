<?php

// Database configuration - supports SQLite for dev/CI and MySQL for production
$dbConfig = [
    'class' => 'yii\db\Connection',
    'charset' => 'utf8',
];

// Check if we should use MySQL (production) or SQLite (development/testing)
if (getenv('DATABASE_URL') || getenv('YII_ENV') === 'prod') {
    // Production MySQL configuration
    $dbConfig['dsn'] = getenv('DATABASE_URL') ?: 'mysql:host=localhost;dbname=yii_hr_system';
    $dbConfig['username'] = getenv('DB_USERNAME') ?: 'root';
    $dbConfig['password'] = getenv('DB_PASSWORD') ?: '';
    
    // Schema cache options (for production environment)
    $dbConfig['enableSchemaCache'] = true;
    $dbConfig['schemaCacheDuration'] = 60;
    $dbConfig['schemaCache'] = 'cache';
} else {
    // Development/Testing SQLite configuration
    $dbConfig['dsn'] = 'sqlite:' . __DIR__ . '/../runtime/hr_system.db';
    $dbConfig['charset'] = 'utf8';
}

return $dbConfig;
