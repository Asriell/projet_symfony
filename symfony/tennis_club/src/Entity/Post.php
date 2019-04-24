<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Topic", inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $IDTopic;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompteClient")
     */
    private $IDAuteurPost;

    /**
     * @ORM\Column(type="text")
     */
    private $TextePost;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DatePost;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIDTopic(): ?Topic
    {
        return $this->IDTopic;
    }

    public function setIDTopic(?Topic $IDTopic): self
    {
        $this->IDTopic = $IDTopic;

        return $this;
    }

    public function getIDAuteurPost(): ?CompteClient
    {
        return $this->IDAuteurPost;
    }

    public function setIDAuteurPost(?CompteClient $IDAuteurPost): self
    {
        $this->IDAuteurPost = $IDAuteurPost;

        return $this;
    }

    public function getTextePost(): ?string
    {
        return $this->TextePost;
    }

    public function setTextePost(string $TextePost): self
    {
        $this->TextePost = $TextePost;

        return $this;
    }

    public function getDatePost(): ?\DateTimeInterface
    {
        return $this->DatePost;
    }

    public function setDatePost(\DateTimeInterface $DatePost): self
    {
        $this->DatePost = $DatePost;

        return $this;
    }
}
