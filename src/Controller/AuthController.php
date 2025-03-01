<?php

namespace App\Controller;

use App\Dto\RegisterUserDto;
use App\Entity\User;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AuthController extends AbstractController
{
    public function __construct(private ValidatorInterface $validator){}


    #[Route('/api/register', name: 'api_register', methods: ['POST'])]
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        ValidatorInterface $validator,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        $user = new User();
        $user->setEmail($data['email'] ?? '');
        $user->setFirstName($data['firstName'] ?? '');
        $user->setLastName($data['lastName'] ?? '');
        $user->setPhoneNumber($data['phoneNumber'] ?? '');
        $user->setPassword(
            $passwordHasher->hashPassword($user, $data['password'] ?? '')
        );

        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return new JsonResponse(['errors' => $errorMessages], 400);
        }

        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse(['message' => 'User registered successfully'], 201);
    }

    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function login()
    {
         /** @var \App\Entity\User $user */
        $user = $this->getUser();

        if (!$user instanceof \App\Entity\User) {
            throw new \LogicException('Użytkownik nie jest zalogowany lub nie jest typu App\Entity\User');
        }
    
        return $this->json([
            'email' => $user->getEmail(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName()
        ]);
    }
}