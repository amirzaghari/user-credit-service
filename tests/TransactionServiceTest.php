<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Repository\TransactionRepository;
use App\Repository\UserRepository;
use App\Service\TransactionService;
use App\Entity\User;
use DateTime;

class TransactionServiceTest extends TestCase
{
    private $userRepository;
    private $transactionRepository;
    private $transactionService;

    protected function setUp(): void
    {
        $this->userRepository = new UserRepository();
        $this->transactionRepository = new TransactionRepository();
        $this->transactionService = new TransactionService($this->userRepository, $this->transactionRepository);
    }

    /**
     * @throws \Exception
     */
    public function testAddTransaction(): void
    {
        $user = new User('John Doe', 100);
        $this->userRepository->addUser($user);

        // Ensure the user has been assigned an ID
        $userId = $user->getId();
        $this->transactionService->addTransaction($userId, 50, new DateTime('2024-10-10'));

        // Assert that the user has a transaction of amount 50 for the date 2024-10-10
        self::assertEquals(50, $this->transactionService->getUserTransactionsForDate($userId, new DateTime('2024-10-10')));
    }

    /**
     * @throws Exception
     */
    public function testGetDailyReport(): void
    {
        $user1 = new User('John Doe', 100);
        $user2 = new User('Jane Doe', 200);

        $this->userRepository->addUser($user1);
        $this->userRepository->addUser($user2);

        // Add transactions for both users
        $this->transactionService->addTransaction($user1->getId(), 50, new DateTime('2024-10-10'));
        $this->transactionService->addTransaction($user2->getId(), 150, new DateTime('2024-10-10'));

        // Assert that the total transactions for all users on 2024-10-10 is 200
        self::assertEquals(200, $this->transactionService->getTotalTransactionsForAllUsersByDate(new DateTime('2024-10-10')));
    }

    /**
     * @throws Exception
     */
    public function testAddTransaction_UserNotFound(): void
    {
        // Attempt to add a transaction for a non-existent user
        $this->expectException(\UnexpectedValueException::class);
        $this->transactionService->addTransaction(999, 50, new DateTime('2024-10-10'));
    }

    /**
     * @throws Exception
     */
    public function testGetUserTransactionsForDate_NoTransactions(): void
    {
        $user = new User('John Doe', 100);
        $this->userRepository->addUser($user);

        // Assert that there are no transactions for the user on a specific date
        self::assertEquals(0.0, $this->transactionService->getUserTransactionsForDate($user->getId(), new DateTime('2024-10-10')));
    }
}
