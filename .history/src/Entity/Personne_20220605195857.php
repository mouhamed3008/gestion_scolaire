<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PersonneRepository;

#[ORM\Entity(repositoryClass: PersonneRepository::class)]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"type", type:"string")]
#[ORM\DiscriminatorMap(["user"=>"User", "professeur"=>"Professeur"])]
class Personne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'string', length: 100)]
    /**
     * Undocumented variable
     *
     * @Assert\NotBlank(message:'Le champs Nom complet ne peut pas etre vide')
     */
    protected $nomComplet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomComplet(): ?string
    {
        return $this->nomComplet;
    }

    public function setNomComplet(string $nomComplet): self
    {
        $this->nomComplet = $nomComplet;

        return $this;
    }
}
