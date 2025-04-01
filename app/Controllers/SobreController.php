<?php 

namespace app\Controllers;

use app\Core\View;

class SobreController
{
    public function index(): void
    {
        View::render('site/sobre', [
            'title' => 'Página Sobre'
        ]);
    }
}