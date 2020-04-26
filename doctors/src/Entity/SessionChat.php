<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SessionChatRepository")
 */
class SessionChat
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
    private $destinateurEmail;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $message;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $destinatairEmail;

  

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDestinateurEmail(): ?string
    {
        return $this->destinateurEmail;
    }

    public function setDestinateurEmail(?string $destinateurEmail): self
    {
        $this->destinateurEmail = $destinateurEmail;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getDestinatairEmail(): ?string
    {
        return $this->destinatairEmail;
    }

    public function setDestinatairEmail(?string $destinatairEmail): self
    {
        $this->destinatairEmail = $destinatairEmail;

        return $this;
    }


}
