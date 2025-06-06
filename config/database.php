<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ob_start();

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$DB_HOST = $_ENV['DB_HOST'];
$DB_NAME = $_ENV['DB_NAME'];
$DB_USER = $_ENV['DB_USER'];
$DB_PASS = $_ENV['DB_PASS'];


function new_PDO_connection(): ?PDO
{
    static $conn = null;
    global $DB_PASS, $DB_HOST, $DB_USER, $DB_NAME;

    if ($conn === null) {
        try {

            $conn = new PDO("mysql:host=$DB_HOST;charset=utf8mb4", $DB_USER, $DB_PASS);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $conn->exec("CREATE DATABASE IF NOT EXISTS `$DB_NAME` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");

            $conn->exec("USE `$DB_NAME`");

        } catch (PDOException $e) {
            file_put_contents('/home/mhri/issue.log', $e->getMessage() . "\n", FILE_APPEND);
            return null;
        }
    }

    return $conn;
}

