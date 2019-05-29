<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessagesRepository")
 */
class Messages
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AuthenticatedUser", inversedBy="messages")
     * @ORM\JoinColumn(name="authenticateduser_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $authenticateduser;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Figures", inversedBy="messages")
     * @ORM\JoinColumn(name="figures_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $figures;


    /**
     * @ORM\Column(type="string", length=100)
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

    public function getFigures(): ?Figures
    {
        return $this->figures;
    }

    public function setFigures(?Figures $figures): self
    {
        $this->figures = $figures;

        return $this;
    }




}
