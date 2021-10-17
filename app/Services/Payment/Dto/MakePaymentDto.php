<?php

namespace App\Services\Payment\Dto;

class MakePaymentDto
{
    /**
     * @var int
     */
    private int $userId;

    /**
     * @var float
     */
    private float $amount;

    /**
     * @var string
     */
    private string $description;

    /**
     * @var string
     */
    private string $status;

    /**
     * @param int $userId
     * @param float $amount
     * @param string $description
     * @param string $status
     */
    public function __construct(
        int $userId,
        float $amount,
        string $description,
        string $status
    ) {
        $this->userId = $userId;
        $this->amount = $amount;
        $this->description = $description;
        $this->status = $status;
    }


    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}
