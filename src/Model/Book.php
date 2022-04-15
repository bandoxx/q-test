<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Contracts\Service\Attribute\Required;

class Book
{

    private ?int $id;
    #[Required]
    private ?int $authorId;
    #[Required, Length(min: 1, max: 255)]
    private string $title;
    #[Required]
    private \DateTime $releaseDate;
    #[Required, Length(min: 1, max: 255)]
    private ?string $description;
    #[Required]
    private string $isbn;
    private ?string $format;
    #[GreaterThan(0)]
    private ?int $numberOfPages;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getAuthorId(): ?int
    {
        return $this->authorId;
    }

    /**
     * @param int|null $authorId
     */
    public function setAuthorId(?int $authorId): void
    {
        $this->authorId = $authorId;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return \DateTime
     */
    public function getReleaseDate(): \DateTime
    {
        return $this->releaseDate;
    }

    /**
     * @param \DateTime $releaseDate
     */
    public function setReleaseDate(\DateTime $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getIsbn(): string
    {
        return $this->isbn;
    }

    /**
     * @param string $isbn
     */
    public function setIsbn(string $isbn): void
    {
        $this->isbn = $isbn;
    }

    /**
     * @return string|null
     */
    public function getFormat(): ?string
    {
        return $this->format;
    }

    /**
     * @param string|null $format
     */
    public function setFormat(?string $format): void
    {
        $this->format = $format;
    }

    /**
     * @return int|null
     */
    public function getNumberOfPages(): ?int
    {
        return $this->numberOfPages;
    }

    /**
     * @param int|null $numberOfPages
     */
    public function setNumberOfPages(?int $numberOfPages): void
    {
        $this->numberOfPages = $numberOfPages;
    }
}