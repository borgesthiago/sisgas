<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DocumentoRepository")
 */
class Documento
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $tipo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numero;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Secretaria", inversedBy="documentos")
     */
    private $origem;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Usuario", mappedBy="documento")
     */
    private $usuario;

    /**
     * @ORM\Column(type="date")
     */
    private $dataRecebido;

    /**
     * @ORM\Column(type="integer")
     */
    private $prazo;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $reiteracao;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Documento", inversedBy="numeroReiteracao")
     */
    private $numero_reiteracao;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Documento", mappedBy="numero_reiteracao")
     */
    private $numeroReiteracao;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tramitacao", mappedBy="documento", cascade={"persist", "remove"})
     */
    private $tramitacao;

    public function __construct()
    {
        $this->usuario = new ArrayCollection();
        $this->numeroReiteracao = new ArrayCollection();
        $this->tramitacao = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

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

    /**
     * @return Collection|Usuario[]
     */
    public function getUsuario(): Collection
    {
        return $this->usuario;
    }

    public function addUsuario(Usuario $usuario): self
    {
        if (!$this->usuario->contains($usuario)) {
            $this->usuario[] = $usuario;
            $usuario->setDocumento($this);
        }

        return $this;
    }

    public function removeUsuario(Usuario $usuario): self
    {
        if ($this->usuario->contains($usuario)) {
            $this->usuario->removeElement($usuario);
            // set the owning side to null (unless already changed)
            if ($usuario->getDocumento() === $this) {
                $usuario->setDocumento(null);
            }
        }

        return $this;
    }

    public function getDataRecebido(): ?\DateTimeInterface
    {
        return $this->dataRecebido;
    }

    public function setDataRecebido(\DateTimeInterface $dataRecebido): self
    {
        $this->dataRecebido = $dataRecebido;

        return $this;
    }

    public function getPrazo(): ?int
    {
        return $this->prazo;
    }

    public function setPrazo(int $prazo): self
    {
        $this->prazo = $prazo;

        return $this;
    }

    public function getReiteracao(): ?bool
    {
        return $this->reiteracao;
    }

    public function setReiteracao(?bool $reiteracao): self
    {
        $this->reiteracao = $reiteracao;

        return $this;
    }

    public function getNumeroReiteracao(): ?self
    {
        return $this->numero_reiteracao;
    }

    public function setNumeroReiteracao(?self $numero_reiteracao): self
    {
        $this->numero_reiteracao = $numero_reiteracao;

        return $this;
    }

    public function addNumeroReiteracao(self $numeroReiteracao): self
    {
        if (!$this->numeroReiteracao->contains($numeroReiteracao)) {
            $this->numeroReiteracao[] = $numeroReiteracao;
            $numeroReiteracao->setNumeroReiteracao($this);
        }

        return $this;
    }

    public function removeNumeroReiteracao(self $numeroReiteracao): self
    {
        if ($this->numeroReiteracao->contains($numeroReiteracao)) {
            $this->numeroReiteracao->removeElement($numeroReiteracao);
            // set the owning side to null (unless already changed)
            if ($numeroReiteracao->getNumeroReiteracao() === $this) {
                $numeroReiteracao->setNumeroReiteracao(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tramitacao[]
     */
    public function getTramitacao(): Collection
    {
        return $this->tramitacao;
    }

    public function addTramitacao(Tramitacao $tramitacao): self
    {
        if (!$this->tramitacao->contains($tramitacao)) {
            $this->tramitacao[] = $tramitacao;
            $tramitacao->setDocumento($this);
        }

        return $this;
    }

    public function removeTramitacao(Tramitacao $tramitacao): self
    {
        if ($this->tramitacao->contains($tramitacao)) {
            $this->tramitacao->removeElement($tramitacao);
            // set the owning side to null (unless already changed)
            if ($tramitacao->getDocumento() === $this) {
                $tramitacao->setDocumento(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getTipo();
    }
}