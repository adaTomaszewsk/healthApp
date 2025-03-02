<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "exercise")]
class Exercise 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: MuscleGroup::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private ?MuscleGroup $muscleGroup = null;

    #[ORM\Column(type: "integer")]
    private ?int $series = null; 

    #[ORM\Column(type: "integer")]
    private ?int $repetition = null; 

    #[ORM\Column(type: "string")]
    private ?int $load = null; 

    #[ORM\Column(type: "string")]
    private ?int $description = null; 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?int
    {
        return $this->id;
    }

    public function getMuscleGroup(): ?MuscleGroup
    {
        return $this->muscleGroup;
    }

    public function getSeries(): ?int
    {
        return $this->series;
    }
    public function getRepetition(): ?int
    {
        return $this->repetition;
    }
    public function getLoad(): ?string
    {
        return $this->load;
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
    public function setMuscleGroup(?MuscleGroup $muscleGroup): self
    {
        $this->muscleGroup = $muscleGroup;
        return $this;
    }

    public function setSeries(int $series): self
    {
        $this->series = $series;
        return $this;
    }
    public function setRepetition(int $repetition): self
    {
        $this->repetition = $repetition;
        return $this;
    }
    public function setLoad(string $load): self
    {
        $this->load = $load;
        return $this;
    }
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

}