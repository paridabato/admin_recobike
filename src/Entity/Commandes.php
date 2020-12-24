<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandesRepository::class)
 */
class Commandes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id_commande;

    /**
     * @ORM\Column(type="integer")
     */
    public $numero_commande;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Magasins")
     * @ORM\JoinColumn(name="id_magasin", referencedColumnName="id_magasin")
     */
    private $id_magasin;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $facture;

    public function getId(): ?int
    {
        return $this->id_commande;
    }

    public function getNumeroCommande(): ?int
    {
        return $this->numero_commande;
    }

    public function setNumeroCommande(int $numero_commande): self
    {
        $this->numero_commande = $numero_commande;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setData(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIdMagasin(): ?Magasins
    {
        return $this->id_magasin;
    }

    public function setIdMagasin(Magasins $id_magasin): self
    {
        $this->id_magasin = $id_magasin;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getFacture(): ?string
    {
        return $this->facture;
    }

    public function setFacture(string $facture): self
    {
        $this->facture = $facture;

        return $this;
    }
}
