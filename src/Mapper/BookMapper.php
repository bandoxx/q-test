<?php

namespace App\Mapper;

use App\Model\Book;
use JetBrains\PhpStorm\ArrayShape;

final class BookMapper
{
    #[ArrayShape(['author' => "array", 'title' => "string", 'release_date' => "string", 'description' => "null|string", 'isbn' => "string", 'format' => "null|string", 'number_of_pages' => "int|null"])]
    public static function toArray(Book $book): array
    {
        return [
            'author' => [
                'id' => $book->getAuthorId()
            ],
            'title' => $book->getTitle(),
            'release_date' => $book->getReleaseDate()->format('Y-m-d'),
            'description' => $book->getDescription(),
            'isbn' => $book->getIsbn(),
            'format' => $book->getFormat(),
            'number_of_pages' => $book->getNumberOfPages()
        ];
    }

}