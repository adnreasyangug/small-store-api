<?php

namespace App\Services\User\Dto;

class CreateUsersDto
{
    /**
     * @var string
     */
    private string $firstName;

    /**
     * @var string
     */
    private string $lastName;

    /**
     * @var string
     */
    private string $email;

    /**
     * @var string
     */
    private string $phone;

    /**
     * @var string
     */
    private string $password;

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $phone
     * @param string $password
     */
    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $phone,
        string $password
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

}
