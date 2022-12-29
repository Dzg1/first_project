<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $releaseDate = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $synopsis = null;

    #[ORM\ManyToMany(targetEntity: Actor::class)]
    private Collection $actors;

    #[ORM\ManyToMany(targetEntity: Director::class)]
    private Collection $Directors;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Composer $composers = null;

    public function __construct()
    {
        $this->actors = new ArrayCollection();
        $this->Directors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    /**
     * @return Collection<int, Actor>
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(Actor $actor): self
    {
        if (!$this->actors->contains($actor)) {
            $this->actors->add($actor);
        }

        return $this;
    }

    public function removeActor(Actor $actor): self
    {
        $this->actors->removeElement($actor);

        return $this;
    }

    /**
     * @return Collection<int, Director>
     */
    public function getDirectors(): Collection
    {
        return $this->Directors;
    }

    public function addDirector(Director $director): self
    {
        if (!$this->Directors->contains($director)) {
            $this->Directors->add($director);
        }

        return $this;
    }

    public function removeDirector(Director $director): self
    {
        $this->Directors->removeElement($director);

        return $this;
    }

    public function getComposers(): ?Composer
    {
        return $this->composers;
    }

    public function setComposers(?Composer $composers): self
    {
        $this->composers = $composers;

        return $this;
    }
}
