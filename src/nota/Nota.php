<?php

declare(strict_types=1);
namespace src\nota;

class Nota {

    private string $nome;
    private float $nota1;
    private float $nota2;

    public function __construct(string $nome, float $n1, float $n2)
    {
        $this->nome = $nome;
        $this->nota1 = $n1;
        $this->nota2 = $n2;
    }

    public function media(): float
    {
        return ($this->nota1 + $this->nota2) / 2;
    }

    public function situacao(): string
    {
        $media = $this->media();

        if ($media < 3) {
            return "Reprovado";
        } elseif ($media < 6) {
            return "Recuperação";
        } else {
            return "Aprovado";
        }
    }

    public function getNome(): string
    {
        return $this->nome;
    }
}