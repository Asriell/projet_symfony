<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompetitionsRepository")
 */
class Competitions
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $IDEquipe;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $Division;

    /**
     * @ORM\Column(type="time")
     */
    private $HeureDebut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Lieu;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Domicile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIDEquipe(): ?int
    {
        return $this->IDEquipe;
    }

    public function setIDEquipe(int $IDEquipe): self
    {
        $this->IDEquipe = $IDEquipe;

        return $this;
    }

    public function getDivision(): ?string
    {
        return $this->Division;
    }

    public function setDivision(string $Division): self
    {
        $this->Division = $Division;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->HeureDebut;
    }

    public function setHeureDebut(\DateTimeInterface $HeureDebut): self
    {
        $this->HeureDebut = $HeureDebut;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->Lieu;
    }

    public function setLieu(string $Lieu): self
    {
        $this->Lieu = $Lieu;

        return $this;
    }

    public function getDomicile(): ?bool
    {
        return $this->Domicile;
    }

    public function setDomicile(bool $Domicile): self
    {
        $this->Domicile = $Domicile;

        return $this;
    }
}
