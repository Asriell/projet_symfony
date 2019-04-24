<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EvenementRepository")
 */
class Evenement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $TitreEvenements;

    /**
     * @ORM\Column(type="text")
     */
    private $DetailsEvenements;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateEvenements;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaires", mappedBy="Evenement", orphanRemoval=true)
     */
    private $commentaires;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreEvenements(): ?string
    {
        return $this->TitreEvenements;
    }

    public function setTitreEvenements(string $TitreEvenements): self
    {
        $this->TitreEvenements = $TitreEvenements;

        return $this;
    }

    public function getDetailsEvenements(): ?string
    {
        return $this->DetailsEvenements;
    }

    public function setDetailsEvenements(string $DetailsEvenements): self
    {
        $this->DetailsEvenements = $DetailsEvenements;

        return $this;
    }

    public function getDateEvenements(): ?\DateTimeInterface
    {
        return $this->DateEvenements;
    }

    public function setDateEvenements(\DateTimeInterface $DateEvenements): self
    {
        $this->DateEvenements = $DateEvenements;

        return $this;
    }

    /**
     * @return Collection|Commentaires[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaires $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setEvenement($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaires $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getEvenement() === $this) {
                $commentaire->setEvenement(null);
            }
        }

        return $this;
    }
}
