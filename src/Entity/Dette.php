<?php

namespace App\Entity;

use App\Repository\DetteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetteRepository::class)]
class Dette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\Column]
    private ?float $montantVersee = null;

    #[ORM\Column]
    private ?float $montantRestant = null;

    #[ORM\Column]
    private ?bool $solde = null;

    #[ORM\ManyToOne(inversedBy: 'dette')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getMontantVersee(): ?float
    {
        return $this->montantVersee;
    }

    public function setMontantVersee(float $montantVersee): static
    {
        $this->montantVersee = $montantVersee;

        return $this;
    }

    public function getMontantRestant(): ?float
    {
        return $this->montantRestant;
    }

    public function setMontantRestant(float $montantRestant): static
    {
        $this->montantRestant = $montantRestant;

        return $this;
    }

    public function isSolde(): ?bool
    {
        return $this->solde;
    }

    public function setSolde(bool $solde): static
    {
        $this->solde = $solde;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }
}
