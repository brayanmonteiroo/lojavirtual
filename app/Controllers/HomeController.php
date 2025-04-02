<?php
namespace app\Controllers;

use app\Core\View;

class HomeController
{

    public function index(): void
    {
        View::render('site/home', []);
    }
}
