<?php

namespace App\Entity;

use App\Repository\DocumentsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DocumentsRepository::class)
 */
class Documents
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_marquage;

    /**
     * @ORM\Column(type="integer")
     */
    private $type_document;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_document;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMarquage(): ?int
    {
        return $this->id_marquage;
    }

    public function setIdMarquage(int $id_marquage): self
    {
        $this->id_marquage = $id_marquage;

        return $this;
    }

    public function getTypeDocument(): ?int
    {
        return $this->type_document;
    }

    public function setTypeDocument(int $type_document): self
    {
        $this->type_document = $type_document;

        return $this;
    }

    public function getNomDocument(): ?string
    {
        return $this->nom_document;
    }

    public function setNomDocument(string $nom_document): self
    {
        $this->nom_document = $nom_document;

        return $this;
    }
}
