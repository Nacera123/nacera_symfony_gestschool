<?php

namespace App\Entity;

use App\Repository\EleveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EleveRepository::class)]
class Eleve
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;

    #[ORM\Column(type: 'datetime')]
    private $date_de_naissance;

    #[ORM\ManyToOne(targetEntity: Classe::class, inversedBy: 'eleves')]
    private $classe;

    #[ORM\ManyToOne(targetEntity: Utilisateur::class, inversedBy: 'eleves')]
    private $papa;

    #[ORM\ManyToOne(targetEntity: Utilisateur::class, inversedBy: 'elevesm')]
    private $maman;

    #[ORM\OneToMany(mappedBy: 'eleve', targetEntity: Evaluation::class)]
    private $evaluations;

    public function __toString()
    {
        return $this->nom;
        return $this->prenom;
        return $this->date_de_naissance;
    }
    public function __construct()
    {
        $this->evaluations = new ArrayCollection();
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

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->date_de_naissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $date_de_naissance): self
    {
        $this->date_de_naissance = $date_de_naissance;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function getPapa(): ?Utilisateur
    {
        return $this->papa;
    }

    public function setPapa(?Utilisateur $papa): self
    {
        $this->papa = $papa;

        return $this;
    }

    public function getMaman(): ?Utilisateur
    {
        return $this->maman;
    }

    public function setMaman(?Utilisateur $maman): self
    {
        $this->maman = $maman;

        return $this;
    }

    /**
     * @return Collection|Evaluation[]
     */
    public function getEvaluations(): Collection
    {
        return $this->evaluations;
    }

    public function addEvaluation(Evaluation $evaluation): self
    {
        if (!$this->evaluations->contains($evaluation)) {
            $this->evaluations[] = $evaluation;
            $evaluation->setEleve($this);
        }

        return $this;
    }

    public function removeEvaluation(Evaluation $evaluation): self
    {
        if ($this->evaluations->removeElement($evaluation)) {
            // set the owning side to null (unless already changed)
            if ($evaluation->getEleve() === $this) {
                $evaluation->setEleve(null);
            }
        }

        return $this;
    }
}
