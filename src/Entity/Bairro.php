<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BairroRepository")
 */
class Bairro
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
    private $distrito;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ativo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Endereco", mappedBy="bairro")
     */
    private $enderecos;

    public function __construct()
    {
        $this->enderecos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getDistrito(): ?string
    {
        return $this->distrito;
    }

    public function setDistrito(string $distrito): self
    {
        $this->distrito = $distrito;

        return $this;
    }

    public function getAtivo(): ?bool
    {
        return $this->ativo;
    }

    public function setAtivo(bool $ativo): self
    {
        $this->ativo = $ativo;

        return $this;
    }

    /**
     * @return Collection|Enderecos[]
     */
    public function getEnderecos(): Collection
    {
        return $this->enderecos;
    }

    public function addEndereco(Enderecos $endereco): self
    {
        if (!$this->enderecos->contains($endereco)) {
            $this->enderecos[] = $endereco;
            $endereco->setBairro($this);
        }

        return $this;
    }

    public function removeEndereco(Enderecos $endereco): self
    {
        if ($this->enderecos->contains($endereco)) {
            $this->enderecos->removeElement($endereco);
            // set the owning side to null (unless already changed)
            if ($endereco->getBairro() === $this) {
                $endereco->setBairro(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getNome();
    }
}
