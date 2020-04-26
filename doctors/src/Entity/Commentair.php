<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentairRepository")
 */
class Commentair
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
    private $email;

       /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

       /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

       /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateComment;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idArticles;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $cmnt;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
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

    public function getDateComment(): ?\DateTimeInterface
    {
        return $this->dateComment;
    }

    public function setDateComment(?\DateTimeInterface $dateComment): self
    {
        $this->dateComment = $dateComment;

        return $this;
    }

    public function getIdArticles(): ?int
    {
        return $this->idArticles;
    }

    public function setIdArticles(?int $idArticles): self
    {
        $this->idArticles = $idArticles;

        return $this;
    }

    public function getCmnt(): ?string
    {
        return $this->cmnt;
    }

    public function setCmnt(?string $cmnt): self
    {
        $this->cmnt = $cmnt;

        return $this;
    }
}
