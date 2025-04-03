<?php
namespace app\Controllers;

use app\Core\View;
use app\Model\CategoriaModel as Categorias;
use app\Model\ProdutoModel as Produtos;

class HomeController
{

    public function index(): void
    {

        $produtos = Produtos::buscar();
        $categorias = Categorias::buscar();

        View::render('site/home', [
            'title' => 'Página Home',
            'produtos' => $produtos
        ]);
    }
}
