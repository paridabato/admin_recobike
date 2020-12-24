<?php

namespace App\Entity;

use App\Repository\CommandesLignesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandesLignesRepository::class)
 */
class CommandesLignes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id_ligne;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Commandes")
     * @ORM\JoinColumn(name="id_commande", referencedColumnName="id_commande")
     */
    private $id_commande;

    /**
     * @ORM\Column(type="integer")
     */
    public $id_produit;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0, nullable=true)
     */
    public $prix_unitaire;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0, nullable=true)
     */
    public $prix_total;

    public function getId(): ?int
    {
        return $this->id_ligne;
    }

    public function getIdCommande(): ?Commandes
    {
        return $this->id_commande;
    }

    public function setIdCommande(Commandes $id_commande): self
    {
        $this->id_commande = $id_commande;

        return $this;
    }

    public function getIdProduit(): ?int
    {
        return $this->id_produit;
    }

    public function setIdProduit(int $id_produit): self
    {
        $this->id_produit = $id_produit;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrixUnitaire(): ?string
    {
        return $this->prix_unitaire;
    }

    public function setPrixUnitaire(?string $prix_unitaire): self
    {
        $this->prix_unitaire = $prix_unitaire;

        return $this;
    }

    public function getPrixTotal(): ?string
    {
        return $this->prix_total;
    }

    public function setPrixTotal(?string $prix_total): self
    {
        $this->prix_total = $prix_total;

        return $this;
    }
}
