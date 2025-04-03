<?php
namespace app\Controllers;

use app\Core\View;
use app\Model\CategoriaModel as Categoria;
use app\Model\ProdutoModel as Produto;

class HomeController
{

    public function index(): void
    {

        // $produto = Produto::buscar();
        // var_dump($produto);

        $categoria = Categoria::buscar();
        var_dump($categoria);

        // View::render('site/home', [
        //     'title' => 'Página Home'
        // ]);
    }
}
