<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Validator as AppAssert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\FuncionarioRepository")
 */
class Funcionario
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
     * @ORM\Column(type="string", length=7)
     */
    private $matricula;

    /**
     * @ORM\Column(type="string", length=11, unique=true)
     * @AppAssert\Cpf
     */
    private $cpf;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Secretaria", inversedBy="secretaria")
     * @ORM\JoinColumn(nullable=false)
     */
    private $secretaria;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $tipo;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Remuneracao", inversedBy="funcionario", cascade={"persist", "remove"})
     */
    private $remuneracao;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", mappedBy="funcionario")     
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contato", inversedBy="funcionarios", cascade={"persist", "remove"})
     * * @ORM\JoinColumn(nullable=true)
     */
    private $contato;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $admissao;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $exoneracao;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cargo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $funcao;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $rg;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $orgaoRg;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $rgProfissao;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $orgaoRgProfissao;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $coordenador;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Habitacao", inversedBy="funcionario", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $habitacao;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tramitacao", mappedBy="funcionarioOrigem")
     */
    private $tramitacoes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tramitacao", mappedBy="funcionarioDestino")
     */
    private $tramitacaos;

    public function __construct()
    {
        $this->tramitacoes = new ArrayCollection();
        $this->tramitacaos = new ArrayCollection();
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

    public function getMatricula()
    {
        return $this->matricula;
    }

    public function setMatricula(string $matricula): self
    {
        $this->matricula = $matricula;

        return $this;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): self
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getSecretaria()
    {
        return $this->secretaria;
    }

    public function setSecretaria(Secretaria $secretaria): self
    {
        $this->secretaria = $secretaria;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getRemuneracao()
    {
        return $this->remuneracao;
    }

    public function setRemuneracao(Remuneracao $remuneracao): self
    {
        $this->remuneracao = $remuneracao;

        return $this;
    }

    public function __toString() 
    {
        return $this->getNome();
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getContato()
    {
        return $this->contato;
    }

    public function setContato(Contato $contato): self
    {
        $this->contato = $contato;

        return $this;
    }

    public function getAdmissao()
    {
        return $this->admissao;
    }

    public function setAdmissao(?\DateTimeInterface $admissao): self
    {
        $this->admissao = $admissao;

        return $this;
    }

    public function getExoneracao()
    {
        return $this->exoneracao;
    }

    public function setExoneracao(?\DateTimeInterface $exoneracao): self
    {
        $this->exoneracao = $exoneracao;

        return $this;
    }

    public function getCargo(): ?string
    {
        return $this->cargo;
    }

    public function setCargo(?string $cargo): self
    {
        $this->cargo = $cargo;

        return $this;
    }

    public function getFuncao(): ?string
    {
        return $this->funcao;
    }

    public function setFuncao(?string $funcao): self
    {
        $this->funcao = $funcao;

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

    public function getRgProfissao(): ?string
    {
        return $this->rgProfissao;
    }

    public function setRgProfissao(?string $rgProfissao): self
    {
        $this->rgProfissao = $rgProfissao;

        return $this;
    }

    public function getOrgaoRgProfissao(): ?string
    {
        return $this->orgaoRgProfissao;
    }

    public function setOrgaoRgProfissao(?string $orgaoRgProfissao): self
    {
        $this->orgaoRgProfissao = $orgaoRgProfissao;

        return $this;
    }

    public function getCoordenador(): ?string
    {
        return $this->coordenador;
    }

    public function setCoordenador(?string $coordenador): self
    {
        $this->coordenador = $coordenador;

        return $this;
    }

    public function getHabitacao(): ?Habitacao
    {
        return $this->habitacao;
    }

    public function setHabitacao(Habitacao $habitacao): self
    {
        $this->habitacao = $habitacao;

        return $this;
    }

    /**
     * @return Collection|Tramitacao[]
     */
    public function getTramitacoes(): Collection
    {
        return $this->tramitacoes;
    }

    public function addTramitaco(Tramitacao $tramitaco): self
    {
        if (!$this->tramitacoes->contains($tramitaco)) {
            $this->tramitacoes[] = $tramitaco;
            $tramitaco->setFuncionarioOrigem($this);
        }

        return $this;
    }

    public function removeTramitaco(Tramitacao $tramitaco): self
    {
        if ($this->tramitacoes->contains($tramitaco)) {
            $this->tramitacoes->removeElement($tramitaco);
            // set the owning side to null (unless already changed)
            if ($tramitaco->getFuncionarioOrigem() === $this) {
                $tramitaco->setFuncionarioOrigem(null);
            }
        }

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
            $tramitacao->setFuncionarioDestino($this);
        }

        return $this;
    }

    public function removeTramitacao(Tramitacao $tramitacao): self
    {
        if ($this->tramitacaos->contains($tramitacao)) {
            $this->tramitacaos->removeElement($tramitacao);
            // set the owning side to null (unless already changed)
            if ($tramitacao->getFuncionarioDestino() === $this) {
                $tramitacao->setFuncionarioDestino(null);
            }
        }

        return $this;
    }

}
