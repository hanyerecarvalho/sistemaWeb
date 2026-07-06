<?php

require __DIR__ . '/../../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

// IMPORTAR A CLASSE
use src\produto\Produto;

$app = AppFactory::create();

$app->post('/produtos', function (Request $request, Response $response) {

    $dados = $request->getParsedBody();

    $produtos = [];

    for ($i = 1; $i <= 5; $i++) {

        $nome = $dados["nome$i"] ?? '';
        $preco = (float)($dados["preco$i"] ?? 0);
        $entrada = (int)($dados["entrada$i"] ?? 0);
        $saida = (int)($dados["saida$i"] ?? 0);

        if ($nome !== '') {

            $produto = new Produto($nome, $preco);
            $produto->adicionar($entrada);
            $produto->remover($saida);

            $produtos[] = $produto;
        }
    }

    // HTML RESPOSTA
    $html = '
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Resultado</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <style>
            h1 {
                text-align: center;
                color: rgb(185, 48, 48);
                margin-top: 20px;
            }
        </style>
    </head>

    <body class="bg-light">

        <h1>Resultado do Estoque</h1>

        <div class="container mt-5">
            <div class="card p-4">
    ';

    foreach ($produtos as $p) {
        $html .= '
            <p>
                <strong>' . $p->getNome() . '</strong><br>
                Quantidade: ' . $p->getQtd() . '<br>
                Valor total: R$ ' . number_format($p->valorTotal(), 2, ",", ".") . '
            </p>
            <hr>
        ';
    }

    $html .= '
                <div class="text-end">
                    <a href="produto/produto.html" class="btn btn-danger">Voltar</a>
                </div>
            </div>
        </div>

    </body>
    </html>
    ';

    $response->getBody()->write($html);
    return $response;
});

$app->run();