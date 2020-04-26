<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlogRepository")
 */
class Blog
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
    private $titre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idCategorieBlog;

       /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idPediatre;

        /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idJaime;

    
        /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $countComment;




    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateBlog;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageBlog;

    /**
     * @ORM\Column(type="string", length=6000, nullable=true)
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getIdCategorieBlog(): ?int
    {
        return $this->idCategorieBlog;
    }

    public function setIdCategorieBlog(?int $idCategorieBlog): self
    {
        $this->idCategorieBlog = $idCategorieBlog;

        return $this;
    }


    public function getIdPediatre(): ?int
    {
        return $this->idPediatre;
    }

    public function setIdPediatre(?int $idPediatre): self
    {
        $this->idPediatre = $idPediatre;

        return $this;
    }

 

    public function getIdJaime(): ?int
    {
        return $this->idJaime;
    }

    public function setIdJaime(?int $idJaime): self
    {
        $this->idJaime = $idJaime;

        return $this;
    }

    public function getCountComment(): ?int
    {
        return $this->countComment;
    }

    public function setCountComment(?int $countComment): self
    {
        $this->countComment = $countComment;

        return $this;
    }

    public function getDateBlog(): ?\DateTimeInterface
    {
        return $this->dateBlog;
    }

    public function setDateBlog(?\DateTimeInterface $dateBlog): self
    {
        $this->dateBlog = $dateBlog;

        return $this;
    }

    public function getImageBlog(): ?string
    {
        return $this->imageBlog;
    }

    public function setImageBlog(?string $imageBlog): self
    {
        $this->imageBlog = $imageBlog;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
