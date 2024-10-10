<?php

namespace App\Entity;

class User
{
    private $id;
    private $name;
    private $credit;

    public function __construct(string $name, float $credit)
    {
        $this->name = $name;
        $this->credit = $credit;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
