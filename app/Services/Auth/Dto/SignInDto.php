<?php

namespace App\Services\Auth\Dto;

class SignInDto
{
    /**
     * @var string
     */
    private string $email;

    /**
     * @var string
     */
    private string $password;


    /**
     * @var string
     */
    private string $ip;


    /**
     * @param string $email
     * @param string $password
     */
    public function __construct(
        string $email,
        string $password,
        string $ip,
    ) {
        $this->email = $email;
        $this->password = $password;
        $this->ip = $ip;
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
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getIP(): string
    {
        return $this->ip;
    }
}
