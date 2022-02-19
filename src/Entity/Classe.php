<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $salle;

    #[ORM\ManyToOne(targetEntity: Exercice::class, inversedBy: 'classes')]
    private $exercice;

    #[ORM\ManyToOne(targetEntity: Cycle::class, inversedBy: 'classes')]
    private $cycle;


    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: Eleve::class)]
    private $eleves;

    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: ProfClasse::class)]
    private $profClasses;

    public function __construct()
    {        
        $this->eleves = new ArrayCollection();
        $this->profClasses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSalle(): ?string
    {
        return $this->salle;
    }

    public function setSalle(?string $salle): self
    {
        $this->salle = $salle;

        return $this;
    }

    public function getExercice(): ?Exercice
    {
        return $this->exercice;
    }

    public function setExercice(?Exercice $exercice): self
    {
        $this->exercice = $exercice;

        return $this;
    }

    public function getCycle(): ?Cycle
    {
        return $this->cycle;
    }

    public function setCycle(?Cycle $cycle): self
    {
        $this->cycle = $cycle;

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
            $elefe->setClasse($this);
        }

        return $this;
    }

    public function removeElefe(Eleve $elefe): self
    {
        if ($this->eleves->removeElement($elefe)) {
            // set the owning side to null (unless already changed)
            if ($elefe->getClasse() === $this) {
                $elefe->setClasse(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->salle;
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
            $profClass->setClasse($this);
        }

        return $this;
    }

    public function removeProfClass(ProfClasse $profClass): self
    {
        if ($this->profClasses->removeElement($profClass)) {
            // set the owning side to null (unless already changed)
            if ($profClass->getClasse() === $this) {
                $profClass->setClasse(null);
            }
        }

        return $this;
    }
}
