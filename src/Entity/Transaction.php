<?php

namespace UserCredit\Entity;

class Transaction
{
    private $id;
    private $userId;
    private $amount;
    private $date;

    public function __construct(int $id, int $userId, float $amount, \DateTime $date)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->amount = $amount;
        $this->date = $date;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }
}
