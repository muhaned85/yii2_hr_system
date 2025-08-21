<?php

// Database configuration - supports SQLite for dev/CI and MySQL for production
$dbConfig = [
    'class' => 'yii\db\Connection',
    'charset' => 'utf8',
];

 
    // Production MySQL configuration
    $dbConfig['dsn'] = getenv('DATABASE_URL') ?: 'mysql:host=localhost;dbname=yii_hr_system';
    $dbConfig['username'] = getenv('DB_USERNAME') ?: 'root';
    $dbConfig['password'] = getenv('DB_PASSWORD') ?: '';
    
    // Schema cache options (for production environment)
    $dbConfig['enableSchemaCache'] = true;
    $dbConfig['schemaCacheDuration'] = 60;
    $dbConfig['schemaCache'] = 'cache';
 

return $dbConfig;
