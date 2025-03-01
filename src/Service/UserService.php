<?php

namespace App\Service;

use App\Dto\RegisterUserDto;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;

class UserService
{
    public function __construct(
        private UserPasswordHasher $passwordHasher,
        private UserRepository $userRepository,
    )
    {}

    public function register(RegisterUserDto $dto){
        $user = new User();
        $user
        ->setEmail($dto->email)
        ->setFirstName($dto->firstName)
        ->setLastName($dto->lastName)
        ->setPhoneNumber($dto->phoneNumber);

        $hasherdPassword = $this->passwordHasher->hashPassword($user, $dto->password);
        $user->setPassword($hasherdPassword);

        $this->userRepository->save($user, true);
        return $user;
    }
}