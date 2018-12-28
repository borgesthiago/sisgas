<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubSecretariaRepository")
 */
class SubSecretaria
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nome;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Secretaria", inversedBy="subsecretaria")
     * @ORM\JoinColumn(nullable=false)
     */
    private $secretaria;

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

    public function getSecretaria(): ?Secretaria
    {
        return $this->secretaria;
    }

    public function setSecretaria(?Secretaria $secretaria): self
    {
        $this->secretaria = $secretaria;

        return $this;
    }
}
