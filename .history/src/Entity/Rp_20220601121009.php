<?php

namespace App\Entity;

use App\Repository\RpRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RpRepository::class)]
class Rp extends User
{
   
}
