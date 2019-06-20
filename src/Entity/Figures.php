<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FiguresRepository")
 */
class Figures
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Messages", mappedBy="figures")
     */
    private $messages;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MediaImage", mappedBy="figures")
     * @ORM\JoinColumn(name="mediaimage_id", referencedColumnName="id",onDelete="SET NULL")
     */
    private $mediaimage;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MediaVideo", mappedBy="figures")
     * @ORM\JoinColumn(name="mediavideo_id", referencedColumnName="id",onDelete="SET NULL")
     */
    private $mediavideo;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GroupFigures", inversedBy="figures")
     * @ORM\JoinColumn(name="groupfigures_id", referencedColumnName="id",onDelete="SET NULL")
     */
    private $groupfigures;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AuthenticatedUser", inversedBy="figures")
     * @ORM\JoinColumn(name="authenticateduser_id", referencedColumnName="id",onDelete="SET NULL")
     */
    private $authenticateduser;




    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedate;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->mediaimage = new ArrayCollection();
        $this->mediavideo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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
            $message->setFigures($this);
        }

        return $this;
    }

    public function removeMessage(Messages $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getFigures() === $this) {
                $message->setFigures(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MediaImage[]
     */
    public function getMediaimage(): Collection
    {
        return $this->mediaimage;
    }

    public function addMediaimage(MediaImage $mediaimage): self
    {
        if (!$this->mediaimage->contains($mediaimage)) {
            $this->mediaimage[] = $mediaimage;
            $mediaimage->setFigures($this);
        }

        return $this;
    }

    public function removeMediaimage(MediaImage $mediaimage): self
    {
        if ($this->mediaimage->contains($mediaimage)) {
            $this->mediaimage->removeElement($mediaimage);
            // set the owning side to null (unless already changed)
            if ($mediaimage->getFigures() === $this) {
                $mediaimage->setFigures(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MediaVideo[]
     */
    public function getMediavideo(): Collection
    {
        return $this->mediavideo;
    }

    public function addMediavideo(MediaVideo $mediavideo): self
    {
        if (!$this->mediavideo->contains($mediavideo)) {
            $this->mediavideo[] = $mediavideo;
            $mediavideo->setFigures($this);
        }

        return $this;
    }

    public function removeMediavideo(MediaVideo $mediavideo): self
    {
        if ($this->mediavideo->contains($mediavideo)) {
            $this->mediavideo->removeElement($mediavideo);
            // set the owning side to null (unless already changed)
            if ($mediavideo->getFigures() === $this) {
                $mediavideo->setFigures(null);
            }
        }

        return $this;
    }

    public function getGroupfigures(): ?GroupFigures
    {
        return $this->groupfigures;
    }

    public function setGroupfigures(?GroupFigures $groupfigures): self
    {
        $this->groupfigures = $groupfigures;

        return $this;
    }

    public function getAuthenticateduser(): ?AuthenticatedUser
    {
        return $this->authenticateduser;
    }

    public function setAuthenticateduser(?AuthenticatedUser $authenticateduser): self
    {
        $this->authenticateduser = $authenticateduser;

        return $this;
    }








}
