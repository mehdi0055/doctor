<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EnfantsRepository")
 */
class Enfants
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
    private $nomComplet;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idParent;

      /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idTest;

        /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idConseilNutrition;

        /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idSanteEnfant;

   

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sexe;

       /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $naissance ;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomComplet(): ?string
    {
        return $this->nomComplet;
    }

    public function setNomComplet(?string $nomComplet): self
    {
        $this->nomComplet = $nomComplet;

        return $this;
    }

    public function getIdParent(): ?int
    {
        return $this->idParent;
    }

    public function setIdParent(?int $idParent): self
    {
        $this->idParent = $idParent;

        return $this;
    }

    public function getIdTest(): ?int
    {
        return $this->idTest;
    }

    public function setIdTest(?int $idTest): self
    {
        $this->idTest = $idTest;

        return $this;
    }

    
    public function getIdConseilNutrition(): ?int
    {
        return $this->idConseilNutrition;
    }

    public function setIdConseilNutrition(?int $idConseilNutrition): self
    {
        $this->idConseilNutrition = $idConseilNutrition;

        return $this;
    }

    public function getIdSanteEnfant(): ?int
    {
        return $this->idSanteEnfant;
    }

    public function setIdSanteEnfant(?int $idSanteEnfant): self
    {
        $this->idSanteEnfant = $idSanteEnfant;

        return $this;
    }



    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(?string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }



    
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getNaissance(): ?\DateTimeInterface
    {
        return $this->naissance;
    }

    public function setNaissance(?\DateTimeInterface $naissance): self
    {
        $this->naissance = $naissance;

        return $this;
    }

}
