<?php

namespace UserCredit\Repository;

use UserCredit\Entity\Transaction;

class TransactionRepository
{
    private $transactions = [];
    private $currentId = 1;

    public function addTransaction(int $userId, float $amount, \DateTime $date): Transaction
    {
        $transaction = new Transaction($this->currentId++, $userId, $amount, $date);
        $this->transactions[] = $transaction;
        return $transaction;
    }

    public function getTransactionsByUserAndDate(int $userId, \DateTime $date): array
    {
        return array_filter($this->transactions, function (Transaction $transaction) use ($userId, $date) {
            return $transaction->getUserId() === $userId && $transaction->getDate()->format('Y-m-d') === $date->format('Y-m-d');
        });
    }

    public function getAllTransactionsByDate(\DateTime $date): array
    {
        return array_filter($this->transactions, function (Transaction $transaction) use ($date) {
            return $transaction->getDate()->format('Y-m-d') === $date->format('Y-m-d');
        });
    }
}
