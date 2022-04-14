<?php

namespace App\Mapper;

use App\Model\Author;

final class AuthorMapper
{

    public static function toObject(array $authorData): Author
    {
        $author = new Author();
        $author->setId($authorData['id']);
        $author->setFirstName($authorData['first_name']);
        $author->setLastName($authorData['last_name']);
        $author->setBirthday(new \DateTime($authorData['birthday']));
        $author->setGender($authorData['gender']);
        $author->setPlaceOfBirth($authorData['place_of_birth']);

        return $author;
    }

}