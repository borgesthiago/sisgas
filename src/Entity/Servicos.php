<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServicosRepository")
 */
class Servicos
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $nome;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Secretaria", mappedBy="servico", cascade={"persist", "remove"})
     */
    private $secretarias;

    public function __construct()
    {
        $this->secretarias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Secretaria[]
     */
    public function getSecretarias(): Collection
    {
        return $this->secretarias;
    }

    public function addSecretaria(Secretaria $secretaria): self
    {
        if (!$this->secretarias->contains($secretaria)) {
            $this->secretarias[] = $secretaria;
            $secretaria->addServico($this);
        }

        return $this;
    }

    public function removeSecretaria(Secretaria $secretaria): self
    {
        if ($this->secretarias->contains($secretaria)) {
            $this->secretarias->removeElement($secretaria);
            $secretaria->removeServico($this);
        }

        return $this;
    }
}
