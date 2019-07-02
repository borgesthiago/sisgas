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
     * @ORM\OneToMany(targetEntity="App\Entity\StatusDocumento", mappedBy="status")
     */
    private $statusDocumentos;

    public function __construct()
    {
        $this->tramitacaos = new ArrayCollection();
        $this->statusDocumentos = new ArrayCollection();
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
     * @return Collection|StatusDocumento[]
     */
    public function getStatusDocumentos(): Collection
    {
        return $this->statusDocumentos;
    }

    public function addStatusDocumento(StatusDocumento $statusDocumento): self
    {
        if (!$this->statusDocumentos->contains($statusDocumento)) {
            $this->statusDocumentos[] = $statusDocumento;
            $statusDocumento->setStatus($this);
        }

        return $this;
    }

    public function removeStatusDocumento(StatusDocumento $statusDocumento): self
    {
        if ($this->statusDocumentos->contains($statusDocumento)) {
            $this->statusDocumentos->removeElement($statusDocumento);
            // set the owning side to null (unless already changed)
            if ($statusDocumento->getStatus() === $this) {
                $statusDocumento->setStatus(null);
            }
        }

        return $this;
    }
}
