<?php

namespace App\Entity;

use App\Repository\RpRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RpRepository::class)]
class Rp extends User
{
    #[ORM\OneToMany(mappedBy: 'createdBy', targetEntity: Professeur::class)]
    private $professeurs;

    public function __construct()
    {
        parent::__construct();
        $this->professeurs = new ArrayCollection();
    }

    /**
     * @return Collection<int, Professeur>
     */
    public function getProfesseurs(): Collection
    {
        return $this->professeurs;
    }

    public function addProfesseur(Professeur $professeur): self
    {
        if (!$this->professeurs->contains($professeur)) {
            $this->professeurs[] = $professeur;
            $professeur->setCreatedBy($this);
        }

        return $this;
    }

    public function removeProfesseur(Professeur $professeur): self
    {
        if ($this->professeurs->removeElement($professeur)) {
            // set the owning side to null (unless already changed)
            if ($professeur->getCreatedBy() === $this) {
                $professeur->setCreatedBy(null);
            }
        }

        return $this;
    }
}
