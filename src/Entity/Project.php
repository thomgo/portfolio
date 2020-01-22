<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $viewLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codeLink;

    /**
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * @ORM\Column(type="string")
     */
    private $imageFilename;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getViewLink(): ?string
    {
        return $this->viewLink;
    }

    public function setViewLink(?string $viewLink): self
    {
        $this->viewLink = $viewLink;

        return $this;
    }

    public function getCodeLink(): ?string
    {
        return $this->codeLink;
    }

    public function setCodeLink(?string $codeLink): self
    {
        $this->codeLink = $codeLink;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getImageFilename(): ?string
    {
        return $this->imageFilename;
    }

    public function setImageFilename($imageFilename): self
    {
      $this->imageFilename = $imageFilename;

      return $this;
    }
}
