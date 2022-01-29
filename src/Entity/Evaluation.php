<?php

namespace App\Entity;

use App\Repository\EvaluationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvaluationRepository::class)]
class Evaluation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private $devoirs;

    #[ORM\Column(type: 'decimal', precision: 4, scale: 2, nullable: true)]
    private $examen;

    #[ORM\Column(type: 'decimal', precision: 4, scale: 2, nullable: true)]
    private $moyenne;

    #[ORM\ManyToOne(targetEntity: Periode::class, inversedBy: 'evaluations')]
    private $periode;

    #[ORM\ManyToOne(targetEntity: Matiere::class, inversedBy: 'evaluations')]
    private $matiere;

    #[ORM\ManyToOne(targetEntity: Eleve::class, inversedBy: 'evaluations')]
    private $eleve;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDevoirs(): ?string
    {
        return $this->devoirs;
    }

    public function setDevoirs(?string $devoirs): self
    {
        $this->devoirs = $devoirs;

        return $this;
    }

    public function getExamen(): ?string
    {
        return $this->examen;
    }

    public function setExamen(?string $examen): self
    {
        $this->examen = $examen;

        return $this;
    }

    public function getMoyenne(): ?string
    {
        return $this->moyenne;
    }

    public function setMoyenne(?string $moyenne): self
    {
        $this->moyenne = $moyenne;

        return $this;
    }

    public function getPeriode(): ?Periode
    {
        return $this->periode;
    }

    public function setPeriode(?Periode $periode): self
    {
        $this->periode = $periode;

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getEleve(): ?Eleve
    {
        return $this->eleve;
    }

    public function setEleve(?Eleve $eleve): self
    {
        $this->eleve = $eleve;

        return $this;
    }
}
