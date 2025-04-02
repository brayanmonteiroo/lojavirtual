<?php 

namespace app\Core;

final class Env 
{
    public static function load(string $arquivo = '../.env'): void
    {
        if(file_exists($arquivo)){
            $env = parse_ini_file($arquivo);
            foreach ($env as $chave => $valor){
                putenv("$chave=$valor");
                $_ENV[$chave] = $valor;
            }
        }else {
            throw new \RuntimeException("Arquivo .env não encontrado em ".$arquivo);
        }
    }
}
