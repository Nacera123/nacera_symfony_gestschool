<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;

    #[ORM\Column(type: 'string', length: 255)]
    private $telephone;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    private $adresse;

    #[ORM\OneToOne(inversedBy: 'utilisateur', targetEntity: Compte::class, cascade: ['persist', 'remove'])]
    private $compte;

    #[ORM\OneToOne(inversedBy: 'utilisateur', targetEntity: TypeUtilisateur::class, cascade: ['persist', 'remove'])]
    private $typeutilisateur;


    #[ORM\OneToMany(mappedBy: 'papa', targetEntity: Eleve::class)]
    private $eleves;

    #[ORM\OneToMany(mappedBy: 'maman', targetEntity: Eleve::class)]
    private $elevesm;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: ProfClasse::class)]
    private $profClasses;

    public function __construct()
    {
        $this->eleves = new ArrayCollection();
        $this->elevesm = new ArrayCollection();
        $this->profClasses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCompte(): ?Compte
    {
        return $this->compte;
    }

    public function setCompte(?Compte $compte): self
    {
        $this->compte = $compte;

        return $this;
    }

    public function getTypeutilisateur(): ?TypeUtilisateur
    {
        return $this->typeutilisateur;
    }

    public function setTypeutilisateur(?TypeUtilisateur $typeutilisateur): self
    {
        $this->typeutilisateur = $typeutilisateur;

        return $this;
    }



    /**
     * @return Collection|Eleve[]
     */
    public function getEleves(): Collection
    {
        return $this->eleves;
    }

    public function addElefe(Eleve $elefe): self
    {
        if (!$this->eleves->contains($elefe)) {
            $this->eleves[] = $elefe;
            $elefe->setPapa($this);
        }

        return $this;
    }

    public function removeElefe(Eleve $elefe): self
    {
        if ($this->eleves->removeElement($elefe)) {
            // set the owning side to null (unless already changed)
            if ($elefe->getPapa() === $this) {
                $elefe->setPapa(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Eleve[]
     */
    public function getElevesm(): Collection
    {
        return $this->elevesm;
    }

    public function addElevesm(Eleve $elevesm): self
    {
        if (!$this->elevesm->contains($elevesm)) {
            $this->elevesm[] = $elevesm;
            $elevesm->setMaman($this);
        }

        return $this;
    }

    public function removeElevesm(Eleve $elevesm): self
    {
        if ($this->elevesm->removeElement($elevesm)) {
            // set the owning side to null (unless already changed)
            if ($elevesm->getMaman() === $this) {
                $elevesm->setMaman(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProfClasse[]
     */
    public function getProfClasses(): Collection
    {
        return $this->profClasses;
    }

    public function addProfClass(ProfClasse $profClass): self
    {
        if (!$this->profClasses->contains($profClass)) {
            $this->profClasses[] = $profClass;
            $profClass->setUtilisateur($this);
        }

        return $this;
    }

    public function removeProfClass(ProfClasse $profClass): self
    {
        if ($this->profClasses->removeElement($profClass)) {
            // set the owning side to null (unless already changed)
            if ($profClass->getUtilisateur() === $this) {
                $profClass->setUtilisateur(null);
            }
        }

        return $this;
    }
}
