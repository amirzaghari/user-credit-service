<?php

namespace UserCredit\Service;

use UserCredit\Repository\UserRepository;
use UserCredit\Repository\TransactionRepository;

class TransactionService
{
    private $userRepository;
    private $transactionRepository;

    public function __construct(UserRepository $userRepository, TransactionRepository $transactionRepository)
    {
        $this->userRepository = $userRepository;
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * @param int $userId
     * @param float $amount
     * @param \DateTime $date
     * @throws \Exception
     */
    public function addTransaction(int $userId, float $amount, \DateTime $date): void
    {
        $user = $this->userRepository->findUserById($userId);

        if (!$user) {
            throw new \Exception("User not found.");
        }

        $this->transactionRepository.addTransaction($userId, $amount, $date);

        $newCredit = $user->getCredit() + $amount;
        $this->userRepository->updateUserCredit($userId, $newCredit);
    }

    public function getUserTransactionsForDate(int $userId, \DateTime $date): array
    {
        return $this->transactionRepository->getTransactionsByUserAndDate($userId, $date);
    }

    public function getTotalTransactionsForAllUsersByDate(\DateTime $date): array
    {
        return $this->transactionRepository->getAllTransactionsByDate($date);
    }
}
