<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Classe::class, inversedBy: 'inscriptions')]
    #[Assert\NotBlank(message:'Veuillez choisir une classe')]
    private $classe;

    #[ORM\ManyToOne(targetEntity: Etudiant::class, inversedBy: 'inscriptions', cascade:["persist", "remove"])]
    private $etudiant;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'inscriptions')]
    private $user;

    #[ORM\Column(type: 'datetime_immutable', nullable: true, options:['default'=>"CURRENT_TIMESTAMP"])]
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
