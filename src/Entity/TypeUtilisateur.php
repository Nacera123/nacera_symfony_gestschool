<?php

namespace App\Entity;

use App\Repository\TypeUtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'typeutilisateur', targetEntity: Utilisateur::class)]
    private $utilisateurs;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $bd_role;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
    }
    // pour permettre de choisir le type utilisateur
    public function __toString()
    {
        return $this->role;
    }

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




    /**
     * @return Collection|Utilisateur[]
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): self
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs[] = $utilisateur;
            $utilisateur->setTypeutilisateur($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): self
    {
        if ($this->utilisateurs->removeElement($utilisateur)) {
            // set the owning side to null (unless already changed)
            if ($utilisateur->getTypeutilisateur() === $this) {
                $utilisateur->setTypeutilisateur(null);
            }
        }

        return $this;
    }

    public function getBdRole(): ?string
    {
        return $this->bd_role;
    }

    public function setBdRole(?string $bd_role): self
    {
        $this->bd_role = $bd_role;

        return $this;
    }
}
