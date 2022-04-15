<?php

namespace App\Client;

use App\Entity\User;
use App\Mapper\AuthorMapper;
use App\Model\Author;
use Symfony\Component\Security\Core\Security;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class QClient
{

    private HttpClientInterface $qclient;
    private Security $security;

    public function __construct(HttpClientInterface $qclient, Security $security)
    {
        $this->qclient = $qclient;
        $this->security = $security;
    }

    public function login(string $email, string $password)
    {
        return $this->qclient->request('POST', '/api/v2/token', [
            'json' => [
                'email' => $email,
                'password' => $password
            ]
        ]);
    }

    public function refreshToken(string $token)
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

    public function insertAuthor(Author $author)
    {
        return $this->qclient->request('POST', '/api/v2/authors', [
            'headers' => [
                'Authorization' => $this->getBearerCode()
            ],
            'json' => $author
        ])->toArray();
    }

    private function getBearerCode()
    {
        /** @var User $user */
        $user = $this->security->getUser();


        if ($user->getAccessTokenExpiresAt() < new \DateTime()) {
            //$this->get
        }

        return sprintf('Bearer %s', $user->getAccessToken());
    }
}