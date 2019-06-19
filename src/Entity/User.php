<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Funcionario", inversedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $funcionario;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\StatusDocumento", mappedBy="user")
     */
    private $statusDocumentos;

    public function __construct()
    {
        $this->statusDocumentos = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
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
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFuncionario()
    {
        return $this->funcionario;
    }

    public function setFuncionario(Funcionario $funcionario): self
    {
        $this->funcionario = $funcionario;

        // set the owning side of the relation if necessary
        if ($this !== $funcionario->getUser()) {
            $funcionario->setUser($this);
        }

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
            $statusDocumento->setUser($this);
        }

        return $this;
    }

    public function removeStatusDocumento(StatusDocumento $statusDocumento): self
    {
        if ($this->statusDocumentos->contains($statusDocumento)) {
            $this->statusDocumentos->removeElement($statusDocumento);
            // set the owning side to null (unless already changed)
            if ($statusDocumento->getUser() === $this) {
                $statusDocumento->setUser(null);
            }
        }

        return $this;
    }
}
