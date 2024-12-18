<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToOne(inversedBy: 'fournisseur')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Adresse $adresse = null;

    #[ORM\ManyToOne(inversedBy: 'fournisseurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?produits $produit = null;

    /**
     * @var Collection<int, Employe>
     */
    #[ORM\ManyToMany(targetEntity: Employe::class, mappedBy: 'fournisseur')]
    private Collection $employes;

    public function __construct()
    {
        $this->employes = new ArrayCollection();
    }

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

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getProduit(): ?produits
    {
        return $this->produit;
    }

    public function setProduit(?produits $produit): static
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * @return Collection<int, Employe>
     */
    public function getEmployes(): Collection
    {
        return $this->employes;
    }

    public function addEmploye(Employe $employe): static
    {
        if (!$this->employes->contains($employe)) {
            $this->employes->add($employe);
            $employe->addFournisseur($this);
        }

        return $this;
    }

    public function removeEmploye(Employe $employe): static
    {
        if ($this->employes->removeElement($employe)) {
            $employe->removeFournisseur($this);
        }

        return $this;
    }
}
