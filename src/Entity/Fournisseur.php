<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FournisseurRepository::class)]
class Fournisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $num_siret = null;

    #[ORM\Column(length: 50)]
    private ?string $nom_fourn = null;

    #[ORM\Column(length: 255)]
    private ?string $constructeur = null;

    #[ORM\Column(length: 100)]
    private ?string $email_fourni = null;

    #[ORM\Column(length: 20)]
    private ?string $telephone_fourni = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumSiret(): ?int
    {
        return $this->num_siret;
    }

    public function setNumSiret(int $num_siret): static
    {
        $this->num_siret = $num_siret;

        return $this;
    }

    public function getNomFourn(): ?string
    {
        return $this->nom_fourn;
    }

    public function setNomFourn(string $nom_fourn): static
    {
        $this->nom_fourn = $nom_fourn;

        return $this;
    }

    public function getConstructeur(): ?string
    {
        return $this->constructeur;
    }

    public function setConstructeur(string $constructeur): static
    {
        $this->constructeur = $constructeur;

        return $this;
    }

    public function getEmailFourni(): ?string
    {
        return $this->email_fourni;
    }

    public function setEmailFourni(string $email_fourni): static
    {
        $this->email_fourni = $email_fourni;

        return $this;
    }

    public function getTelephoneFourni(): ?string
    {
        return $this->telephone_fourni;
    }

    public function setTelephoneFourni(string $telephone_fourni): static
    {
        $this->telephone_fourni = $telephone_fourni;

        return $this;
    }
}
