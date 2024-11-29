<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $mode_paiement = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_commande = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_paiement = null;

    #[ORM\Column]
    private ?bool $commande_differee = null;

    #[ORM\Column(length: 100)]
    private ?string $statut_commande = null;

    #[ORM\Column]
    private ?bool $commande_partiel = null;

    #[ORM\Column(length: 255)]
    private ?string $reference_produit = null;

    #[ORM\Column]
    private ?float $total_prix = null;

    #[ORM\Column]
    private ?int $quantite_produit = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?livraison $livraison = null;

    /**
     * @var Collection<int, facture>
     */
    #[ORM\OneToMany(targetEntity: Facture::class, mappedBy: 'commande')]
    private Collection $facture;

    /**
     * @var Collection<int, Client>
     */
    #[ORM\ManyToMany(targetEntity: Client::class, mappedBy: 'prepare')]
    private Collection $clients;

    public function __construct()
    {
        $this->facture = new ArrayCollection();
        $this->clients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModePaiement(): ?string
    {
        return $this->mode_paiement;
    }

    public function setModePaiement(string $mode_paiement): static
    {
        $this->mode_paiement = $mode_paiement;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->date_commande;
    }

    public function setDateCommande(\DateTimeInterface $date_commande): static
    {
        $this->date_commande = $date_commande;

        return $this;
    }

    public function getDatePaiement(): ?\DateTimeInterface
    {
        return $this->date_paiement;
    }

    public function setDatePaiement(\DateTimeInterface $date_paiement): static
    {
        $this->date_paiement = $date_paiement;

        return $this;
    }

    public function isCommandeDifferee(): ?bool
    {
        return $this->commande_differee;
    }

    public function setCommandeDifferee(bool $commande_differee): static
    {
        $this->commande_differee = $commande_differee;

        return $this;
    }

    public function getStatutCommande(): ?string
    {
        return $this->statut_commande;
    }

    public function setStatutCommande(string $statut_commande): static
    {
        $this->statut_commande = $statut_commande;

        return $this;
    }

    public function isCommandePartiel(): ?bool
    {
        return $this->commande_partiel;
    }

    public function setCommandePartiel(bool $commande_partiel): static
    {
        $this->commande_partiel = $commande_partiel;

        return $this;
    }

    public function getReferenceProduit(): ?string
    {
        return $this->reference_produit;
    }

    public function setReferenceProduit(string $reference_produit): static
    {
        $this->reference_produit = $reference_produit;

        return $this;
    }

    public function getTotalPrix(): ?float
    {
        return $this->total_prix;
    }

    public function setTotalPrix(float $total_prix): static
    {
        $this->total_prix = $total_prix;

        return $this;
    }

    public function getQuantiteProduit(): ?int
    {
        return $this->quantite_produit;
    }

    public function setQuantiteProduit(int $quantite_produit): static
    {
        $this->quantite_produit = $quantite_produit;

        return $this;
    }

    public function getLivraison(): ?livraison
    {
        return $this->livraison;
    }

    public function setLivraison(?livraison $livraison): static
    {
        $this->livraison = $livraison;

        return $this;
    }

    /**
     * @return Collection<int, facture>
     */
    public function getFacture(): Collection
    {
        return $this->facture;
    }

    public function addFacture(facture $facture): static
    {
        if (!$this->facture->contains($facture)) {
            $this->facture->add($facture);
            $facture->setCommande($this);
        }

        return $this;
    }

    public function removeFacture(facture $facture): static
    {
        if ($this->facture->removeElement($facture)) {
            // set the owning side to null (unless already changed)
            if ($facture->getCommande() === $this) {
                $facture->setCommande(null);
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
            $client->addPrepare($this);
        }

        return $this;
    }

    public function removeClient(Client $client): static
    {
        if ($this->clients->removeElement($client)) {
            $client->removePrepare($this);
        }

        return $this;
    }
}
