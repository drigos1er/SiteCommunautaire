<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Comments
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AuthenticatedUser", inversedBy="comments")
     * @ORM\JoinColumn(name="authenticateduser_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $authenticateduser;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tricks", inversedBy="comments")
     * @ORM\JoinColumn(name="tricks_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $tricks;


    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $content;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getAuthenticateduser(): ?AuthenticatedUser
    {
        return $this->authenticateduser;
    }

    public function setAuthenticateduser(?AuthenticatedUser $authenticateduser): self
    {
        $this->authenticateduser = $authenticateduser;

        return $this;
    }

    public function getTricks(): ?Tricks
    {
        return $this->tricks;
    }

    public function setTricks(?Tricks $tricks): self
    {
        $this->tricks = $tricks;

        return $this;
    }
}
