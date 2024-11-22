<?php

namespace App\Entity;

use App\Repository\MarkRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MarkRepository::class)]
#[UniqueEntity(
    fields: ['client', 'produits'],
    errorPath: 'client',
    message: 'Cet utilisateur a deja noté cette recette !'
)]
class Mark
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\Positive()]
    #[Assert\LessThan(6)]
    private ?int $mark = null;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'marks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    #[ORM\ManyToOne(targetEntity: Produits::class, inversedBy: 'marks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produits $produits = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMark(): ?int
    {
        return $this->mark;
    }

    public function setMark(int $mark): static
    {
        $this->mark = $mark;

        return $this;
    }

    public function getUser(): ?client
    {
        return $this->client;
    }

    public function setUser(?client $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getFlat(): ?produits
    {
        return $this->produits;
    }

    public function setFlat(?produits $produits): static
    {
        $this->produits = $produits;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}