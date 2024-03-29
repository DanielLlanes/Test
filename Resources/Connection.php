<?php

class Connection{

    private const HOST = 'mariadb';
    private const DB_NAME = 'prueba';
    private const USERNAME = 'prueba_web';
    private const PASSWORD = '123456';
    private const CHARSET = 'utf8mb4';
    private const DRIVER = 'mysql';

    public static function connect(){
        try {
                $pdoOptions = array(
                                        PDO::ATTR_EMULATE_PREPARES => FALSE,
                                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''
                                    );

                                    $link = new PDO(''.self::DRIVER.':host='.self::HOST.';dbname='.self::DB_NAME, self::USERNAME, self::PASSWORD, $pdoOptions);
                return $link;

        }catch(PDOException $e){
                echo "Fallo la conexión: " . $e->getMessage();
        }
    }
}