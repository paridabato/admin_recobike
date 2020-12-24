<?php

namespace App\Entity;

use App\Repository\MarquagesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarquagesRepository::class)
 */
class Marquages
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id_marquage;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $source;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $numero;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true)
     */
    private $id_grossiste;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true)
     */
    private $id_fabriquant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Magasins")
     * @ORM\JoinColumn(name="id_magasin", referencedColumnName="id_magasin")
     */
    private $id_magasin;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $type_engin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modele;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $couleur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Statuts")
     * @ORM\JoinColumn(name="id_statut", referencedColumnName="id_statut")
     */
    private $id_statut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $num_serie_velo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $num_serie_moteur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mum_serie_batterie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Proprietaires")
     * @ORM\JoinColumn(name="id_proprietaire", referencedColumnName="id_proprietaire")
     */
    private $id_proprietaire;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentaires;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_enregistrement;

    public function getIdMarquage(): ?int
    {
        return $this->id_marquage;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(string $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getIdGrossiste(): ?int
    {
        return $this->id_grossiste;
    }

    public function setIdGrossiste(?int $id_grossiste): self
    {
        $this->id_grossiste = $id_grossiste;

        return $this;
    }

    public function getIdFabriquant(): ?int
    {
        return $this->id_fabriquant;
    }

    public function setIdFabriquant(?int $id_fabriquant): self
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

    public function getTypeEngin(): ?string
    {
        return $this->type_engin;
    }

    public function setTypeEngin(string $type_engin): self
    {
        $this->type_engin = $type_engin;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getIdStatut(): ?Statuts
    {
        return $this->id_statut;
    }

    public function setIdStatut(Statuts $id_statut): self
    {
        $this->id_statut = $id_statut;

        return $this;
    }

    public function getNumSerieVelo(): ?string
    {
        return $this->num_serie_velo;
    }

    public function setNumSerieVelo(string $num_serie_velo): self
    {
        $this->num_serie_velo = $num_serie_velo;

        return $this;
    }

    public function getNumSerieMoteur(): ?string
    {
        return $this->num_serie_moteur;
    }

    public function setNumSerieMoteur(?string $num_serie_moteur): self
    {
        $this->num_serie_moteur = $num_serie_moteur;

        return $this;
    }

    public function getMumSerieBatterie(): ?string
    {
        return $this->mum_serie_batterie;
    }

    public function setMumSerieBatterie(?string $mum_serie_batterie): self
    {
        $this->mum_serie_batterie = $mum_serie_batterie;

        return $this;
    }

    public function getIdProprietaire(): ?Proprietaires
    {
        return $this->id_proprietaire;
    }

    public function setIdProprietaire(?Proprietaires $id_proprietaire): self
    {
        $this->id_proprietaire = $id_proprietaire;

        return $this;
    }

    public function getCommentaires(): ?string
    {
        return $this->commentaires;
    }

    public function setCommentaires(?string $commentaires): self
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    public function getDateEnregistrement(): ?\DateTimeInterface
    {
        return $this->date_enregistrement;
    }

    public function setDateEnregistrement(?\DateTimeInterface $date_enregistrement): self
    {
        $this->date_enregistrement = $date_enregistrement;

        return $this;
    }

}
