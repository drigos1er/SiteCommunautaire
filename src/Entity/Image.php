<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tricks", inversedBy="image")
     */
    private $tricks;

    /**
     * @Assert\Url()
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @Assert\Length( max=150, maxMessage="La description de l'image ne doit pas depasser 150 caractères")
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $alt;

    public function __construct()
    {
        $this->tricks = new ArrayCollection();
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

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * @return Collection|Tricks[]
     */
    public function getTricks(): Collection
    {
        return $this->tricks;
    }

    public function addTask(Tricks $trick): self
    {
        if (!$this->tricks->contains($trick)) {
            $this->tricks[] = $trick;
            $trick->setImage($this);
        }

        return $this;
    }

    public function removeTask(Tricks $trick): self
    {
        if ($this->tricks->contains($trick)) {
            $this->tricks->removeElement($trick);
            // set the owning side to null (unless already changed)
            if ($trick->getImage() === $this) {
                $trick->setImage(null);
            }
        }

        return $this;
    }

    public function setTricks(?Tricks $tricks): self
    {
        $this->tricks = $tricks;
        return $this;
    }
}
