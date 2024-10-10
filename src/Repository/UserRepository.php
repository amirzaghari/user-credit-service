<?php

namespace UserCredit\Repository;

use UserCredit\Entity\User;
use Faker\Factory;

class UserRepository
{
    private $users = [];

    public function __construct()
    {
        $faker = Factory::create();
        for ($i = 1; $i <= 10; $i++) {
            $this->users[$i] = new User($i, $faker->name, $faker->randomFloat(2, 0, 1000));
        }
    }

    public function getAllUsers(): array
    {
        return $this->users;
    }

    public function findUserById(int $id): ?User
    {
        return $this->users[$id] ?? null;
    }

    public function updateUserCredit(int $id, float $newCredit): void
    {
        if (isset($this->users[$id])) {
            $this->users[$id]->setCredit($newCredit);
        }
    }
}
