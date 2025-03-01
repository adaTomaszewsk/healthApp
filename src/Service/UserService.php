<?php

namespace App\Service;

use App\DTO\RegisterUserDto;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface; 

class UserService
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private UserRepository $userRepository,
    )
    {}

    public function register(RegisterUserDto $dto): User
    {
        $user = new User();
        
        $user->setEmail($dto->email)
             ->setFirstName($dto->firstName)
             ->setLastName($dto->lastName)
             ->setPhoneNumber($dto->phoneNumber);

        $hashedPassword = $this->passwordHasher->hashPassword($user, $dto->password);
        $user->setPassword($hashedPassword);

        $this->userRepository->save($user, true);
        return $user;
    }
}