<?php

namespace App\Repository;

use App\Entity\MuscleGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MuscleGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MuscleGroup::class);
    }

    public function save(MuscleGroup $muscleGroup, bool $flush = false): void
    {
        $this->_em->persist($muscleGroup);
        if ($flush) {
            $this->_em->flush();
        }
    }
}
