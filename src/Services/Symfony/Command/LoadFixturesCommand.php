<?php

namespace App\Services\Symfony\Command;

use App\Services\DataFixtures\UserFixture;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LoadFixturesCommand extends Command
{
    private $userFixture;

    protected static $defaultName = 'app:load-fixtures';

    protected function configure()
    {
        $this->setDescription('Command creates fixtures');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Generating users...',
            '============',
            '',
        ]);

        $this->userFixture->loadUsers();

        $output->writeln([
            'Users had been generated',
            '============',
            '',
        ]);
    }

    public function __construct(UserFixture $baseFixture)
    {
        parent::__construct();

        $this->userFixture = $baseFixture;
    }
}
