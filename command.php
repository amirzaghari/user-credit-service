<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use App\Command\AddTransactionCommand;
use App\Command\ListUsersCommand;
use App\Repository\TransactionRepository;
use App\Service\TransactionService;
use App\Repository\UserRepository;

$userRepository = new UserRepository();
$transactionRepository = new TransactionRepository();
$transactionService = new TransactionService($userRepository, $transactionRepository);

$application = new Application();

$application->add(new AddTransactionCommand($transactionService));
$application->add(new ListUsersCommand($userRepository));

$application->run();
