<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CoursRepository")
 */
class Cours
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateCours;

    /**
     * @ORM\Column(type="integer")
     */
    private $DureeCours;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Staff")
     */
    private $IDCoachCours;

    /**
     * @ORM\Column(type="integer")
     */
    private $EffectifCours;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CompteClient", inversedBy="inscriptions")
     */
    private $inscriptions;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCours(): ?\DateTimeInterface
    {
        return $this->DateCours;
    }

    public function setDateCours(\DateTimeInterface $DateCours): self
    {
        $this->DateCours = $DateCours;

        return $this;
    }

    public function getDureeCours(): ?int
    {
        return $this->DureeCours;
    }

    public function setDureeCours(int $DureeCours): self
    {
        $this->DureeCours = $DureeCours;

        return $this;
    }

    public function getIDCoachCours(): ?Staff
    {
        return $this->IDCoachCours;
    }

    public function setIDCoachCours(?Staff $IDCoachCours): self
    {
        $this->IDCoachCours = $IDCoachCours;

        return $this;
    }

    public function getEffectifCours(): ?int
    {
        return $this->EffectifCours;
    }

    public function setEffectifCours(int $EffectifCours): self
    {
        $this->EffectifCours = $EffectifCours;

        return $this;
    }

    /**
     * @return Collection|CompteClient[]
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(CompteClient $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions[] = $inscription;
        }

        return $this;
    }

    public function removeInscription(CompteClient $inscription): self
    {
        if ($this->inscriptions->contains($inscription)) {
            $this->inscriptions->removeElement($inscription);
        }

        return $this;
    }
    
}
