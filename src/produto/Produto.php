<?php

declare(strict_types=1);

namespace src\produto;

class Produto {

    private string $nome;
    private float $preco;
    private int $qtd;

    public function __construct(string $nome, float $preco)
    {
        $this->nome = $nome;
        $this->preco = $preco;
        $this->qtd = 0;
    }

    public function adicionar(int $entrada): void
    {
        $this->qtd += $entrada;
    }

    public function remover(int $saida): void
    {
        $this->qtd -= $saida;

        if ($this->qtd < 0) {
            $this->qtd = 0;
        }
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getQtd(): int
    {
        return $this->qtd;
    }

    public function valorTotal(): float
    {
        return $this->preco * $this->qtd;
    }
}