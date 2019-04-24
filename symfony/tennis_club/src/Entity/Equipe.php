<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EquipeRepository")
 */
class Equipe
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
    private $IDMembre;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $Division;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIDMembre(): ?int
    {
        return $this->IDMembre;
    }

    public function setIDMembre(int $IDMembre): self
    {
        $this->IDMembre = $IDMembre;

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
}
