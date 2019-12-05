<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TricksRepository")
 * @UniqueEntity(
 *     fields={"name"},
 *     message="Une autre figure possède déjà ce nom"
 * )
 * @ORM\HasLifecycleCallbacks()
 */
class Tricks
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="tricks")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="tricks",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id",onDelete="SET NULL")
     * @Assert\Valid()
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Video", mappedBy="tricks", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="video_id", referencedColumnName="id",onDelete="SET NULL")
     * @Assert\Valid()
     */
    private $video;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TricksGroup", inversedBy="tricks")
     * @ORM\JoinColumn(name="tricksgroup_id", referencedColumnName="id",onDelete="SET NULL")
     */
    private $tricksgroup;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AuthenticatedUser", inversedBy="tricks")
     * @ORM\JoinColumn(name="authenticateduser_id", referencedColumnName="id",onDelete="SET NULL")
     */
    private $authenticateduser;

    /**
     * @Assert\Length(min=4, max=100, minMessage="Le titre doit excédé plus de 4 caractères",
     *     maxMessage="Le titre  ne doit pas excédé plus de 100 caractères")
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
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


    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->image = new ArrayCollection();
        $this->video = new ArrayCollection();
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
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setTricks($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getTricks() === $this) {
                $comment->setTricks(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImage(): Collection
    {
        return $this->image;
    }

    public function addImage(Image $image): self
    {
        if (!$this->image->contains($image)) {
            $this->image[] = $image;
            $image->setTricks($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->image->contains($image)) {
            $this->image->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getTricks() === $this) {
                $image->setTricks(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Video[]
     */
    public function getVideo(): Collection
    {
        return $this->video;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->video->contains($video)) {
            $this->video[] = $video;
            $video->setTricks($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->video->contains($video)) {
            $this->video->removeElement($video);
            // set the owning side to null (unless already changed)
            if ($video->getTricks() === $this) {
                $video->setTricks(null);
            }
        }

        return $this;
    }

    public function getTricksgroup(): ?TricksGroup
    {
        return $this->tricksgroup;
    }

    public function setTricksgroup(?TricksGroup $tricksgroup): self
    {
        $this->tricksgroup = $tricksgroup;

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
