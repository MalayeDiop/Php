<?php

namespace App\Entity;

use App\Repository\DetteEntityRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetteEntityRepository::class)]
#[ORM\Table(name: "dettes")]
class DetteEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // #[ORM\Column(type: Types::DATE_MUTABLE)]
    // private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?int $montant = null;

    #[ORM\Column(nullable: true)]
    private ?int $montantverse = null;

    #[ORM\Column(nullable: true)]
    private ?int $montantrestant = null;

    #[ORM\ManyToOne(targetEntity: ClientEntity::class, inversedBy: 'dettes')]
    #[ORM\JoinColumn(nullable: false)]
    private $client;

    // #[ORM\Column]
    // private ?\DateTimeImmutable $createAt = null;

    // #[ORM\Column]
    // private ?\DateTimeImmutable $updateAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    // public function getDate(): ?\DateTimeInterface
    // {
    //     return $this->date;
    // }

    // public function setDate(\DateTimeInterface $date): static
    // {
    //     $this->date = $date;

    //     return $this;
    // }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getMontantVerse(): ?int
    {
        return $this->montantverse;
    }

    public function setMontantVerse(?int $montantverse): static
    {
        $this->montantverse = $montantverse;

        return $this;
    }

    public function getMontantRestant(): ?int
    {
        return $this->montantrestant;
    }

    public function setMontantRestant(?int $montantrestant): static
    {
        $this->montantrestant = $montantrestant;

        return $this;
    }

    public function getClient(): ?ClientEntity
    {
        return $this->client;
    }

    public function setClient(?ClientEntity $client): self
    {
        $this->client = $client;

        return $this;
    }

    // public function getCreateAt(): ?\DateTimeImmutable
    // {
    //     return $this->createAt;
    // }

    // public function setCreateAt(\DateTimeImmutable $createAt): static
    // {
    //     $this->createAt = $createAt;

    //     return $this;
    // }

    // public function getUpdateAt(): ?\DateTimeImmutable
    // {
    //     return $this->updateAt;
    // }

    // public function setUpdateAt(\DateTimeImmutable $updateAt): static
    // {
    //     $this->updateAt = $updateAt;

    //     return $this;
    // }
}
