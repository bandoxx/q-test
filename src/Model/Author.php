<?php

namespace App\Model;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Contracts\Service\Attribute\Required;

class Author
{

    private ?int $id;
    #[SerializedName('first_name'), Required]
    private string $firstName;
    #[SerializedName('last_name'), Required]
    private string $lastName;
    #[SerializedName('birthday'), Required]
    private \DateTime $birthday;
    #[SerializedName('biography')]
    private ?string $gender;
    #[SerializedName('gender'), Required]
    private ?string $biography;
    #[SerializedName('place_of_birth'), Required]
    private string $placeOfBirth;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getBirthday(): \DateTime
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTime $birthday): void
    {
        $this->birthday = $birthday;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): void
    {
        $this->gender = $gender;
    }

    public function getPlaceOfBirth(): string
    {
        return $this->placeOfBirth;
    }

    public function setPlaceOfBirth(string $placeOfBirth): void
    {
        $this->placeOfBirth = $placeOfBirth;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): void
    {
        $this->biography = $biography;
    }

}