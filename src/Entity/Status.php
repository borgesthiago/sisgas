<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatusRepository")
 */
class Status
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
    private $descricao;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tramitacao", mappedBy="status")
     */
    private $tramitacaos;

    public function __construct()
    {
        $this->tramitacaos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * @return Collection|Tramitacao[]
     */
    public function getTramitacaos(): Collection
    {
        return $this->tramitacaos;
    }

    public function addTramitacao(Tramitacao $tramitacao): self
    {
        if (!$this->tramitacaos->contains($tramitacao)) {
            $this->tramitacaos[] = $tramitacao;
            $tramitacao->setStatus($this);
        }

        return $this;
    }

    public function removeTramitacao(Tramitacao $tramitacao): self
    {
        if ($this->tramitacaos->contains($tramitacao)) {
            $this->tramitacaos->removeElement($tramitacao);
            // set the owning side to null (unless already changed)
            if ($tramitacao->getStatus() === $this) {
                $tramitacao->setStatus(null);
            }
        }

        return $this;
    }
}
