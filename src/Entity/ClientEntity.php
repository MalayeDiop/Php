<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClientEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ClientEntityRepository::class)]
#[ORM\Table(name: "clients")]
#[UniqueEntity('telephone', message: 'Ce numéro existe déjà')]
class ClientEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 100)]
    #[Assert\NotBlank(
        message : 'Veuillez saisir un nom valable',
    )]
    private ?string $nom = null;

    #[ORM\Column(type: "string", length: 100)]
    private ?string $prenom = null;

    #[ORM\Column(type: "string", length: 15, unique: true)]
    private ?string $telephone = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updateAt = null;

    #[ORM\Column]
    private ?bool $isBlocked = null;

    // #[ORM\OneToOne(inversedBy: 'client', cascade: ['persist', 'remove'])]
    // private ?UserEntity $user = null;

    #[ORM\OneToMany(targetEntity: DetteEntity::class, mappedBy: 'client', orphanRemoval: true)]
    private Collection $dettes;

    public function __construct() {
        $this->createAt = new \DateTimeImmutable();
        $this->updateAt = new \DateTimeImmutable();
        $this->dettes = new ArrayCollection;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeImmutable $createAt): static
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeImmutable $updateAt): static
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function isBlocked(): ?bool
    {
        return $this->isBlocked;
    }

    public function setBlocked(bool $isBlocked): static
    {
        $this->isBlocked = $isBlocked;

        return $this;
    }
    
    public function getDettes(): ?Collection
    {
        return $this->dettes;
    }

    public function setDettes(Collection $dettes): self
    {
        $this->dettes = $dettes;

        return $this;
    }

    // public function getUser(): ?UserEntity
    // {
    //     return $this->user;
    // }

    // public function setUser(UserEntity $user): self
    // {
    //     $this->user = $user;

    //     return $this;
    // }

    
}
