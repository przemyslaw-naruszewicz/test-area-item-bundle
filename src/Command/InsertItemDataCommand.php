<?php

namespace TestArea\ItemBundle\Command;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class InsertItemDataCommand
 * @package TestArea\ItemBundle\Command
 */
final class InsertItemDataCommand extends Command
{
    private const ITEMS = [
        [
            'name' => 'Produkt 1',
            'amount' => 4,
        ],
        [
            'name' => 'Produkt 2',
            'amount' => 12,
        ],
        [
            'name' => 'Produkt 5',
            'amount' => 0,
        ],
        [
            'name' => 'Produkt 7',
            'amount' => 6,
        ],
        [
            'name' => 'Produkt 8',
            'amount' => 2,
        ],
    ];

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var ArrayCollection
     */
    private $setOfQueries;

    /**
     * @var string
     */
    protected static $defaultName = 'insert:item-data';

    /**
     * InsertItemDataCommand constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->connection = $entityManager->getConnection();
        $this->setOfQueries = new ArrayCollection();
    }

    protected function configure()
    {
        $this->setDescription('Command for insertion of Items data');
        $this->addOption('truncate', 'tr', InputOption::VALUE_NONE);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws DBALException
     * @throws \Doctrine\DBAL\Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($input->getOption("truncate")) {
            $this->connection->executeQuery("TRUNCATE `items`");
        }
        $this->prepareSetOfQueries();

        try {
            $this->executeQueries();
        } catch (DBALException $exception) {
            $output->writeln("Error: " . $exception->getMessage());
            return 0;
        }

        $io = new SymfonyStyle($input, $output);
        $io->success('Data has been inserted');

        return 0;
    }

    private function prepareSetOfQueries(): void
    {
        foreach (self::ITEMS as $item) {
            $queryParams = sprintf("('%s', %d)", (string)$item['name'], $item['amount']);
            $query = sprintf("INSERT INTO `items` (`name`, `amount`) VALUES %s", $queryParams);
            $this->setOfQueries->add($query);
        }
    }

    /**
     * @throws DBALException
     */
    private function executeQueries(): void
    {
        $queriesAsString = implode(";", $this->setOfQueries->getValues()) . ";";
        $this->connection->executeQuery($queriesAsString);
    }
}
