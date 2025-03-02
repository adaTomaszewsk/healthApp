<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "muscle_group")]
class MuscleGroup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?\DateTime $createdAt = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(onDelete: "SET NULL")]
    private ?User $createdBy = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?int
    {
        return $this->id;
    }
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }
    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
    public function setCreatedAt(?\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    public function setCreatedBy(?User $user): self
    {
        $this->createdBy = $user;
        return $this;
    }
}