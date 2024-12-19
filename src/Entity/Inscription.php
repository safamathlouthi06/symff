<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateI = null;

    #[ORM\Column(length: 255)]
    private ?string $etatI = null;

    #[ORM\ManyToOne(inversedBy: 'inscription')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Event $events = null;

    #[ORM\ManyToOne(inversedBy: 'inscription')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateI(): ?\DateTimeInterface
    {
        return $this->dateI;
    }

    public function setDateI(\DateTimeInterface $dateI): static
    {
        $this->dateI = $dateI;

        return $this;
    }

    public function getEtatI(): ?string
    {
        return $this->etatI;
    }

    public function setEtatI(string $etatI): static
    {
        $this->etatI = $etatI;

        return $this;
    }

    public function getEvents(): ?Event
    {
        return $this->events;
    }

    public function setEvents(?Event $events): static
    {
        $this->events = $events;

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
