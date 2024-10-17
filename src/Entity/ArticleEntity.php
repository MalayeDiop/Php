<?php

namespace App\Entity;

use App\Repository\ArticleEntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ArticleEntityRepository::class)]
#[ORM\Table(name: 'articles')]
#[UniqueEntity('libelle', message: 'Cet article existe déjà')]
class ArticleEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 100)]
    private ?string $ref = null;

    #[ORM\Column(type: 'string', length: 100)]
    private ?string $libelle = null;

    #[ORM\Column(type: 'integer', length: 15)]
    private ?int $qte_stock = null;
    // #[ORM\Column(type: 'integer', length: 15)]
    // private ?int $qteStock = null;

    #[ORM\Column(type: 'integer', length: 15)]
    private ?int $prix = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getQte_stock(): ?int
    {
        return $this->qte_stock;
    }

    public function setQte_stock(int $qte_stock): self
    {
        $this->qte_stock = $qte_stock;

        return $this;
    }

    // public function getQteStock(): ?int
    // {
    //     return $this->qteStock;
    // }

    // public function setQteStock(int $qteStock): self
    // {
    //     $this->qteStock = $qteStock;

    //     return $this;
    // }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
}
