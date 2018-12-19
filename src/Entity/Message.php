<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     /**     * @ORM\OneToOne(
     *     targetEntity="Acme\UserBundle\Entity\ActiveMessage", 
     *     mappedBy="ActiveMessage"
     * )
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
     * @ORM\Column(type="boolean")
     */

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
}
