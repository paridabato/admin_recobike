<?php

namespace App\Entity;

use App\Repository\KitsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KitsRepository::class)
 */
class Kits
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id_kit;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $num_depart;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $num_fin;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Grossistes")
     * @ORM\JoinColumn(name="id_grossiste", referencedColumnName="id_grossiste")
     */
    private $id_grossiste;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Fabriquants")
     * @ORM\JoinColumn(name="id_fabriquant", referencedColumnName="id_fabriquant")
     */
    private $id_fabriquant;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Magasins")
     * @ORM\JoinColumn(name="id_magasin", referencedColumnName="id_magasin")
     */
    private $id_magasin;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $num_client;

    public function getId(): ?int
    {
        return $this->id_kit;
    }

    public function getNumDepart(): ?string
    {
        return $this->num_depart;
    }

    public function setNumDepart(string $num_depart): self
    {
        $this->num_depart = $num_depart;

        return $this;
    }

    public function getNumFin(): ?string
    {
        return $this->num_fin;
    }

    public function setNumFin(string $num_fin): self
    {
        $this->num_fin = $num_fin;

        return $this;
    }

    public function getIdGrossiste(): ?Grossistes
    {
        return $this->id_grossiste;
    }

    public function setIdGrossiste(Grossistes $id_grossiste): self
    {
        $this->id_grossiste = $id_grossiste;

        return $this;
    }

    public function getIdFabriquant(): ?Fabriquants
    {
        return $this->id_fabriquant;
    }

    public function setIdFabriquant(?Fabriquants $id_fabriquant): self
    {
        $this->id_fabriquant = $id_fabriquant;

        return $this;
    }

    public function getIdMagasin(): ?Magasins
    {
        return $this->id_magasin;
    }

    public function setIdMagasin(?Magasins $id_magasin): self
    {
        $this->id_magasin = $id_magasin;

        return $this;
    }

    public function getNumClient(): ?string
    {
        return $this->num_client;
    }

    public function setNumClient(string $num_client): self
    {
        $this->num_client = $num_client;

        return $this;
    }
}
