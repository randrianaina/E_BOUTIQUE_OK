<?php

namespace App\Entity;

use App\Repository\LignesdecommandesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LignesdecommandesRepository::class)
 */
class Lignesdecommandes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity=Commandes::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCommande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(string $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getIdCommande(): ?Commandes
    {
        return $this->idCommande;
    }

    public function setIdCommande(?Commandes $idCommande): self
    {
        $this->idCommande = $idCommande;

        return $this;
    }
}
