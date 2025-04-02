<?php 

namespace app\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $conexao = null;

    private function __clone(): void
    {
        
    }

    public static function getConexao(): PDO 
    {
        if(self::$conexao === null){
            try {
                $host = getenv('DB_HOST');
                $banco = getenv('DB_NAME');
                $usuario = getenv('DB_USER');
                $senha = getenv('DB_PASS');
                $charset = getenv('DB_CHARSET');

                $dsn = "mysql:host=$host;dbname=$banco;charset=$charset";

                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ                    
                ];

                self::$conexao = new PDO($dsn, $usuario, $senha, $options);
                echo 'Conexão ok';
            } catch (PDOException $ex) {
                throw new PDOException("Erro conexão: ". $ex);
            }
        }
        return self::$conexao;
    }

}