<?php

require __DIR__ . '/../../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\nota\Nota;

$app = AppFactory::create();

$app->post('/nota', function (Request $request, Response $response) {

    $dados = $request->getParsedBody();

    $nome = $dados['nome'] ?? '';
    $n1 = (float)($dados['nota1'] ?? 0);
    $n2 = (float)($dados['nota2'] ?? 0);

    $nota = new Nota($nome, $n1, $n2);

    $media = $nota->media();
    $situacao = $nota->situacao();

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
                color: rgb(24, 18, 212);
                margin-top: 20px;
            }
        </style>
    </head>

    <body class="bg-light">

        <h1>Resultado das Notas</h1>

        <div class="container mt-5">
            <div class="card p-4">

                <p><strong>Nome:</strong> ' . $nota->getNome() . '</p>
                <p><strong>Média:</strong> ' . number_format($media, 2) . '</p>
                <p><strong>Situação:</strong> ' . $situacao . '</p>

                <div class="text-end">
                    <a href="nota/nota.html" class="btn btn-primary">Voltar</a>
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