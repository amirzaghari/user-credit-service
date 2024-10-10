<?php

namespace App\Command;

use App\Service\TransactionService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddTransactionCommand extends Command
{
    protected static $defaultName = 'add-transaction';

    private $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Adds a transaction for a specific user.')
            ->addArgument('userId', InputArgument::REQUIRED, 'The ID of the user')
            ->addArgument('amount', InputArgument::REQUIRED, 'The amount of the transaction')
            ->addArgument('date', InputArgument::REQUIRED, 'The date of the transaction (Y-m-d)');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userId = (int) $input->getArgument('userId');
        $amount = (float) $input->getArgument('amount');
        $dateString = $input->getArgument('date');

        try {
            $date = new \DateTime($dateString);
        } catch (\Exception $e) {
            $output->writeln('Error: Invalid date format.');
            return Command::FAILURE;
        }

        try {
            $this->transactionService->addTransaction($userId, $amount, $date);
            $output->writeln('Transaction added successfully.');
        } catch (\Exception $e) {
            $output->writeln('Error: ' . $e->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
