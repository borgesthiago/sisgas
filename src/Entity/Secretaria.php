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
     * @ORM\OneToMany(targetEntity="App\Entity\SubSecretaria", mappedBy="secretaria", orphanRemoval=true)
     */
    private $subsecretaria;

    public function __construct()
    {
        $this->secretaria = new ArrayCollection();
        $this->subsecretaria = new ArrayCollection();
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

    /**
     * @return Collection|SubSecretaria[]
     */
    public function getSubsecretaria(): Collection
    {
        return $this->subsecretaria;
    }

    public function addSubsecretarium(SubSecretaria $subsecretarium): self
    {
        if (!$this->subsecretaria->contains($subsecretarium)) {
            $this->subsecretaria[] = $subsecretarium;
            $subsecretarium->setSecretaria($this);
        }

        return $this;
    }

    public function removeSubsecretarium(SubSecretaria $subsecretarium): self
    {
        if ($this->subsecretaria->contains($subsecretarium)) {
            $this->subsecretaria->removeElement($subsecretarium);
            // set the owning side to null (unless already changed)
            if ($subsecretarium->getSecretaria() === $this) {
                $subsecretarium->setSecretaria(null);
            }
        }

        return $this;
    }
}
