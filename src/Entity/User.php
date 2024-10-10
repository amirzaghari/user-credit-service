<?php

namespace UserCredit\Entity;

class User
{
    private $id;
    private $name;
    private $credit;

    public function __construct(int $id, string $name, float $credit)
    {
        $this->id = $id;
        $this->name = $name;
        $this->credit = $credit;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCredit(): float
    {
        return $this->credit;
    }

    public function setCredit(float $credit): void
    {
        $this->credit = $credit;
    }
}
