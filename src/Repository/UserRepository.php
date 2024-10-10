<?php

namespace App\Repository;

use App\Entity\User;
use Faker\Factory;

class UserRepository
{
    private $users = [];

    public function __construct()
    {
        $faker = Factory::create();
        for ($i = 1; $i <= 10; $i++) {
            $user = new User($faker->name, $faker->randomFloat(2, 0, 1000));
            $user->setId($i);
            $this->users[$i] = $user;
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

    public function addUser(User $user): User
    {
        $index = count($this->users);
        $user->setId($index);
        $this->users[$index] = $user;
        return $user;
    }
}
