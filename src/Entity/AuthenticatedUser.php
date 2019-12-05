<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuthenticatedUserRepository")
 * @UniqueEntity(fields={"username"},
 * message="Cette valeur est dejà utilisé par un autre utilisateur"
 * )
 * @ORM\HasLifecycleCallbacks()
 */
class AuthenticatedUser implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="authenticateduser")
     */
    private $comments;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tricks", mappedBy="authenticateduser")
     */
    private $tricks;


    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->tricks = new ArrayCollection();
    }


    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(min="4", minMessage="Votre login doit faire minimum 4 caractères")
     * @Assert\NotNull
     */
    private $username;





    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotNull
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotNull
     */
    private $contact;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(min="6", minMessage="Votre mot de passe doit faire minimum 6 caractères")

     */
    private $password;


    /**
     * @Assert\EqualTo(propertyPath="password", message="Veuillez saisir un mot de passe identique")
     */
    public $confirm_password;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedate;

    /**
     * @return mixed
     */
    public function getPwdtokendat()
    {
        return $this->pwdtokendat;
    }

    /**
     * @param mixed $pwdtokendat
     * @return AuthenticatedUser
     */
    public function setPwdtokendat($pwdtokendat)
    {
        $this->pwdtokendat = $pwdtokendat;
        return $this;
    }


    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $pwdtokendat;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $token;


    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return AuthenticatedUser
     */
    public function setToken($token): AuthenticatedUser
    {
        $this->token = $token;
        return $this;
    }














    /**
     * Permet de générer la date de création et de modification
     * @ORM\PrePersist
     * @throws \Exception
     */
    public function prePersist()
    {
        if (empty($this->createdate)) {
            $this->createdate =new \DateTime();
        }

        if (empty($this->updatedate)) {
            $this->updatedate=new \DateTime();
        }
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

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

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture($picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getCreatedate(): ?\DateTimeInterface
    {
        return $this->createdate;
    }

    public function setCreatedate(\DateTimeInterface $createdate): self
    {
        $this->createdate = $createdate;

        return $this;
    }

    public function getUpdatedate(): ?\DateTimeInterface
    {
        return $this->updatedate;
    }

    public function setUpdatedate(\DateTimeInterface $updatedate): self
    {
        $this->updatedate = $updatedate;

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addMessage(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setAuthenticateduser($this);
        }

        return $this;
    }

    public function removeMessage(Comments $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getAuthenticateduser() === $this) {
                $comment->setAuthenticateduser(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection|Tricks[]
     */
    public function getTrickks(): Collection
    {
        return $this->tricks;
    }

    public function addTask(Tricks $trick): self
    {
        if (!$this->tricks->contains($trick)) {
            $this->tricks[] = $trick;
            $trick->setAuthenticateduser($this);
        }

        return $this;
    }

    public function removeTask(Tricks $trick): self
    {
        if ($this->tricks->contains($trick)) {
            $this->tricks->removeElement($trick);
            // set the owning side to null (unless already changed)
            if ($trick->getAuthenticateduser() === $this) {
                $trick->setAuthenticateduser(null);
            }
        }

        return $this;
    }










    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return ['ROLE_USERAUT'];
    }



    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
