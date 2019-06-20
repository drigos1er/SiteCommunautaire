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
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * @ORM\Entity(repositoryClass="App\Repository\AuthenticatedUserRepository")
 * @UniqueEntity(fields={"email"},
 * message="Cette valeur est dejà utilisé par un autre utilisateur"
 * )
 * @Vich\Uploadable
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
     * @ORM\OneToMany(targetEntity="App\Entity\Messages", mappedBy="authenticateduser")
     */
    private $messages;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Figures", mappedBy="authenticateduser")
     */
    private $figures;


    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->figures = new ArrayCollection();
    }


    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(min="4", minMessage="Votre login doit faire minimum 4 caractères")
     * @Assert\NotNull
     */
    private $username;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="users_image", fileNameProperty="picture")
     *
     * @var File
     */
    private $imagefile;



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
     * @ORM\Column(type="string", length=10)
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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
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
     * @return Collection|Messages[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Messages $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setAuthenticateduser($this);
        }

        return $this;
    }

    public function removeMessage(Messages $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getAuthenticateduser() === $this) {
                $message->setAuthenticateduser(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection|Figures[]
     */
    public function getFigures(): Collection
    {
        return $this->figures;
    }

    public function addFigure(Figures $figure): self
    {
        if (!$this->figures->contains($figure)) {
            $this->figures[] = $figure;
            $figure->setAuthenticateduser($this);
        }

        return $this;
    }

    public function removeFigure(Figures $figure): self
    {
        if ($this->figures->contains($figure)) {
            $this->figures->removeElement($figure);
            // set the owning side to null (unless already changed)
            if ($figure->getAuthenticateduser() === $this) {
                $figure->setAuthenticateduser(null);
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



    public function getImagefile(): ?File
    {
        return $this->imagefile;
    }

    public function setImagefile(File $imagefile): self
    {
        $this->imagefile = $imagefile;

        // Only change the updated af if the file is really uploaded to avoid database updates.
        // This is needed when the file should be set when loading the entity.
        if ($this->imagefile instanceof UploadedFile) {
            $this->updatedate = new \DateTime('now');
        }


        return $this;
    }

}
