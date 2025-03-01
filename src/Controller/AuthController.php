<?php

namespace App\Controller;

use App\Dto\RegisterUserDto;
use App\Entity\User;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AuthController extends AbstractController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    #[Route('/api/register', name: 'api_register', methods: ['POST'])]
    public function register(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $dto = new RegisterUserDto();
        $dto->setEmail($data['email'] ?? '')
            ->setPassword($data['password'] ?? '')
            ->setFirstName($data['firstName'] ?? '')
            ->setLastName($data['lastName'] ?? '')
            ->setPhoneNumber($data['phoneNumber'] ?? '');

        $errors = $validator->validate($dto);
        if (count($errors) > 0) {
            $errorsString = [];
            foreach ($errors as $error) {
                $errorsString[] = $error->getMessage();
            }
            return $this->json(['errors' => $errorsString], 400);        
        }

        $user = $this->userService->register($dto);

        return new JsonResponse(['message' => 'User registered successfully', 'user' => $user], 201);
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