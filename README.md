# Sistema Web de Cálculos 💻

Projeto acadêmico em **PHP, Slim Framework 4, HTML, CSS e Bootstrap**, com quatro ferramentas para praticar formulários, rotas HTTP e programação orientada a objetos.

## Funcionalidades

| Ferramenta | Descrição |
| --- | --- |
| IMC | Cálculo do índice de massa corporal a partir dos dados do formulário. |
| Notas | Média de duas notas e classificação em aprovado, recuperação ou reprovado. |
| Estoque | Cálculo de saldo e valor de produtos a partir de entradas e saídas. |
| Salário | Soma da remuneração de horas trabalhadas e horas extras. |

Os cálculos de estoque são feitos na requisição; o projeto não configura persistência em banco de dados.

## Requisitos e instalação

PHP 8.0 ou superior, Composer e acesso à internet para carregar o Bootstrap por CDN.

```bash
git clone https://github.com/hanyerecarvalho/sistemaWeb.git
cd sistemaWeb
composer install
```

## Executar localmente

Cada ferramenta possui seu próprio ponto de entrada Slim. Para usar as quatro pelo mesmo servidor de desenvolvimento, crie um arquivo local `router.local.php` na raiz com o conteúdo abaixo. Esse arquivo auxiliar não acompanha o repositório:

```php
<?php
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($path === '/' || is_file(__DIR__ . '/public' . $path)) {
    return false;
}
$routes = [
    '/imc' => '/imc/index.php',
    '/nota' => '/nota/index.php',
    '/produtos' => '/produto/index.php',
    '/funcionario' => '/funcionario/index.php',
];
if (isset($routes[$path])) {
    require __DIR__ . '/public' . $routes[$path];
    return;
}
http_response_code(404);
echo 'Página não encontrada';
```

Inicie o servidor e abra `http://localhost:8000` para acessar o menu:

```bash
php -S localhost:8000 -t public router.local.php
```

O roteador auxiliar preserva as páginas estáticas e encaminha os formulários para cada módulo, incluindo `/produtos`, que não corresponde ao nome da pasta `produto`. Encerre o servidor com `Ctrl+C`.

## Estrutura

```text
public/index.html   Menu das ferramentas
public/imc/         Formulário e rota POST /imc
public/nota/        Formulário e rota POST /nota
public/produto/     Formulário e rota POST /produtos
public/funcionario/ Formulário e rota POST /funcionario
src/               Classes e regras de cálculo
composer.json      Dependências e autoload
```

O arquivo `src/funcionario/funcionario.php` usa capitalização diferente da classe `Funcionario`; ambientes sensíveis a maiúsculas e minúsculas podem exigir ajuste no nome do arquivo para o autoload.

## Autor

[Hanyere Carvalho](https://github.com/hanyerecarvalho)
