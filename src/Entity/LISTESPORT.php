<?php

namespace App\Entity;

use App\Repository\LISTESPORTRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LISTESPORTRepository::class)]
class LISTESPORT
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 55)]
    private ?string $sport = null;

    #[ORM\OneToMany(mappedBy: 'fk_listesport', targetEntity: CLIENTSPORT::class)]
    private Collection $fk_clientsport;

    public function __construct()
    {
        $this->fk_clientsport = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSport(): ?string
    {
        return $this->sport;
    }

    public function setSport(string $sport): static
    {
        $this->sport = $sport;

        return $this;
    }

    /**
     * @return Collection<int, CLIENTSPORT>
     */
    public function getFkClientsport(): Collection
    {
        return $this->fk_clientsport;
    }

    public function addFkClientsport(CLIENTSPORT $fkClientsport): static
    {
        if (!$this->fk_clientsport->contains($fkClientsport)) {
            $this->fk_clientsport->add($fkClientsport);
            $fkClientsport->setFkListesport($this);
        }

        return $this;
    }

    public function removeFkClientsport(CLIENTSPORT $fkClientsport): static
    {
        if ($this->fk_clientsport->removeElement($fkClientsport)) {
            // set the owning side to null (unless already changed)
            if ($fkClientsport->getFkListesport() === $this) {
                $fkClientsport->setFkListesport(null);
            }
        }

        return $this;
    }
}
