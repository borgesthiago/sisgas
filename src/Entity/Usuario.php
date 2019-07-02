<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuarioRepository")
 */
class Usuario
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
     * @ORM\Column(type="string", length=11, nullable=true)
     */
    private $cpf;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $rg;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $orgaoRg;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dataNascimento;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $sexo;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pcd;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $naturalidade;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profissao;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ocupacao;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $renda;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $ctps;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $serieCtps;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $escolaridade;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $nis;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Documento", inversedBy="usuario")
     */
    private $documento;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Endereco", inversedBy="usuarios")
     */
    private $endereco;

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

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(?string $cpf): self
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getRg(): ?string
    {
        return $this->rg;
    }

    public function setRg(?string $rg): self
    {
        $this->rg = $rg;

        return $this;
    }

    public function getOrgaoRg(): ?string
    {
        return $this->orgaoRg;
    }

    public function setOrgaoRg(?string $orgaoRg): self
    {
        $this->orgaoRg = $orgaoRg;

        return $this;
    }

    public function getDataNascimento(): ?\DateTimeInterface
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento(?\DateTimeInterface $dataNascimento): self
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(?string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getPcd(): ?int
    {
        return $this->pcd;
    }

    public function setPcd(?int $pcd): self
    {
        $this->pcd = $pcd;

        return $this;
    }

    public function getNaturalidade(): ?string
    {
        return $this->naturalidade;
    }

    public function setNaturalidade(?string $naturalidade): self
    {
        $this->naturalidade = $naturalidade;

        return $this;
    }

    public function getProfissao(): ?string
    {
        return $this->profissao;
    }

    public function setProfissao(?string $profissao): self
    {
        $this->profissao = $profissao;

        return $this;
    }

    public function getOcupacao(): ?string
    {
        return $this->ocupacao;
    }

    public function setOcupacao(?string $ocupacao): self
    {
        $this->ocupacao = $ocupacao;

        return $this;
    }

    public function getRenda(): ?float
    {
        return $this->renda;
    }

    public function setRenda(?float $renda): self
    {
        $this->renda = $renda;

        return $this;
    }

    public function getCtps(): ?string
    {
        return $this->ctps;
    }

    public function setCtps(?string $ctps): self
    {
        $this->ctps = $ctps;

        return $this;
    }

    public function getSerieCtps(): ?string
    {
        return $this->serieCtps;
    }

    public function setSerieCtps(?string $serieCtps): self
    {
        $this->serieCtps = $serieCtps;

        return $this;
    }

    public function getEscolaridade(): ?string
    {
        return $this->escolaridade;
    }

    public function setEscolaridade(?string $escolaridade): self
    {
        $this->escolaridade = $escolaridade;

        return $this;
    }

    public function getNis(): ?string
    {
        return $this->nis;
    }

    public function setNis(?string $nis): self
    {
        $this->nis = $nis;

        return $this;
    }

    public function getDocumento(): ?Documento
    {
        return $this->documento;
    }

    public function setDocumento(?Documento $documento): self
    {
        $this->documento = $documento;

        return $this;
    }

    public function getEndereco(): ?Endereco
    {
        return $this->endereco;
    }

    public function setEndereco(?Endereco $endereco): self
    {
        $this->endereco = $endereco;

        return $this;
    }
}
