<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TopicRepository")
 */
class Topic
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
    private $TitreTopic;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompteClient")
     * @ORM\JoinColumn(nullable=false)
     */
    private $IDAuteurTopic;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Post", mappedBy="IDTopic", orphanRemoval=true)
     */
    private $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreTopic(): ?string
    {
        return $this->TitreTopic;
    }

    public function setTitreTopic(string $TitreTopic): self
    {
        $this->TitreTopic = $TitreTopic;

        return $this;
    }

    public function getIDAuteurTopic(): ?CompteClient
    {
        return $this->IDAuteurTopic;
    }

    public function setIDAuteurTopic(?CompteClient $IDAuteurTopic): self
    {
        $this->IDAuteurTopic = $IDAuteurTopic;

        return $this;
    }

    /**
     * @return Collection|Post[]
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setIDTopic($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->contains($post)) {
            $this->posts->removeElement($post);
            // set the owning side to null (unless already changed)
            if ($post->getIDTopic() === $this) {
                $post->setIDTopic(null);
            }
        }

        return $this;
    }
}
