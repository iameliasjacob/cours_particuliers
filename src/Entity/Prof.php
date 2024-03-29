<?php

namespace App\Entity;

use DateTime;
use App\Entity\Avis;
use App\Entity\Message;
use App\Entity\PrixActivite;
use App\Entity\SessionCours;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfRepository")
 */
class Prof implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="Prof", orphanRemoval=true)
     */
    private $messages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Avis", mappedBy="prof", orphanRemoval=true)
     */
    private $avis;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PrixActivite", mappedBy="prof", orphanRemoval=true)
     */
    private $prixActivites;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SessionCours", mappedBy="prof", orphanRemoval=true)
     */
    private $sessionsCours;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->avis = new ArrayCollection();
        $this->prixActivites = new ArrayCollection();
        $this->sessionsCours = new ArrayCollection();
        $this->dateCreation = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(?float $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setProf($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getProf() === $this) {
                $message->setProf(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Avis[]
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): self
    {
        if (!$this->avis->contains($avi)) {
            $this->avis[] = $avi;
            $avi->setProf($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): self
    {
        if ($this->avis->contains($avi)) {
            $this->avis->removeElement($avi);
            // set the owning side to null (unless already changed)
            if ($avi->getProf() === $this) {
                $avi->setProf(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PrixActivite[]
     */
    public function getPrixActivites(): Collection
    {
        return $this->prixActivites;
    }

    public function addPrixActivite(PrixActivite $prixActivite): self
    {
        if (!$this->prixActivites->contains($prixActivite)) {
            $this->prixActivites[] = $prixActivite;
            $prixActivite->setProf($this);
        }

        return $this;
    }

    public function removePrixActivite(PrixActivite $prixActivite): self
    {
        if ($this->prixActivites->contains($prixActivite)) {
            $this->prixActivites->removeElement($prixActivite);
            // set the owning side to null (unless already changed)
            if ($prixActivite->getProf() === $this) {
                $prixActivite->setProf(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SessionCours[]
     */
    public function getSessionsCours(): Collection
    {
        return $this->sessionsCours;
    }

    public function addSessionsCour(SessionCours $sessionsCour): self
    {
        if (!$this->sessionsCours->contains($sessionsCour)) {
            $this->sessionsCours[] = $sessionsCour;
            $sessionsCour->setProf($this);
        }

        return $this;
    }

    public function removeSessionsCour(SessionCours $sessionsCour): self
    {
        if ($this->sessionsCours->contains($sessionsCour)) {
            $this->sessionsCours->removeElement($sessionsCour);
            // set the owning side to null (unless already changed)
            if ($sessionsCour->getProf() === $this) {
                $sessionsCour->setProf(null);
            }
        }

        return $this;
    }
}
