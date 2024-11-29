<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(nullable: true)]
    private ?int $siret = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 20)]
    private ?string $telephone = null;

    #[ORM\Column(nullable: true)]
    private ?float $coefficient = null;

    #[ORM\Column]
    private ?bool $role = null;

    /**
     * @var Collection<int, adresse>
     */
    #[ORM\ManyToMany(targetEntity: Adresse::class, inversedBy: 'clients')]
    private Collection $adresse;

    /**
     * @var Collection<int, employe>
     */
    #[ORM\ManyToMany(targetEntity: Employe::class, inversedBy: 'clients')]
    private Collection $employe;

    /**
     * @var Collection<int, produits>
     */
    #[ORM\ManyToMany(targetEntity: Produits::class, inversedBy: 'clients')]
    private Collection $commande;

    /**
     * @var Collection<int, commande>
     */
    #[ORM\ManyToMany(targetEntity: Commande::class, inversedBy: 'clients')]
    private Collection $prepare;

    public function __construct()
    {
        $this->adresse = new ArrayCollection();
        $this->employe = new ArrayCollection();
        $this->commande = new ArrayCollection();
        $this->prepare = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSiret(): ?int
    {
        return $this->siret;
    }

    public function setSiret(?int $siret): static
    {
        $this->siret = $siret;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getCoefficient(): ?float
    {
        return $this->coefficient;
    }

    public function setCoefficient(?float $coefficient): static
    {
        $this->coefficient = $coefficient;

        return $this;
    }

    public function isRole(): ?bool
    {
        return $this->role;
    }

    public function setRole(bool $role): static
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection<int, adresse>
     */
    public function getAdresse(): Collection
    {
        return $this->adresse;
    }

    public function addAdresse(adresse $adresse): static
    {
        if (!$this->adresse->contains($adresse)) {
            $this->adresse->add($adresse);
        }

        return $this;
    }

    public function removeAdresse(adresse $adresse): static
    {
        $this->adresse->removeElement($adresse);

        return $this;
    }

    /**
     * @return Collection<int, employe>
     */
    public function getEmploye(): Collection
    {
        return $this->employe;
    }

    public function addEmploye(employe $employe): static
    {
        if (!$this->employe->contains($employe)) {
            $this->employe->add($employe);
        }

        return $this;
    }

    public function removeEmploye(employe $employe): static
    {
        $this->employe->removeElement($employe);

        return $this;
    }

    /**
     * @return Collection<int, produits>
     */
    public function getCommande(): Collection
    {
        return $this->commande;
    }

    public function addCommande(produits $commande): static
    {
        if (!$this->commande->contains($commande)) {
            $this->commande->add($commande);
        }

        return $this;
    }

    public function removeCommande(produits $commande): static
    {
        $this->commande->removeElement($commande);

        return $this;
    }

    /**
     * @return Collection<int, commande>
     */
    public function getPrepare(): Collection
    {
        return $this->prepare;
    }

    public function addPrepare(commande $prepare): static
    {
        if (!$this->prepare->contains($prepare)) {
            $this->prepare->add($prepare);
        }

        return $this;
    }

    public function removePrepare(commande $prepare): static
    {
        $this->prepare->removeElement($prepare);

        return $this;
    }
}
