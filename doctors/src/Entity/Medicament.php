<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MedicamentRepository")
 */
class Medicament
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $SocieterProd;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateProd;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Prix;

    /**
     * @ORM\Column(type="string", length=350, nullable=true)
     */
    private $Description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSocieterProd(): ?string
    {
        return $this->SocieterProd;
    }

    public function setSocieterProd(?string $SocieterProd): self
    {
        $this->SocieterProd = $SocieterProd;

        return $this;
    }

    public function getDateProd(): ?\DateTimeInterface
    {
        return $this->dateProd;
    }

    public function setDateProd(?\DateTimeInterface $dateProd): self
    {
        $this->dateProd = $dateProd;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(?float $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }
}
