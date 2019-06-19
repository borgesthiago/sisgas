<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HabitacaoRepository")
 */
class Habitacao
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
    private $endereco;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $bairro;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $cidade;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $cep;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $tipoImovel;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $tipoConstrucao;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $situacao;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $saneamento;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Funcionario", mappedBy="habitacao", cascade={"persist", "remove"})
     */
    private $funcionario;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    public function setEndereco(?string $endereco): self
    {
        $this->endereco = $endereco;

        return $this;
    }

    public function getBairro(): ?string
    {
        return $this->bairro;
    }

    public function setBairro(?string $bairro): self
    {
        $this->bairro = $bairro;

        return $this;
    }

    public function getCidade(): ?string
    {
        return $this->cidade;
    }

    public function setCidade(?string $cidade): self
    {
        $this->cidade = $cidade;

        return $this;
    }

    public function getCep(): ?string
    {
        return $this->cep;
    }

    public function setCep(?string $cep): self
    {
        $this->cep = $cep;

        return $this;
    }

    public function getTipoImovel(): ?string
    {
        return $this->tipoImovel;
    }

    public function setTipoImovel(?string $tipoImovel): self
    {
        $this->tipoImovel = $tipoImovel;

        return $this;
    }

    public function getTipoConstrucao(): ?string
    {
        return $this->tipoConstrucao;
    }

    public function setTipoConstrucao(?string $tipoConstrucao): self
    {
        $this->tipoConstrucao = $tipoConstrucao;

        return $this;
    }

    public function getSituacao(): ?string
    {
        return $this->situacao;
    }

    public function setSituacao(?string $situacao): self
    {
        $this->situacao = $situacao;

        return $this;
    }

    public function getSaneamento(): ?int
    {
        return $this->saneamento;
    }

    public function setSaneamento(?int $saneamento): self
    {
        $this->saneamento = $saneamento;

        return $this;
    }

    public function getFuncionario(): ?Funcionario
    {
        return $this->funcionario;
    }

    public function setFuncionario(Funcionario $funcionario): self
    {
        $this->funcionario = $funcionario;

        // set the owning side of the relation if necessary
        if ($this !== $funcionario->getHabitacao()) {
            $funcionario->setHabitacao($this);
        }

        return $this;
    }
}
