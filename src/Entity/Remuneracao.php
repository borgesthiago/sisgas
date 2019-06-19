<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RemuneracaoRepository")
 */
class Remuneracao
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $salario;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $gratificacao;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $desconto;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Funcionario", mappedBy="remuneracao", cascade={"persist", "remove"})
     */
    private $funcionario;

    public function getId()
    {
        return $this->id;
    }

    public function getSalario()
    {
        return $this->salario;
    }

    public function setSalario(float $salario): self
    {
        $this->salario = $salario;

        return $this;
    }

    public function getGratificacao()
    {
        return $this->gratificacao;
    }

    public function setGratificacao(float $gratificacao): self
    {
        $this->gratificacao = $gratificacao;

        return $this;
    }

    public function getDesconto()
    {
        return $this->desconto;
    }

    public function setDesconto(float $desconto): self
    {
        $this->desconto = $desconto;

        return $this;
    }

    public function getFuncionario()
    {
        return $this->funcionario;
    }

    public function setFuncionario(Funcionario $funcionario): self
    {
        $this->funcionario = $funcionario;

        // set (or unset) the owning side of the relation if necessary
        $newRemuneracao = $funcionario === null ? null : $this;
        if ($newRemuneracao !== $funcionario->getRemuneracao()) {
            $funcionario->setRemuneracao($newRemuneracao);
        }

        return $this;
    }

    public function getPagamento()
    {
        $remuneracao = $this->getSalario();
        $gratificacao = $this->getGratificacao();
        $desconto = $this->getDesconto();

        return ($remuneracao + $gratificacao) - $desconto;
    }
}
