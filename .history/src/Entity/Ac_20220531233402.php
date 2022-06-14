<?php

namespace App\Entity;

use App\Repository\AcRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AcRepository::class)]
class Ac
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
