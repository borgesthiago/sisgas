<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContatoRepository")
 */
class Contato
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $telefone;

    /**
     * @ORM\Column(type="string", length=11, nullable=true)
     */
    private $celular;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Funcionario", mappedBy="contato", cascade={"persist", "remove"})
     */
    private $funcionarios;

    public function __construct()
    {
        $this->funcionarios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function setTelefone(?string $telefone): self
    {
        $this->telefone = $telefone;

        return $this;
    }

    public function getCelular(): ?string
    {
        return $this->celular;
    }

    public function setCelular(?string $celular): self
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * @return Collection|Funcionario[]
     */
    public function getFuncionarios(): Collection
    {
        return $this->funcionarios;
    }

    public function addFuncionario(Funcionario $funcionario): self
    {
        if (!$this->funcionarios->contains($funcionario)) {
            $this->funcionarios[] = $funcionario;
            $funcionario->setContato($this);
        }

        return $this;
    }

    public function removeFuncionario(Funcionario $funcionario): self
    {
        if ($this->funcionarios->contains($funcionario)) {
            $this->funcionarios->removeElement($funcionario);
            // set the owning side to null (unless already changed)
            if ($funcionario->getContato() === $this) {
                $funcionario->setContato(null);
            }
        }

        return $this;
    }
}
