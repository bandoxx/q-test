<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;

class UserService
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function saveFromSuccessfulLogin(array $data): bool
    {
        $user = $this->userRepository->findOneByEmail($data['user']['email']);

        if (!$user) {
            throw new UserNotFoundException();
        }

        $user->setAccessToken($data['token_key']);
        $user->setRefreshToken($data['refresh_token_key']);
        $user->setFirstName($data['user']['first_name']);
        $user->setLastName($data['user']['last_name']);
        $user->setAccessTokenExpiresAt(new \DateTime($data['expires_at']));
        $user->setRefreshTokenExpiresAt(new \DateTime($data['refresh_expires_at']));

        $this->userRepository->flush();

        return true;
    }

}