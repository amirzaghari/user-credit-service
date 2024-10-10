<?php

require_once __DIR__ . '/vendor/autoload.php';

use UserCredit\Command\AddTransactionCommand;
use UserCredit\Repository\TransactionRepository;
use UserCredit\Service\TransactionService;
use UserCredit\Repository\UserRepository;
use UserCredit\Command\ListUsersCommand;

$command = $argv[1] ?? null;
$userId = $argv[2] ?? null;
$amount = $argv[3] ?? null;
$date = $argv[4] ?? null;


$userRepository = new UserRepository();
$transactionRepository = new TransactionRepository();
$transactionService = new TransactionService($userRepository, $transactionRepository);

$addTransactionCommand = new AddTransactionCommand($transactionService);
$listUsersCommand = new ListUsersCommand($userRepository);

switch ($command) {
    case 'add-transaction':
        if ($userId && $amount && $date) {
            try {
                $addTransactionCommand->execute((int)$userId, (float)$amount, $date);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            echo "Usage: php command.php add-transaction <userId> <amount> <date>\n";
        }
        break;

    case 'list-users':
        $listUsersCommand->execute();
        break;

    default:
        echo "Unknown command.\n";
        break;
}
