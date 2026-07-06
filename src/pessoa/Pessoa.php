<?php

declare(strict_types=1);

namespace src\pessoa;

class Pessoa {

    private string $Nome;
    private float $Altura;
    private float $Peso;

    public function __construct() {}

    public function calcularIMC(): float
    {
        return $this->Peso / ($this->Altura * $this->Altura);
    }

    public function setNome(string $novoNome): void
    {
        $this->Nome = $novoNome;
    }

    public function getNome(): string
    {
        return $this->Nome;
    }

    public function setPeso(float $novoPeso): void
    {
        $this->Peso = $novoPeso;
    }

    public function getPeso(): float
    {
        return $this->Peso;
    }

    public function setAltura(float $novaAltura): void
    {
        $this->Altura = $novaAltura;
    }

    public function getAltura(): float
    {
        return $this->Altura;
    }
}