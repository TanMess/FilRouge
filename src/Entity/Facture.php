<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reference_prod = null;

    #[ORM\Column]
    private ?int $quantite_prod = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $facture_date = null;

    #[ORM\Column]
    private ?float $prix_facture = null;

    #[ORM\Column]
    private ?float $taux_tva = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReferenceProd(): ?string
    {
        return $this->reference_prod;
    }

    public function setReferenceProd(string $reference_prod): static
    {
        $this->reference_prod = $reference_prod;

        return $this;
    }

    public function getQuantiteProd(): ?int
    {
        return $this->quantite_prod;
    }

    public function setQuantiteProd(int $quantite_prod): static
    {
        $this->quantite_prod = $quantite_prod;

        return $this;
    }

    public function getFactureDate(): ?\DateTimeInterface
    {
        return $this->facture_date;
    }

    public function setFactureDate(\DateTimeInterface $facture_date): static
    {
        $this->facture_date = $facture_date;

        return $this;
    }

    public function getPrixFacture(): ?float
    {
        return $this->prix_facture;
    }

    public function setPrixFacture(float $prix_facture): static
    {
        $this->prix_facture = $prix_facture;

        return $this;
    }

    public function getTauxTva(): ?float
    {
        return $this->taux_tva;
    }

    public function setTauxTva(float $taux_tva): static
    {
        $this->taux_tva = $taux_tva;

        return $this;
    }
}
