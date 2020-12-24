<?php

namespace App\Entity;

use App\Repository\ProprietairesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProprietairesRepository::class)
 */
class Proprietaires
{
    private $method = 'aes-128-cbc';
    private $key = 'ricobike';
    private $iv = '34857d973953e44afb49ea9d61104d8c';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id_proprietaire;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $civilite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $raison_sociale;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $code_postal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_naissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $mobile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_creation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_modification;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dernier_acces;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $token;

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id_proprietaire;
    }

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(string $civilite): self
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getNom(): ?string
    {
        return openssl_decrypt($this->nom, $this->method, $this->key, 0, $this->getIv());
    }

    public function setNom(string $nom): self
    {
        $this->nom = openssl_encrypt($nom, $this->method, $this->key, 0, $this->getIv());

        return $this;
    }

    public function getPrenom(): ?string
    {
        return openssl_decrypt($this->prenom, $this->method, $this->key, 0, $this->getIv());
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = openssl_encrypt($prenom, $this->method, $this->key, 0, $this->getIv());

        return $this;
    }

    public function getRaisonSociale(): ?string
    {
        return openssl_decrypt($this->raison_sociale, $this->method, $this->key, 0, $this->getIv());
    }

    public function setRaisonSociale(?string $raison_sociale): self
    {
        $this->raison_sociale = openssl_encrypt($raison_sociale, $this->method, $this->key, 0, $this->getIv());

        return $this;
    }

    public function getAdresse(): ?string
    {
        return openssl_decrypt($this->adresse, $this->method, $this->key, 0, $this->getIv());
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = openssl_encrypt($adresse, $this->method, $this->key, 0, $this->getIv());

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return openssl_decrypt($this->code_postal, $this->method, $this->key, 0, $this->getIv());
    }

    public function setCodePostal(string $code_postal): self
    {
        $this->code_postal = openssl_encrypt($code_postal, $this->method, $this->key, 0, $this->getIv());

        return $this;
    }

    public function getVille(): ?string
    {
        return openssl_decrypt($this->ville, $this->method, $this->key, 0, $this->getIv());
    }

    public function setVille(string $ville): self
    {
        $this->ville = openssl_encrypt($ville, $this->method, $this->key, 0, $this->getIv());

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(?\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return openssl_decrypt($this->telephone, $this->method, $this->key, 0, $this->getIv());
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = openssl_encrypt($telephone, $this->method, $this->key, 0, $this->getIv());

        return $this;
    }

    public function getMobile(): ?string
    {
        return openssl_decrypt($this->mobile, $this->method, $this->key, 0, $this->getIv());
    }

    public function setMobile(?string $mobile): self
    {
        $this->mobile = openssl_encrypt($mobile, $this->method, $this->key, 0, $this->getIv());

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getDateModification(): ?\DateTimeInterface
    {
        return $this->date_modification;
    }

    public function setDateModification(?\DateTimeInterface $date_modification): self
    {
        $this->date_modification = $date_modification;

        return $this;
    }

    public function getDernierAcces(): ?\DateTimeInterface
    {
        return $this->dernier_acces;
    }

    public function setDernierAcces(?\DateTimeInterface $dernier_acces): self
    {
        $this->dernier_acces = $dernier_acces;

        return $this;
    }

    public function getIv(){
        return hex2bin($this->iv);
    }
}
