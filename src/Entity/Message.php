<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $creator_email;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $reply_to_id;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $text;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isClosed;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatorEmail(): ?string
    {
        return $this->creator_email;
    }

    public function setCreatorEmail(string $creator_email): self
    {
        $this->creator_email = $creator_email;

        return $this;
    }

    public function getReplyToId(): ?int
    {
        return $this->reply_to_id;
    }

    public function setReplyToId(?int $reply_to_id): self
    {
        $this->reply_to_id = $reply_to_id;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getIsClosed(): ?bool
    {
        return $this->isClosed;
    }

    public function setIsClosed(bool $isClosed): self
    {
        if ($isClosed == null){
            $$isClosed = 0;
        }
        $this->isClosed = $isClosed;

        return $this;
    }
}
