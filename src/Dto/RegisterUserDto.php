<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class RegisterUserDto
{
    #[Assert\NotBlank(message: 'Email is required')]
    #[Assert\Email(message: 'Invalid email format')]
    public ?string $email = null;

    #[Assert\NotBlank(message: 'Password is required')]
    #[Assert\Length(min: 6, minMessage: 'Password must be at least 6 characters')]
    public ?string $password = null;

    #[Assert\NotBlank(message: 'First name is required')]
    public ?string $firstName = null;

    #[Assert\NotBlank(message: 'Last name is required')]
    public ?string $lastName = null;

    public ?string $phoneNumber = null;
}

