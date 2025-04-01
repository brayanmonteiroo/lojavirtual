<?php 

namespace app\Core;

class View
{
    public static function render(string $view, array $dados = []): void
    {
        extract($dados);

        ob_start();

        $arquivo = '../app/Views/'.$view.'.php';
        if(file_exists($arquivo)){
            require_once $arquivo;
        }else {
            die("A view {$view} não foi encontrada!");
        }

        $conteudo = ob_get_clean();

        $base = strtok($view, '/');
        $arquivoBase = '../app/Views/'.$base.'/base.php';
        if(file_exists($arquivoBase)){
            require_once $arquivoBase;
        }else {
            die("O layout base não foi encontrado!");
        }
    }
}