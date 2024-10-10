<?php

namespace UserCredit\Command;

use UserCredit\Service\TransactionService;

class AddTransactionCommand
{
    private $service;

    public function __construct(TransactionService $service)
    {
        $this->service = $service;
    }

    /**
     * @param int $userId
     * @param float $amount
     * @param string $date
     * @throws \Exception
     */
    public function execute(int $userId, float $amount, string $date): void
    {
        $this->service->addTransaction($userId, $amount, new \DateTime($date));
        echo "Transaction added successfully.\n";
    }
}
