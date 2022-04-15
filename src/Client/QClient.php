<?php

namespace App\Client;

use App\Entity\User;
use App\Mapper\AuthorMapper;
use App\Mapper\BookMapper;
use App\Model\Author;
use App\Model\Book;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\Security;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class QClient
{

    private HttpClientInterface $qclient;
    private Security $security;

    public function __construct(HttpClientInterface $qclient, Security $security)
    {
        $this->qclient = $qclient;
        $this->security = $security;
    }

    public function login(string $email, string $password): ResponseInterface
    {
        return $this->qclient->request('POST', '/api/v2/token', [
            'json' => [
                'email' => $email,
                'password' => $password
            ]
        ]);
    }

    public function refreshToken(string $token): array
    {
        return $this->qclient->request('POST', "/api/v2/token/refresh/$token")->toArray();
    }

    /**
     * @param int $page
     * @return array|Author[]
     */
    public function getAuthors(int $page = 1): array
    {
        $data = $this->qclient->request('GET', '/api/v2/authors', [
            'headers' => [
                'Authorization' => $this->getBearerCode()
            ]
        ])->toArray();

        foreach ($data['items'] as $authorData) {
            $result[] = AuthorMapper::toObject($authorData);
        }

        return $result ?? [];
    }

    public function getAuthor(int $id): Author
    {
        $data = $this->qclient->request('GET', "/api/v2/authors/$id", [
            'headers' => [
                'Authorization' => $this->getBearerCode()
            ]
        ])->toArray();

        return AuthorMapper::toObject($data);
    }

    public function insertAuthor(Author $author): array
    {
        return $this->qclient->request('POST', '/api/v2/authors', [
            'headers' => [
                'Authorization' => $this->getBearerCode()
            ],
            'json' => $author
        ])->toArray();
    }

    public function insertBook(Book $book): array
    {
        return $this->qclient->request('POST', '/api/v2/books', [
            'headers' => [
                'Authorization' => $this->getBearerCode()
            ],
            'json' => BookMapper::toArray($book)
        ])->toArray();
    }

    private function getBearerCode(): string
    {
        /** @var User|null $user */
        $user = $this->security->getUser();

        if (!$user) {
            throw new UserNotFoundException();
        }

        if ($user->getAccessTokenExpiresAt() < new \DateTime()) {
            //$this->get
        }

        return sprintf('Bearer %s', $user->getAccessToken());
    }
}