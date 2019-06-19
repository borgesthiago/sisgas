<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TramitacaoRepository")
 */
class Tramitacao
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dataInicio;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dataFim;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Secretaria", inversedBy="tramitacoes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $origem;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Funcionario", inversedBy="tramitacoes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $funcionarioOrigem;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Funcionario", inversedBy="tramitacaos")
     */
    private $funcionarioDestino;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Secretaria", inversedBy="tramitacaos")
     */
    private $destino;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observacao;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Documento", inversedBy="tramitacao")
     * @ORM\JoinColumn(nullable=false)
     */
    private $documento;

    public function __construct()
    {
    
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDataInicio(): ?\DateTimeInterface
    {
        return $this->dataInicio;
    }

    public function setDataInicio(\DateTimeInterface $dataInicio): self
    {
        $this->dataInicio = $dataInicio;

        return $this;
    }

    public function getDataFim(): ?\DateTimeInterface
    {
        return $this->dataFim;
    }

    public function setDataFim(?\DateTimeInterface $dataFim): self
    {
        $this->dataFim = $dataFim;

        return $this;
    }

    public function getOrigem(): ?Secretaria
    {
        return $this->origem;
    }

    public function setOrigem(?Secretaria $origem): self
    {
        $this->origem = $origem;

        return $this;
    }

    public function getFuncionarioOrigem(): ?Funcionario
    {
        return $this->funcionarioOrigem;
    }

    public function setFuncionarioOrigem(?Funcionario $funcionarioOrigem): self
    {
        $this->funcionarioOrigem = $funcionarioOrigem;

        return $this;
    }

    public function getFuncionarioDestino(): ?Funcionario
    {
        return $this->funcionarioDestino;
    }

    public function setFuncionarioDestino(?Funcionario $funcionarioDestino): self
    {
        $this->funcionarioDestino = $funcionarioDestino;

        return $this;
    }

    public function getDestino(): ?Secretaria
    {
        return $this->destino;
    }

    public function setDestino(?Secretaria $destino): self
    {
        $this->destino = $destino;

        return $this;
    }

    public function getObservacao(): ?string
    {
        return $this->observacao;
    }

    public function setObservacao(?string $observacao): self
    {
        $this->observacao = $observacao;

        return $this;
    }

    public function getDocumento(): ?Documento
    {
        return $this->documento;
    }

    public function setDocumento(?Documento $documento): self
    {
        $this->documento = $documento;

        return $this;
    }

}
