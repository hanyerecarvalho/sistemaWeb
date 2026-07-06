<?php
require __DIR__ . '/../../vendor/autoload.php';

use src\funcionario\Funcionario;
use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app = AppFactory::create();

$app->post('/funcionario', function (Request $request, Response $response) {
    $dados = $request->getParsedBody();

    $funcionario = new Funcionario("", 0.0, 0.0, 0, 0);
    $funcionario->setNome($dados['nome'] ?? '');
    $funcionario->setQtdHoras($dados['qtdHoras'] ?? 0);
    $funcionario->setQtdHorasExtras($dados['qtdHorasExtras'] ?? 0 );
    $funcionario->setValorHora($dados['valorHora'] ?? 0);
    $funcionario->setValorHoraExtra($dados['valorHoraExtra'] ?? 0);

    $salarioFinal = $funcionario->calcSalario();

    $html = '
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Resultado Salario</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <style>
            h1 {
                text-align: center;
                margin-top: 20px;
            }
        </style>
    </head>

    <body class="bg-light">

        <h1 class="text-success">Calculo de Salario</h1>

        <div class="container mt-5">
            <div class="card p-4">

                <h3 class="mb-3">Salario do Funcionario</h3>

                <p><strong>Nome:</strong> ' . $funcionario->getNome() . '</p>
                <p><strong>Salario Final:</strong> ' . number_format($salarioFinal, 2) . '</p>


                <div class="text-end mt-3">
                    <a href="funcionario/funcionario.html" class="btn btn-danger">
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