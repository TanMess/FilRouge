<?php

namespace App\Entity;

use App\Repository\EmployeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeRepository::class)]
class Employe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $mail_emp = null;

    #[ORM\Column(length: 50)]
    private ?string $role_emp = null;

    /**
     * @var Collection<int, Client>
     */
    #[ORM\ManyToMany(targetEntity: Client::class, mappedBy: 'employe')]
    private Collection $clients;

    /**
     * @var Collection<int, produits>
     */
    #[ORM\ManyToMany(targetEntity: Produits::class, inversedBy: 'employes')]
    private Collection $produit;

    /**
     * @var Collection<int, fournisseur>
     */
    #[ORM\ManyToMany(targetEntity: Fournisseur::class, inversedBy: 'employes')]
    private Collection $fournisseur;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
        $this->produit = new ArrayCollection();
        $this->fournisseur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMailEmp(): ?string
    {
        return $this->mail_emp;
    }

    public function setMailEmp(string $mail_emp): static
    {
        $this->mail_emp = $mail_emp;

        return $this;
    }

    public function getRoleEmp(): ?string
    {
        return $this->role_emp;
    }

    public function setRoleEmp(string $role_emp): static
    {
        $this->role_emp = $role_emp;

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
            $client->addEmploye($this);
        }

        return $this;
    }

    public function removeClient(Client $client): static
    {
        if ($this->clients->removeElement($client)) {
            $client->removeEmploye($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, produits>
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(produits $produit): static
    {
        if (!$this->produit->contains($produit)) {
            $this->produit->add($produit);
        }

        return $this;
    }

    public function removeProduit(produits $produit): static
    {
        $this->produit->removeElement($produit);

        return $this;
    }

    /**
     * @return Collection<int, fournisseur>
     */
    public function getFournisseur(): Collection
    {
        return $this->fournisseur;
    }

    public function addFournisseur(fournisseur $fournisseur): static
    {
        if (!$this->fournisseur->contains($fournisseur)) {
            $this->fournisseur->add($fournisseur);
        }

        return $this;
    }

    public function removeFournisseur(fournisseur $fournisseur): static
    {
        $this->fournisseur->removeElement($fournisseur);

        return $this;
    }
}
