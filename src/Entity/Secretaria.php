<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SecretariaRepository")
 */
class Secretaria
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $endereco;

    /**
     * @ORM\Column(type="string", length=8, nullable=true)
     */
    private $telefone;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Funcionario", mappedBy="secretaria")
     */
    private $secretaria;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Secretaria", inversedBy="secretariaFilhos")
     * @ORM\JoinColumn(nullable=true)
     */
    private $secretariaPai;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Secretaria", mappedBy="secretariaPai")
     */
    private $secretariaFilhos;

    public function __construct()
    {
        $this->secretaria = new ArrayCollection();
        $this->secretarias = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco(string $endereco): self
    {
        $this->endereco = $endereco;

        return $this;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone(string $telefone): self
    {
        $this->telefone = $telefone;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|Funcionario[]
     */
    public function getSecretaria(): Collection
    {
        return $this->secretaria;
    }

    public function addSecretarium(Funcionario $secretarium): self
    {
        if (!$this->secretaria->contains($secretarium)) {
            $this->secretaria[] = $secretarium;
            $secretarium->setSecretaria($this);
        }

        return $this;
    }

    public function removeSecretarium(Funcionario $secretarium): self
    {
        if ($this->secretaria->contains($secretarium)) {
            $this->secretaria->removeElement($secretarium);
            // set the owning side to null (unless already changed)
            if ($secretarium->getSecretaria() === $this) {
                $secretarium->setSecretaria(null);
            }
        }

        return $this;
    }

    public function getSecretariaPai(): ?self
    {
        return $this->secretariaPai;
    }

    public function setSecretariaPai(?self $secretariaPai): self
    {
        $this->secretariaPai = $secretariaPai;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getSecretarias(): Collection
    {
        return $this->secretarias;
    }

    public function addSecretaria(self $secretaria): self
    {
        if (!$this->secretarias->contains($secretaria)) {
            $this->secretarias[] = $secretaria;
            $secretaria->setSecretariaPai($this);
        }

        return $this;
    }

    public function removeSecretaria(self $secretaria): self
    {
        if ($this->secretarias->contains($secretaria)) {
            $this->secretarias->removeElement($secretaria);
            // set the owning side to null (unless already changed)
            if ($secretaria->getSecretariaPai() === $this) {
                $secretaria->setSecretariaPai(null);
            }
        }

        return $this;
    }

    public function __toString()
    {    
        return (string) $this->getNome();
    }

}
