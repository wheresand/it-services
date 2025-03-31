<?php
namespace App\class;

use Dotenv\Dotenv;
use PDO;
use PDOException;

class Database
{
    private static $connection = null;

    // Private method to establish and return the PDO connection
    private static function getConnection()
    {
        if (self::$connection === null) {
            // Load environment variables
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
            $dotenv->load();

            $connection = $_ENV['DB_CONNECTION'];
            $host = $_ENV['DB_HOST'];
            $user = $_ENV['DB_USER'];
            $password = $_ENV['DB_PASS'];
            $dbname = $_ENV['DB_NAME'];
            $port = $_ENV['DB_PORT'];

            try {
                // Establish the PDO connection
                $dsn = "$connection:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
                self::$connection = new PDO($dsn, $user, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                error_log("Database connection error: " . $e->getMessage());
                throw new \Exception("Database connection failed. Please contact the administrator.");
            }
        }

        return self::$connection;
    }

    // Public method to get the connection
    public static function db()
    {
        return self::getConnection();
    }

    // Optionally, you can add a method to close the connection
    public static function close()
    {
        self::$connection = null;
    }
}
