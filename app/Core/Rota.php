<?php

namespace app\Core;

class Rota
{
    private array $url = [];

    public function __construct()
    {
        $this->processarUrl();
    }

    public function processarUrl(): void
    {
        echo $url = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL);

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
}
