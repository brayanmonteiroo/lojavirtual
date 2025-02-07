<?php 

namespace app\Controllers;

class CategoriaController
{
    public  function index(string $slug, int $id): void
    {
        echo 'Estou na controller Categoria!';
    }
}