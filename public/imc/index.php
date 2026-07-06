<?php

require __DIR__ . '/../../vendor/autoload.php';

use src\pessoa\Pessoa;
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app = AppFactory::create();

$app->post('/imc', function (Request $request, Response $response) {

    $dados = $request->getParsedBody();

    $pessoa = new Pessoa();
    $pessoa->setNome($dados['nome'] ?? '');
    $pessoa->setPeso((float)($dados['peso'] ?? 0));
    $pessoa->setAltura((float)($dados['altura'] ?? 0));

    $resultadoIMC = $pessoa->calcularIMC();

    if ($resultadoIMC < 18.5) {
        $classificacao = "Abaixo do peso";
        $cor = "text-warning";
    } elseif ($resultadoIMC < 25) {
        $classificacao = "Peso normal";
        $cor = "text-success";
    } elseif ($resultadoIMC < 30) {
        $classificacao = "Sobrepeso";
        $cor = "text-warning";
    } else {
        $classificacao = "Obesidade";
        $cor = "text-danger";
    }

    $html = '
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Resultado IMC</title>

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

        <h1>Resultado do IMC</h1>

        <div class="container mt-5">
            <div class="card p-4">

                <h3 class="mb-3">Dados da Pessoa</h3>

                <p><strong>Nome:</strong> ' . $pessoa->getNome() . '</p>
                <p><strong>IMC:</strong> ' . number_format($resultadoIMC, 2) . '</p>

                <p class="' . $cor . '">
                    <strong>Classificação:</strong> ' . $classificacao . '
                </p>

                <div class="text-end mt-3">
                    <a href="imc/IMC.html" class="btn btn-danger">
                        Voltar
                    </a>
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