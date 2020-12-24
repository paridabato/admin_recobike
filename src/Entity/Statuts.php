<?php

namespace App\Entity;

use App\Repository\StatutsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatutsRepository::class)
 */
class Statuts
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id_statut;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $nom_statut;

    public function getId(): ?int
    {
        return $this->id_statut;
    }

    public function getNomStatut(): ?string
    {
        return $this->nom_statut;
    }

    public function setNomStatut(string $nom_statut): self
    {
        $this->nom_statut = $nom_statut;

        return $this;
    }
}
