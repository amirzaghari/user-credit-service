<?php

namespace App\Service;

use App\Repository\UserRepository;
use App\Repository\TransactionRepository;
use App\Entity\Transaction;

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
            throw new \UnexpectedValueException("User not found.");
        }

        $this->transactionRepository->addTransaction($userId, $amount, $date);

        $newCredit = $user->getCredit() + $amount;
        $this->userRepository->updateUserCredit($userId, $newCredit);
    }

    /**
     * Get total transaction amount for a user on a specific date.
     *
     * @param int $userId
     * @param \DateTime $date
     * @return float
     */
    public function getUserTransactionsForDate(int $userId, \DateTime $date): float
    {
        /** @var Transaction[] $transactions */
        $transactions = $this->transactionRepository->getTransactionsByUserAndDate($userId, $date);

        $total = 0.0;
        foreach ($transactions as $transaction) {
            $total += $transaction->getAmount();
        }

        return $total;
    }

    /**
     * Get total transaction amount for all users on a specific date.
     *
     * @param \DateTime $date
     * @return float
     */
    public function getTotalTransactionsForAllUsersByDate(\DateTime $date): float
    {
        /** @var Transaction[] $transactions */
        $transactions = $this->transactionRepository->getAllTransactionsByDate($date);

        $total = 0.0;
        foreach ($transactions as $transaction) {
            $total += $transaction->getAmount();
        }

        return $total;
    }
}

