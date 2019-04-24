<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompteClientRepository")
 * @UniqueEntity(fields = "mail",message = "cette adresse e-mail est déjà utilisée !")
 */
class CompteClient implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\Length(max=255)
     */

    private $nom;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\Length(max=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\Length(min=3, max=255, minMessage = "Trop court!")
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Assert\Length(min=10, max=10, minMessage = "Trop court!", maxMessage = "Trop long !")
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=8, max=255, minMessage="le mot de passe doit faire au moins 8 caractères !");
     */
    private $mdp;

    /**
     * @Assert\EqualTo(propertyPath= "mdp", message="veuillez re-taper votre mot de passe !");
     */
    public $confirm_mdp;

    /**
     * @ORM\Column(type="date")
     * 
     */
    private $date_de_naissance;

    /**
     * @ORM\Column(type="integer")
     */
    private $droits;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $classement;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Cours", mappedBy="inscriptions")
     */
    private $inscriptions;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setID(int $ID): self
    {
        $this->ID = $ID;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->date_de_naissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $date_de_naissance): self
    {
        $this->date_de_naissance = $date_de_naissance;

        return $this;
    }

    public function getDroits(): ?int
    {
        return $this->droits;
    }

    public function setDroits(int $droits): self
    {
        $this->droits = $droits;

        return $this;
    }

    public function getClassement(): ?string
    {
        return $this->classement;
    }

    public function setClassement(?string $classement): self
    {
        $this->classement = $classement;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->mail;
    }
    public function getPassword(): ?string
    {
        return $this->mdp;
    }

    public function eraseCredentials(){

    }

    public function getSalt(){

    }

    public function getRoles()
    {
        switch($this->getDroits()){
            case 0:
                return ['ROLE_ADMIN'];
                break;
            case 1:
                return ['ROLE_USER'];
                break;
            case 2:
                return ['ROLE_SUPER_ADMIN'];
                break;
        }
    }

    /**
     * @return Collection|Cours[]
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Cours $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions[] = $inscription;
            $inscription->addInscription($this);
        }

        return $this;
    }

    public function removeInscription(Cours $inscription): self
    {
        if ($this->inscriptions->contains($inscription)) {
            $this->inscriptions->removeElement($inscription);
            $inscription->removeInscription($this);
        }

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }


}
