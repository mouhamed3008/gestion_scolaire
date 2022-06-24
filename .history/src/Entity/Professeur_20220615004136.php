<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfesseurRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ProfesseurRepository::class)]
#[ApiResource()]

class Professeur extends Personne
{

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank(message:'Veuillez choisir la grade')]
    private $grade;

    #[ORM\ManyToMany(targetEntity: Classe::class, inversedBy: 'professeurs')]
    private $classes;

    #[ORM\ManyToMany(targetEntity: Module::class, inversedBy: 'professeurs')]
    private $modules;

    #[ORM\Column(type: 'integer', options: ["default"=> 1])]
    private $etat;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'professeurs')]
    private $createdBy;


    public function __construct()
    {
        $this->classes = new ArrayCollection();
        $this->modules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * @return Collection<int, Classe>
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classe $class): self
    {
        if (!$this->classes->contains($class)) {
            $this->classes[] = $class;
        }

        return $this;
    }

    public function removeClass(Classe $class): self
    {
        $this->classes->removeElement($class);

        return $this;
    }

    /**
     * @return Collection<int, Module>
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function addModule(Module $module): self
    {
        if (!$this->modules->contains($module)) {
            $this->modules[] = $module;
        }

        return $this;
    }

    public function removeModule(Module $module): self
    {
        $this->modules->removeElement($module);

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(): self
    {
        $this->etat = 1;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

}
