<?php
    require __DIR__ . '/../../vendor/autoload.php';
    use Dotenv\Dotenv;

    class Conn {
        private static $instance;

        private static $db;
        private static $host;
        private static $dbname;
        private static $user;
        private static $password;
        private static $port;

        public static function loadEnv() {
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
            $dotenv->load();

            self::$db = $_ENV['DB_CONNECTION'];
            self::$host = $_ENV['DB_HOST'];
            self::$dbname = $_ENV['DB_NAME'];
            self::$user = $_ENV['DB_USER'];
            self::$password = $_ENV['DB_PASSWORD'];
            self::$port = $_ENV['DB_PORT'];
        }


        public static function getConn(){
            if(!isset(self::$instance)){
                self::loadEnv();
                try{
                    // MYSQL
                    // self::$instance = new PDO(self::$db.":host=".self::$host.";dbname=".self::$dbname, self::$user, self::$password);

                    // MariaDB
                    self::$instance = new PDO(
                        self::$db.":host=".self::$host.
                        ";port=".self::$port.
                        ";dbname=".self::$dbname.
                        ";charset=utf8mb4", 
                        self::$user, 
                        self::$password
                        );
                    self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch(PDOException $e){
                    die("Erro na conexão: ". $e->getMessage());
                }
            }
            return self::$instance;
        }

        public static function closeConn() {
            self::$instance = null;
        }    
    }
?>