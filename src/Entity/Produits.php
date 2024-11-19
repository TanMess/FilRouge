<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitsRepository::class)]
class Produits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $label = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column]
    private ?bool $actif = null;

    /**
     * @var Collection<int, Fournisseur>
     */
    #[ORM\OneToMany(targetEntity: Fournisseur::class, mappedBy: 'produit')]
    private Collection $fournisseurs;

    /**
     * @var Collection<int, Employe>
     */
    #[ORM\ManyToMany(targetEntity: Employe::class, mappedBy: 'produit')]
    private Collection $employes;

    /**
     * @var Collection<int, tva>
     */
    #[ORM\OneToMany(targetEntity: tva::class, mappedBy: 'produits')]
    private Collection $tva;

    /**
     * @var Collection<int, categorie>
     */
    #[ORM\OneToMany(targetEntity: categorie::class, mappedBy: 'produits')]
    private Collection $categorie;

    /**
     * @var Collection<int, Client>
     */
    #[ORM\ManyToMany(targetEntity: Client::class, mappedBy: 'commande')]
    private Collection $clients;

    public function __construct()
    {
        $this->fournisseurs = new ArrayCollection();
        $this->employes = new ArrayCollection();
        $this->tva = new ArrayCollection();
        $this->categorie = new ArrayCollection();
        $this->clients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

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

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): static
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * @return Collection<int, Fournisseur>
     */
    public function getFournisseurs(): Collection
    {
        return $this->fournisseurs;
    }

    public function addFournisseur(Fournisseur $fournisseur): static
    {
        if (!$this->fournisseurs->contains($fournisseur)) {
            $this->fournisseurs->add($fournisseur);
            $fournisseur->setProduit($this);
        }

        return $this;
    }

    public function removeFournisseur(Fournisseur $fournisseur): static
    {
        if ($this->fournisseurs->removeElement($fournisseur)) {
            // set the owning side to null (unless already changed)
            if ($fournisseur->getProduit() === $this) {
                $fournisseur->setProduit(null);
            }
        }

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
            $employe->addProduit($this);
        }

        return $this;
    }

    public function removeEmploye(Employe $employe): static
    {
        if ($this->employes->removeElement($employe)) {
            $employe->removeProduit($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, tva>
     */
    public function getTva(): Collection
    {
        return $this->tva;
    }

    public function addTva(tva $tva): static
    {
        if (!$this->tva->contains($tva)) {
            $this->tva->add($tva);
            $tva->setProduits($this);
        }

        return $this;
    }

    public function removeTva(tva $tva): static
    {
        if ($this->tva->removeElement($tva)) {
            // set the owning side to null (unless already changed)
            if ($tva->getProduits() === $this) {
                $tva->setProduits(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, categorie>
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(categorie $categorie): static
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie->add($categorie);
            $categorie->setProduits($this);
        }

        return $this;
    }

    public function removeCategorie(categorie $categorie): static
    {
        if ($this->categorie->removeElement($categorie)) {
            // set the owning side to null (unless already changed)
            if ($categorie->getProduits() === $this) {
                $categorie->setProduits(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): static
    {
        if (!$this->clients->contains($client)) {
            $this->clients->add($client);
            $client->addCommande($this);
        }

        return $this;
    }

    public function removeClient(Client $client): static
    {
        if ($this->clients->removeElement($client)) {
            $client->removeCommande($this);
        }

        return $this;
    }
}
