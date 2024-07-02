<?php

// src/Command/GenerateApiKeyCommand.php
namespace App\Command;

use App\Entity\ApiKey;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:generate-api-key',
    description: 'Generates a new API key.',
)]
class GenerateApiKeyCommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $apiKey = new ApiKey();
        $this->entityManager->persist($apiKey);
        $this->entityManager->flush();

        $output->writeln('API Key: ' . $apiKey->getKey());

        return Command::SUCCESS;
    }
}
