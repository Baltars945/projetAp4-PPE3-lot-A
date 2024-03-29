<?php

namespace App\Entity;

use App\Repository\JOURNALISATIONRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JOURNALISATIONRepository::class)]
class JOURNALISATION
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?int $depassement = null;

    #[ORM\ManyToOne(inversedBy: 'journalisation')]
    private ?PRODUIT $produit = null;

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

    public function getDepassement(): ?int
    {
        return $this->depassement;
    }

    public function setDepassement(int $depassement): static
    {
        $this->depassement = $depassement;

        return $this;
    }

    public function getProduit(): ?PRODUIT
    {
        return $this->produit;
    }

    public function setProduit(?PRODUIT $produit): static
    {
        $this->produit = $produit;

        return $this;
    }
}
