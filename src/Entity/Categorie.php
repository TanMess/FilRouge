<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $label_cat = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description_categorie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabelCat(): ?string
    {
        return $this->label_cat;
    }

    public function setLabelCat(string $label_cat): static
    {
        $this->label_cat = $label_cat;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDescriptionCategorie(): ?string
    {
        return $this->description_categorie;
    }

    public function setDescriptionCategorie(string $description_categorie): static
    {
        $this->description_categorie = $description_categorie;

        return $this;
    }
}
