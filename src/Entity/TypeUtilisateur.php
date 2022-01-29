<?php

namespace App\Entity;

use App\Repository\TypeUtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeUtilisateurRepository::class)]
class TypeUtilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $role;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\OneToOne(mappedBy: 'typeutilisateur', targetEntity: Utilisateur::class, cascade: ['persist', 'remove'])]
    private $utilisateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        // unset the owning side of the relation if necessary
        if ($utilisateur === null && $this->utilisateur !== null) {
            $this->utilisateur->setTypeutilisateur(null);
        }

        // set the owning side of the relation if necessary
        if ($utilisateur !== null && $utilisateur->getTypeutilisateur() !== $this) {
            $utilisateur->setTypeutilisateur($this);
        }

        $this->utilisateur = $utilisateur;

        return $this;
    }
}
