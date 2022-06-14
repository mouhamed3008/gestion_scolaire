<?php

namespace App\Entity;

use App\Repository\AcRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AcRepository::class)]
class Ac extends User
{
    

    public function getId(): ?int
    {
        return $this->id;
    }
}
