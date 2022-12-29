<?php

namespace App\Entity;

use App\Repository\DirectorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DirectorRepository::class)]
class Director extends StaffMember
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'directors')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Composer $composer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

}
