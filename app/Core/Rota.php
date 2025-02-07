<?php

namespace app\Core;

include '../app/Controllers/SobreController.php';
include '../app/Controllers/HomeController.php';
include '../app/Controllers/CategoriaController.php';



class Rota
{
    private array $url = [];
    private string $nomeControlador = 'HomeController';
    private object $controlador;
    private string $namespace = 'app\\Controllers\\';
    private string $metodo = 'index';
    private array $parametros = [];

    public function __construct()
    {
        $this->processarUrl();
        $this->inicializarControlador();
        $this->executarMetodo();
    }

    public function processarUrl(): void
    {
        $url = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL);
        // Decodifica caracteres da URL, convertendo %20 para espaços, por exemplo.
        $url = urldecode($url);
        // Remove espaços extras no início e no final e elimina a última barra, se houver.
        $url = trim(rtrim($url, '/'));
        // Remove todos os espaços dentro da URL.
        $url = str_replace(' ', '', $url);
        // // Remove caracteres indesejados, mantendo apenas letras, números, barras e hífens
        $url = preg_replace('/[^a-zA-Z0-9\/\-]/', '', $url);
        // Remove múltiplas barras consecutivas
        $url = preg_replace('/\/+/', '/', $url);
        // Divide a URL em partes usando a barra '/' como delimitador.
        $url = explode('/', $url);
        // Remove os três primeiros segmentos da URL (ajuste conforme necessário).
        $this->url = array_slice($url, 3);
    }

    private function inicializarControlador(): void
    {
        if (!empty($this->url[0])) {
            $controlador = ucwords($this->url[0]) . 'Controller';
            $controladorCompleto = $this->namespace . $controlador;
            if ($this->controladorExiste($controladorCompleto)) {
                $this->nomeControlador = $controlador;
                $this->url = array_values(array_slice($this->url, 1));
            } else {
                $this->paginaNaoEncontrada("O controlador '{$controlador}' não foi encontrado");
            }
        }

        $reflection = new \ReflectionClass($this->namespace.$this->nomeControlador);
        $this->controlador = $reflection->newInstance();
    }

    private function executarMetodo(): void
    {
        if (!empty($this->url[0]) && method_exists($this->controlador, $this->url[0])){
            $this->metodo = $this->url[0];
            $this->url = array_values(array_slice($this->url, 1));
        }

        $this->parametros = $this->url;

        $reflection = new \ReflectionMethod($this->controlador, $this->metodo);
        echo $reflection->invokeArgs($this->controlador, $this->parametros);
    }

    private function controladorExiste(string $controladorCompleto): bool
    {
        return class_exists($controladorCompleto);
    }

    private function paginaNaoEncontrada(string $mensagem = 'Página não encontrada'): void
    {
        http_response_code(404);
        echo $mensagem;
        exit();
    }
}
