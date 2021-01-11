<?php
$configsFileName = 'configs.json';


$configsFilePath = __DIR__ . '/' . $configsFileName;


$configs = json_decode(file_get_contents($configsFilePath), true);


// mysql configuration
$host = $configs['host'] ?? 'localhost';

$port = $configs['port'] ?? 3306;

$charset = $configs['charset'] ?? 'utf8';

$user = $configs['user'] ?? 'dbuser';

$password = $configs['password'] ?? 'password';

$dbname = $configs['dbname'] ?? 'dbname';


// create pdo connection
$dsn = sprintf('mysql:host=%s;port=%d;dbname=%s;charset=%s', $host, $port, $dbname, $charset);
$pdo = new PDO($dsn, $user, $password);

// set error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);