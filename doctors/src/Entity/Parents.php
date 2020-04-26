<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParentsRepository")
 */
class Parents
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idUser;



    /**
     * @ORM\Column(type="string", length=300, nullable=true)
     */
    private $nomComplete;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tele;

      /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $age;

    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(?int $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

  


  

    public function getNomComplete(): ?string
    {
        return $this->nomComplete;
    }

    public function setNomComplete(?string $nomComplete): self
    {
        $this->nomComplete = $nomComplete;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTele(): ?int
    {
        return $this->tele;
    }

    public function setTele(?int $tele): self
    {
        $this->tele = $tele;

        return $this;
    }


    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(?string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }
}
