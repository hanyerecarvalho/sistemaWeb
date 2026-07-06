<?php
declare(strict_types=1);

namespace src\funcionario;

class Funcionario {
    private string $nome;
    private float $valorHora;
    private float $valorHoraExtra;
    private int $qtdHoras;
    private int $qtdHorasExtras;

    public function __construct(
    string $nome,
    float $valorHora,
    float $valorHoraExtra,
    int $qtdHoras,
    int $qtdHorasExtras
) {
    $this->nome = $nome;
    $this->valorHora = $valorHora;
    $this->valorHoraExtra = $valorHoraExtra;
    $this->qtdHoras = $qtdHoras;
    $this->qtdHorasExtras = $qtdHorasExtras;
}

    public function setQtdHoras(int $newQtdHoras): void {
        $this->qtdHoras = $newQtdHoras;
    }

    public function getQtdHoras(): int {
        return $this->qtdHoras;
    }

    public function setQtdHorasExtras(int $newQtdHorasExtras): void {
        $this->qtdHorasExtras = $newQtdHorasExtras;
    }

    public function getQtdHorasExtras(): int {
        return $this->qtdHorasExtras;
    }

    public function setValorHora(float $newValorHora): void {
        $this->valorHora = $newValorHora;
    }
    
    public function getValorhora(): float {
        return $this->valorHora;
    }

    public function setValorHoraExtra(float $newValorHoraExtra): void  {
        $this->valorHoraExtra = $newValorHoraExtra;
    }

    public function getValorHoraExtra(): float {
        return $this->valorHoraExtra;
    }

    

    public function calcSalario() {
        $valorSalario = $this->valorHora * $this->qtdHoras;
        $valorSalarioExtra = $this->valorHoraExtra * $this->qtdHorasExtras;

        return $valorSalarioFinal = $valorSalario + $valorSalarioExtra;
    }

    public function getNome(): string {
        return $this->nome;
    }
    public function setNome(string $novoNome): void {
        $this->nome = $novoNome;
    }

}